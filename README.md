# Administrasi PKL — Platform Administrasi Praktik Kerja Lapangan

<div align="center">
    <img src="/images/projects/Administrasi-Pkl/Administrasi-PKL.jpeg" width="700" alt="Administrasi PKL Preview">
</div>

<br>

<div align="center">

| Teknologi | Versi |
| :--- | :--- |
| **Laravel** | `12.x` |
| **PHP** | `8.2` |
| **Database** | `PostgreSQL` |
| **Frontend** | `Tailwind CSS v4` |
| **Container** | `Docker` |
| **Dokumen** | `PhpWord` + `LibreOffice` (headless) |

</div>

Sebuah sistem manajemen internal untuk mendigitalisasi dan menyederhanakan alur kerja administrasi **Praktik Kerja Lapangan (PKL)** di tingkat SMK. Dikembangkan sebagai solusi nyata — bukan simulasi — untuk memodernisasi infrastruktur sekolah, menyederhanakan pelacakan data siswa, dan mengotomatisasi pembuatan dokumen resmi.

> 🏗️ **Dikembangkan selama program PKL** (Desember 2025 - Maret 2026) dan saat ini digunakan sebagai sistem produksi utama.

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
| :--- | :--- |
| **RBAC 3 Tingkat** | Role `super_admin`, `admin_jurusan`, dan `siswa` — masing-masing dengan middleware ketat dan dashboard khusus |
| **Autentikasi Ganda** | Login via username atau NIS (Nomor Induk Siswa) |
| **Manajemen Data** | CRUD lengkap untuk siswa, jurusan, pembimbing, dan logistik transportasi |
| **Monitoring DU/DI** | Pelacakan mitra industri dengan kalkulasi sisa kuota penempatan secara real-time |
| **Otomatisasi Dokumen** | Generate surat resmi dari template DOCX → dikonversi ke PDF via headless LibreOffice (Docker) |
| **Pemeliharaan Storage** | Pembersihan file sementara otomatis saat logout |

---

## 📋 Persyaratan Sistem

- **PHP** 8.2+
- **Composer**
- **Node.js** & **NPM**
- **PostgreSQL**
- **Docker** (untuk pipeline PDF)

---

## 🔧 Instalasi

### 1. Clone Repositori

```bash
git clone https://github.com/Vinnzz-coy/administrator-pkl.git
cd administrator-pkl
```

### 2. Install Dependensi

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Sesuaikan konfigurasi database di `.env`:

```dotenv
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=administrasi_pkl
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### 4. Migrasi & Seeding

```bash
php artisan migrate
php artisan db:seed
```

### 5. Jalankan Aplikasi

Terminal 1 — Backend:

```bash
php artisan serve
```

Terminal 2 — Frontend (Vite):

```bash
npm run dev
```

Aplikasi tersedia di `http://127.0.0.1:8000`.

### 6. (Opsional) Pipeline PDF

Untuk generate dokumen PDF, jalankan container LibreOffice:

```bash
docker compose up -d libreoffice
```

---

## 🔐 Akun Default (Seeding)

Setelah `db:seed`, tersedia akun admin per jurusan:

| Jurusan | Username | Password |
| :--- | :--- | :--- |
| Rekayasa Perangkat Lunak | `admin_rpl` | `rpl@2025` |
| Teknik Komputer Jaringan | `admin_tkj` | `tkj@2025` |
| Desain Komunikasi Visual | `admin_dkv` | `dkv@2025` |
| Akuntansi | `admin_akl` | `akl@2025` |
| Manajemen Perkantoran Layanan Bisnis | `admin_mplb` | `mplb@2025` |
| Pemasaran | `admin_pemasaran` | `pemasaran@2025` |
| Kuliner | `admin_kuliner` | `kuliner@2025` |
| Usaha Layanan Wisata | `admin_ulw` | `ulw@2025` |

> ⚠️ Ganti password default setelah login pertama.

---

## 🐳 Docker

Gunakan `docker compose` untuk menjalankan dependency:

```bash
# LibreOffice headless (konversi DOCX → PDF)
docker compose up -d libreoffice

# Jika menggunakan PostgreSQL via Docker
docker compose up -d postgres
```

---

## 📄 Lisensi

[MIT](LICENSE)
