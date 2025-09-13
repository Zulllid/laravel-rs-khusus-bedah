# 🏥 Sistem Informasi Rumah Sakit Khusus Bedah
Portofolio Fullstack Laravel 8 — Aplikasi manajemen rumah sakit (CRUD pasien, antrian, farmasi, kasir, rawat inap, dashboard).

## 🚀 Cara Menjalankan Project (Demo Lokal)
1. Clone repo:
   ```bash
   git clone https://github.com/Zulllid/laravel-rs-khusus-bedah.git
   cd laravel-rs-khusus-bedah
### 🔑 Login & Role
- Admin: `admin@rs.com` / `password123`
- Role-based access middleware sudah diterapkan
- Contoh akses:
   - Admin dashboard → `/admin` (hanya Admin)
### 👩‍⚕️ CRUD Pasien
- URL: `/patients`
- Fungsi:
   - Tambah Pasien
   - Edit Pasient
   - Hapus Pasient
   - Lihat daftar pasient
- validasi server-side sudah diterapkan
### 🏥 Appointment Poli
- URL: `/appointments`
- Fungsi:
   - Buat janji poli pasien
   - Pilih pasien, poli, dokter, jadwal
   - Edit & hapus janji
- Relasi: Patient ↔ Poli ↔ Doctor