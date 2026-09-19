# 🚀 System Absensi & Monitoring Kesehatan IoT (ESP32 + Laravel 10)

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![ESP32](https://img.shields.io/badge/Hardware-ESP32-E7352C?style=for-the-badge&logo=espressif&logoColor=white)
![Pusher](https://img.shields.io/badge/WebSocket-Pusher-300D4F?style=for-the-badge&logo=pusher&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

Sistem Informasi Presensi dan Monitoring Kesehatan Murid/Atlet berbasis **Internet of Things (IoT)**. Aplikasi ini mengintegrasikan mikrokontroler **ESP32**, **Sensor Sidik Jari (Biometric Fingerprint R307/AS608)**, dan **Sensor Detak Jantung (Heart Rate/Pulse Sensor)** dengan backend **Laravel 10** secara *real-time* memanfaatkan WebSocket Pusher.

---

## 📌 Fitur Utama

- 🖐️ **Real-time Fingerprint Enrollment (WebSocket)**:
  Saat pendaftaran murid baru, ESP32 memindai sidik jari dan mengirimkan ID ke server. Server menyiarkan ID tersebut via **Pusher WebSocket** sehingga input ID pada formulir pendaftaran di browser terisi secara otomatis tanpa me-refresh halaman.
  
- 💓 **Absensi & Monitoring Detak Jantung Otomatis**:
  Setiap pemindaian presensi pada alat ESP32 mencatat kehadiran sekaligus mengukur detak jantung (*BPM*) pengguna secara langsung.

- 📊 **Dashboard Analytics & Presensi Harian**:
  Menampilkan ringkasan statistik kehadiran harian (Hadir, Izin, Sakit, Alpa) dan total murid/atlet yang terdaftar.

- 👥 **Manajemen Data Murid / Master Data**:
  Pengelolaan data akademik murid (NIM, Nama, Jenis Kelamin, Fakultas, Program Studi) yang terhubung langsung dengan ID Sidik Jari IoT.

- 📈 **Rekapitulasi Presensi & Data Kesehatan**:
  Laporan riwayat kehadiran yang dilengkapi indikator waktu pemindaian dan riwayat detak jantung per sesi.

---

## 🛠️ Teknologi & Stack

### **Hardware & IoT**
- **Mikrokontroler**: ESP32
- **Sensor Biometrik**: R307 / AS608 Optical Fingerprint Sensor
- **Sensor Kesehatan**: MAX30102 / Pulse Sensor (Heart Rate Sensor)

### **Software & Backend**
- **Framework Backend**: Laravel 10
- **Bahasa Pemrograman**: PHP 8.1+
- **Database**: MySQL / MariaDB
- **WebSockets / Real-time**: Pusher Channels & Laravel Event Broadcasting
- **Authentication**: Laravel Sanctum

### **Frontend & UI**
- **Template**: MatDash Admin Template
- **CSS Framework**: Tailwind CSS
- **Icon Set**: Solar Icons & Tabler Icons via Iconify

---

## 🔄 Arsitektur Komunikasi IoT

```
+------------------+         HTTP POST (API)       +---------------------+
|                  | ---------------------------> |                     |
|  Mikrokontroler  |   /api/fingerprint/enroll    |  Laravel 10 Backend |
|      ESP32       |   /api/attendances           |                     |
|                  |                              +---------------------+
+------------------+                                         |
         |                                                   | Event Broadcast
   [Fingerprint]                                             v
   [Heart Rate]                                   +---------------------+
                                                  |   Pusher Channels   |
                                                  +---------------------+
                                                             |
                                                             | WebSocket Event
                                                             v
                                                  +---------------------+
                                                  | Browser Client (UI) |
                                                  | Form Enrollment Auto|
                                                  +---------------------+
```

---

## 📡 API Endpoints (Integrasi ESP32)

### 1. Enrollment Sidik Jari (Real-Time Broadcast)
Mengirimkan ID sidik jari yang baru saja di-scan pada ESP32 ke form browser.

- **Endpoint**: `POST /api/fingerprint/enroll`
- **Headers**: `Content-Type: application/json`
- **Request Body**:
  ```json
  {
    "finger_id": 1
  }
  ```
- **Response Success (200 OK)**:
  ```json
  {
    "success": true,
    "message": "Fingerprint ID berhasil dikirim ke browser.",
    "finger_id": 1
  }
  ```

---

### 2. Record Presensi & Detak Jantung
Mencatat presensi harian beserta data detak jantung (BPM).

- **Endpoint**: `POST /api/attendances`
- **Headers**: `Content-Type: application/json`
- **Request Body**:
  ```json
  {
    "finger_id": 1,
    "heart_rate": 78
  }
  ```
- **Response Success (201 Created)**:
  ```json
  {
    "success": true,
    "message": "Absensi berhasil dicatat.",
    "data": {
      "attendance_id": 12,
      "athlete_id": 1,
      "athlete_name": "Budi Santoso",
      "heart_rate": 78,
      "recorded_at": "2026-09-20T00:30:00.000000Z"
    }
  }
  ```
- **Response Error - Sidik Jari Belum Terdaftar (404 Not Found)**:
  ```json
  {
    "success": false,
    "message": "Sidik jari belum terdaftar."
  }
  ```

---

## 💻 Panduan Instalasi Project (Web Application)

### Prasyarat
- PHP >= 8.1
- Composer
- Node.js & NPM
- Database MySQL / MariaDB
- Akun Pusher (untuk fitur real-time enrollment)

### Langkah-Langkah

1. **Clone Repository**
   ```bash
   git clone https://github.com/Rexshin1/Absensi-IoT.git
   cd Absensi-IoT
   ```

2. **Install Dependensi PHP & Node.js**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment (`.env`)**
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Atur konfigurasi database dan Pusher pada file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=absensi_iot
   DB_USERNAME=root
   DB_PASSWORD=

   BROADCAST_DRIVER=pusher

   PUSHER_APP_ID=your_app_id
   PUSHER_APP_KEY=your_app_key
   PUSHER_APP_SECRET=your_app_secret
   PUSHER_HOST=
   PUSHER_PORT=443
   PUSHER_SCHEME=https
   PUSHER_APP_CLUSTER=ap1

   VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
   VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
   ```

4. **Generate Application Key & Migration**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```

5. **Menjalankan Server Lokal**
   Jalankan server Laravel dan pembangun aset frontend:
   ```bash
   # Terminal 1 (Laravel Server)
   php artisan serve

   # Terminal 2 (Vite Assets Server)
   npm run dev
   ```
   Buka browser dan akses `http://127.0.0.1:8000`.

---

## ⚡ Contoh Implementasi Payload ESP32 (C++ / Arduino IDE)

```cpp
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

const char* ssid = "YOUR_WIFI_SSID";
const char* password = "YOUR_WIFI_PASSWORD";
const char* serverUrl = "http://192.168.1.X:8000/api/attendances";

void sendAttendance(int fingerId, int heartRate) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverUrl);
    http.addHeader("Content-Type", "application/json");

    StaticJsonDocument<200> doc;
    doc["finger_id"] = fingerId;
    doc["heart_rate"] = heartRate;

    String requestBody;
    serializeJson(doc, requestBody);

    int httpResponseCode = http.POST(requestBody);
    
    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println("Response: " + response);
    } else {
      Serial.printf("Error Code: %d\n", httpResponseCode);
    }
    http.end();
  }
}
```

---

## 📁 Struktur Direktori Utama

```
absensi/
├── app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   │   ├── AttendanceController.php    # Handler API Presensi IoT
│   │   │   └── EnrollmentController.php    # Handler API Real-time Enrollment
│   │   └── DashboardController.php         # Handler Web Views & Logic
│   └── Events/
│       └── FingerprintScanned.php           # Event WebSocket Pusher Broadcast
├── Models/
│   ├── Athlete.php                          # Model Data Atlet / Mapping Sidik Jari
│   ├── Attendance.php                       # Model Data Presensi & Heart Rate
│   └── User.php                             # Model Data Murid & Akun
├── database/
│   └── migrations/                          # Skema Tabel Database
├── resources/
│   └── views/                               # Template Blade (UI Dashboard)
└── routes/
    ├── api.php                              # Endpoint API IoT
    └── web.php                              # Routing Web App
```

---

## 📝 Lisensi

Proyek ini dibuat untuk keperluan sistem presensi & pemantauan kesehatan berbasis IoT. Lisensi kode mengikuti lisensi terbuka [MIT License](LICENSE).

---

Developed with ❤️ by [Rexshin1](https://github.com/Rexshin1).
