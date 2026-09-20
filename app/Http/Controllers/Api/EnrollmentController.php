<?php

namespace App\Http\Controllers\Api;

use App\Events\FingerprintScanned;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Menerima finger_id dari ESP32 saat proses enrollment,
     * lalu broadcast ke browser via Pusher agar form auto-fill.
     *
     * POST /api/fingerprint/enroll
     * Body JSON: { "finger_id": 1 }
     */
    public function enroll(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'finger_id' => ['required', 'integer', 'min:1', 'max:127'],
        ]);

        try {
            event(new FingerprintScanned($validated['finger_id']));
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Pusher Broadcast warning: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Fingerprint ID berhasil dikirim ke browser.',
            'finger_id' => $validated['finger_id'],
        ]);
    }

    /**
     * Mengecek nama murid berdasarkan fingerprint_id untuk tampilan LCD ESP32.
     * GET /api/fingerprint/cek-nama/{id}
     */
    public function checkName(string $id): JsonResponse
    {
        $athlete = \App\Models\Athlete::where('fingerprint_id', $id)->first();

        if (! $athlete) {
            return response()->json([
                'success' => false,
                'nama' => 'Tdk Dikenal',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'nama' => $athlete->name,
        ]);
    }

    /**
     * Mengecek mode aktif perangkat (absen/daftar) untuk ESP32.
     * GET /api/device/mode
     */
    public function getMode(): JsonResponse
    {
        $mode = \Illuminate\Support\Facades\Cache::get('device_mode', 'absen');

        return response()->json([
            'success' => true,
            'mode' => $mode,
        ]);
    }

    /**
     * Mengubah mode aktif perangkat dari Web Admin.
     * POST /api/device/mode
     */
    public function setMode(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'mode' => ['required', 'in:absen,daftar'],
        ]);

        \Illuminate\Support\Facades\Cache::put('device_mode', $validated['mode'], now()->addHours(24));

        return response()->json([
            'success' => true,
            'message' => 'Mode perangkat berhasil diubah ke ' . $validated['mode'],
            'mode' => $validated['mode'],
        ]);
    }
}
