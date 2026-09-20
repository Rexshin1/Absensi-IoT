<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\Attendance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'finger_id' => ['required'],
            'heart_rate' => ['required', 'integer', 'min:0', 'max:240'],
        ]);

        if (! is_int($validated['finger_id']) && ! is_string($validated['finger_id'])) {
            return response()->json([
                'success' => false,
                'message' => 'finger_id harus berupa angka atau string.',
            ], 422);
        }

        $fingerId = (string) $validated['finger_id'];

        $athlete = Athlete::where('fingerprint_id', $fingerId)->first();

        if (! $athlete) {
            return response()->json([
                'success' => false,
                'message' => 'Sidik jari belum terdaftar.',
            ], 404);
        }

        $user = \App\Models\User::where('name', $athlete->name)->first();

        $attendance = Attendance::create([
            'athlete_id' => $athlete->id,
            'user_id' => $user?->id,
            'attendance_date' => today(),
            'heart_rate' => $validated['heart_rate'],
            'status' => 'present',
            'note' => 'Absensi dari ESP32',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil dicatat.',
            'data' => [
                'attendance_id' => $attendance->id,
                'athlete_id' => $athlete->id,
                'athlete_name' => $athlete->name,
                'heart_rate' => $attendance->heart_rate,
                'recorded_at' => $attendance->created_at?->toISOString(),
            ],
        ], 201);
    }
}