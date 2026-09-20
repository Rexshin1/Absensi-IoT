<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Athlete;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        \Illuminate\Support\Facades\Cache::put('device_mode', 'absen', now()->addHours(24));

        $totalStudents = Schema::hasTable('athletes') ? Athlete::count() : User::count();
        $todayAttendances = collect();
        $attendanceStats = [
            'totalStudents' => $totalStudents,
            'present' => 0,
            'permission' => 0,
            'sick' => 0,
            'absent' => $totalStudents,
        ];

        if (Schema::hasTable('attendances')) {
            $todayAttendances = Attendance::with(['athlete', 'user'])
                ->whereDate('attendance_date', today())
                ->latest()
                ->get();
            $todayAttendance = $todayAttendances->groupBy('status');

            $attendanceStats['present'] = $todayAttendance->get('present', collect())->count();
            $attendanceStats['permission'] = $todayAttendance->get('permission', collect())->count();
            $attendanceStats['sick'] = $todayAttendance->get('sick', collect())->count();
            $attendanceStats['absent'] = max(
                $totalStudents - $attendanceStats['present'] - $attendanceStats['permission'] - $attendanceStats['sick'],
                0
            );
        }

        return view('dashboard.index', [
            'title' => 'Dashboard Absensi',
            'attendanceStats' => $attendanceStats,
            'todayAttendances' => $todayAttendances,
        ]);
    }

    public function typography(): View
    {
        return view('utilities.typography', ['title' => 'Typography | MatDash']);
    }

    public function table(): View
    {
        return view('utilities.table', ['title' => 'Table | MatDash']);
    }

    public function form(): View
    {
        return view('utilities.form', ['title' => 'Form Elements | MatDash']);
    }

    public function shadow(): View
    {
        return view('utilities.shadow', ['title' => 'Shadow | MatDash']);
    }

    public function profile(): View
    {
        $adminProfile = session('admin_profile', [
            'name' => 'Administrator',
            'email' => 'admin@absensi-iot.com',
            'phone' => '0812-3456-7890',
            'position' => 'Super Admin',
            'username' => 'admin_absensi',
        ]);

        return view('profile.index', [
            'title' => 'My Profile',
            'adminProfile' => $adminProfile,
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'position' => ['nullable', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:100'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $adminProfile = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? '-',
            'position' => $validated['position'] ?? 'Administrator',
            'username' => $validated['username'],
        ];

        session(['admin_profile' => $adminProfile]);

        return redirect()->route('profile')->with('success', 'Profil Admin & Akun berhasil diperbarui!');
    }

    public function students(): View
    {
        \Illuminate\Support\Facades\Cache::put('device_mode', 'daftar', now()->addMinutes(30));

        return view('students.create', ['title' => 'Daftar Murid']);
    }

    public function studentList(Request $request): View
    {
        \Illuminate\Support\Facades\Cache::put('device_mode', 'absen', now()->addHours(24));

        $search = trim((string) $request->query('search', ''));
        $students = User::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->get();

        return view('students.index', [
            'title' => 'Data Murid',
            'students' => $students,
            'search' => $search,
        ]);
    }

    public function masterData(): View
    {
        $totalStudents = User::count();
        $totalAthletes = Athlete::count();
        $facultiesCount = User::whereNotNull('fakultas')->where('fakultas', '!=', '')->distinct('fakultas')->count('fakultas');
        $prodiCount = User::whereNotNull('prodi')->where('prodi', '!=', '')->distinct('prodi')->count('prodi');

        return view('master-data.index', [
            'title' => 'Master Data',
            'totalStudents' => $totalStudents,
            'totalAthletes' => $totalAthletes,
            'facultiesCount' => $facultiesCount,
            'prodiCount' => $prodiCount,
        ]);
    }

    public function storeStudent(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'nim'            => ['required', 'string', 'max:50', 'unique:users,nim'],
            'gender'         => ['required', 'in:Laki-laki,Perempuan'],
            'prodi'          => ['required', 'string', 'max:150'],
            'fakultas'       => ['required', 'string', 'max:150'],
            'fingerprint_id' => ['required', 'integer', 'min:1', 'max:127', 'unique:athletes,fingerprint_id'],
        ]);

        // Simpan data akademik ke tabel users
        User::create([
            'name'     => $validated['name'],
            'nim'      => $validated['nim'],
            'prodi'    => $validated['prodi'],
            'fakultas' => $validated['fakultas'],
            'email'    => Str::lower($validated['nim']) . '@murid.local',
            'password' => Str::random(32),
        ]);

        // Simpan mapping sidik jari ke tabel athletes (dipakai IoT)
        Athlete::create([
            'name'           => $validated['name'],
            'class_category' => $validated['gender'], // gender disimpan di class_category
            'fingerprint_id' => (string) $validated['fingerprint_id'],
        ]);

        return redirect()->route('students.create')->with('success', 'Murid berhasil didaftarkan.');
    }

    public function attendanceRecap(Request $request): View
    {
        $date = $request->date('date') ?? today();
        $attendances = Attendance::with(['athlete', 'user'])
            ->whereDate('attendance_date', $date)
            ->latest('updated_at')
            ->get();

        return view('attendance.recap', [
            'title' => 'Rekap Data Absensi',
            'date' => $date,
            'attendances' => $attendances,
            'heartRateData' => $attendances
                ->whereNotNull('heart_rate')
                ->sortBy('created_at')
                ->map(fn (Attendance $attendance) => [
                    'time' => $attendance->created_at?->format('H:i') ?? '-',
                    'athlete' => $attendance->athlete?->name ?? $attendance->user?->name ?? 'Murid',
                    'heart_rate' => $attendance->heart_rate,
                ])
                ->values(),
            'summary' => [
                'present' => $attendances->where('status', 'present')->count(),
                'permission' => $attendances->where('status', 'permission')->count(),
                'sick' => $attendances->where('status', 'sick')->count(),
                'absent' => $attendances->where('status', 'absent')->count(),
            ],
        ]);
    }

    public function notes(): View
    {
        return view('apps.notes.index', ['title' => 'Notes | MatDash']);
    }

    public function tickets(): View
    {
        return view('apps.tickets.index', ['title' => 'Tickets | MatDash']);
    }

    public function createTicket(): View
    {
        return view('apps.tickets.create', ['title' => 'Create Ticket | MatDash']);
    }

    public function blogPost(): View
    {
        return view('apps.blog.post', ['title' => 'Blog Post | MatDash']);
    }

    public function blogDetail(string $slug): View
    {
        return view('apps.blog.detail', ['title' => 'Blog Detail | MatDash', 'slug' => $slug]);
    }

    public function login()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login', ['title' => 'Login Admin | UKM Absensi IoT']);
    }

    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $adminProfile = session('admin_profile', [
            'username' => 'admin_absensi',
            'email' => 'admin@absensi-iot.com',
            'name' => 'Administrator',
        ]);

        $input = trim($request->input('username'));

        if (in_array(strtolower($input), [strtolower($adminProfile['username']), strtolower($adminProfile['email']), 'admin'])) {
            session(['admin_logged_in' => true]);
            return redirect()->route('dashboard')->with('success', 'Selamat datang kembali, ' . $adminProfile['name'] . '!');
        }

        return back()->withInput()->withErrors(['login' => 'Username atau password yang Anda masukkan salah.']);
    }

    public function logout(): RedirectResponse
    {
        session()->forget('admin_logged_in');
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }

    public function register(): View
    {
        return view('auth.register', ['title' => 'Register | MatDash']);
    }
}
