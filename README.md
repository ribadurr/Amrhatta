# Pusat Informasi & Administrasi Pramuka SMKN 1 Garut

Aplikasi web untuk mengelola informasi dan administrasi Pramuka SMKN 1 Garut dengan fitur publik dan dashboard admin.

## 📋 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi](#teknologi)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Panduan Penggunaan](#panduan-penggunaan)
- [Struktur Folder](#struktur-folder)
- [Database](#database)

---

## ✨ Fitur Utama

### Halaman Publik
- **Beranda** - Menampilkan statistik, event terbaru, dan informasi singkat
- **Event & Program** - Daftar kegiatan dengan foto dan detail lengkap
- **Tentang Kami** - Sejarah, visi, misi, prestasi, dan profil pembina
- **Keanggotaan** - Daftar anggota aktif, jenjang, syarat & manfaat bergabung

### Dashboard Admin
- **Manajemen Event** - CRUD event dengan upload foto kegiatan
- **Manajemen Prestasi** - CRUD prestasi dengan tampilan kartu menarik
- **Manajemen Pembina** - CRUD pembina dengan upload foto dan biodata
- **Manajemen Anggota** - CRUD anggota dengan data lengkap (NISN, kelas, posisi, dll)
- **Manajemen Jadwal** - CRUD jadwal kegiatan rutin

### Fitur Khusus
- ✅ Autentikasi login dengan role admin
- ✅ Upload foto untuk event, pembina, dan media lainnya
- ✅ Responsive design untuk desktop, tablet, dan mobile
- ✅ Statistik dinamis (anggota, pembina, prestasi dari database)
- ✅ Tampilan kartu (card) menarik dengan animasi hover
- ✅ Interface Bahasa Indonesia

---

## 🛠 Teknologi

| Teknologi | Versi | Keterangan |
|-----------|-------|-----------|
| **Laravel** | 11.x | Framework backend |
| **PHP** | 8.2+ | Server-side language |
| **Blade** | Latest | Template engine |
| **Vite** | 5.x | Build tool dan asset pipeline |
| **Tailwind CSS** | 3.x | Utility-first CSS framework |
| **SQLite** | Latest | Database lokal |
| **Composer** | Latest | PHP dependency manager |

---

## 🚀 Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- Node.js 18+
- XAMPP atau server lokal lainnya

### Langkah Instalasi

1. **Clone atau ekstrak proyek:**
```bash
cd C:\xampp\htdocs
# Proyek sudah ada di folder Amrhatta
cd Amrhatta
```

2. **Install dependencies PHP:**
```powershell
composer install
```

3. **Install dependencies Node:**
```powershell
npm install
```

4. **Copy file environment:**
```powershell
Copy-Item .env.example .env
```

5. **Generate application key:**
```powershell
php artisan key:generate
```

6. **Jalankan migrasi database:**
```powershell
php artisan migrate
```

7. **Seed data awal (opsional):**
```powershell
php artisan db:seed
```

8. **Link storage untuk upload foto:**
```powershell
php artisan storage:link
```

9. **Build assets:**
```powershell
npm run build
```

10. **Jalankan development server:**
```powershell
php artisan serve
```

Aplikasi sekarang dapat diakses di: `http://localhost:8000`

---

## ⚙️ Konfigurasi

### File Konfigurasi Penting

#### `.env`
```env
APP_NAME="Pramuka SMKN 1 Garut"
APP_URL=http://localhost:8000
DB_CONNECTION=sqlite
DB_DATABASE=database.sqlite
```

#### `config/site.php`
Mengatur konfigurasi situs:
```php
'founded_year' => 1984,  // Tahun berdiri organisasi
```

### Variabel Lingkungan (.env)

| Variabel | Nilai Default | Keterangan |
|----------|--------------|-----------|
| `APP_NAME` | Pramuka SMKN 1 Garut | Nama aplikasi |
| `APP_URL` | http://localhost:8000 | URL aplikasi |
| `DB_CONNECTION` | sqlite | Jenis database |
| `ADMIN_EMAIL` | admin@example.test | Email admin default |
| `ADMIN_PASSWORD` | secret123 | Password admin default |

---

## 📖 Panduan Penggunaan

### Login Admin

1. Buka `http://localhost:8000/admin/login` atau `http://localhost:8000/login`
2. Masuk dengan:
   - **Email:** `admin@example.test`
   - **Password:** `secret123`
3. Anda akan diarahkan ke dashboard admin

### Mengelola Event

1. Dari sidebar admin, klik **Events**
2. Klik **+ Tambah Event** untuk membuat event baru
3. Isi form:
   - Judul event
   - Deskripsi
   - Tanggal pelaksanaan
   - Lokasi
   - **Foto Kegiatan** (opsional - upload file gambar)
   - Jumlah peserta
   - Durasi (contoh: "3 Hari 2 Malam")
4. Klik **Simpan Event**

Foto akan ditampilkan di halaman publik `/events`

### Mengelola Pembina

1. Dari sidebar admin, klik **Pembina**
2. Klik **+ Tambah Pembina** untuk membuat pembina baru
3. Isi form:
   - Nama pembina
   - Posisi (contoh: Pembina Utama, Wakil Pembina)
   - **Foto Pembina** (upload file gambar untuk profil)
   - Biodata/bio singkat
   - Pengalaman (dalam tahun)
4. Klik **Simpan**

Pembina akan tampil di halaman publik `/about` dengan foto bulat dan biodata

### Mengelola Anggota

1. Dari sidebar admin, klik **Anggota**
2. Klik **+ Tambah Anggota** untuk mendaftarkan anggota baru
3. Isi form:
   - Nama Lengkap
   - NISN (nomor identitas siswa)
   - Kelas/Grade
   - **Posisi** pilih dari: Pradana, Juru Adat, Krani, Bendahara, Tekpram, Giatops, Bimval, Inventaris, Kominfo, Anggota
   - Tanggal Bergabung
4. Klik **Simpan**

Anggota akan tampil di halaman publik `/members` dan statistik akan otomatis terupdate

### Mengelola Prestasi

1. Dari sidebar admin, klik **Prestasi**
2. Klik **+ Tambah Prestasi** untuk menambah prestasi baru
3. Isi form:
   - Tahun pencapaian
   - Judul prestasi
   - Kategori (contoh: Lomba, Festival, Kompetisi, dll)
4. Klik **Simpan**

Prestasi akan ditampilkan di halaman publik `/about` dengan kartu menarik

### Mengubah Tahun Berdiri

Edit file `config/site.php`:
```php
'founded_year' => 1984,  // Ubah ke tahun yang diinginkan
```

Lalu jalankan:
```powershell
php artisan config:clear
php artisan cache:clear
```

### Upload Foto

Foto dapat diupload di form CRUD:
- **Event:** Foto kegiatan ditampilkan di atas judul event
- **Pembina:** Foto ditampilkan sebagai avatar bulat dengan border emas
- **Ukuran maksimal:** 2MB
- **Format:** JPG, PNG, GIF, dll
- **Penyimpanan:** `storage/app/public/events/`, `storage/app/public/coaches/`, dll

---

## 📁 Struktur Folder

```
Amrhatta/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PublicController.php       # Halaman publik
│   │   │   ├── EventController.php        # CRUD Event
│   │   │   ├── CoachController.php        # CRUD Pembina
│   │   │   ├── AchievementController.php  # CRUD Prestasi
│   │   │   ├── MemberController.php       # CRUD Anggota
│   │   │   └── AdminController.php        # Admin misc
│   │   ├── Middleware/
│   │   │   └── IsAdmin.php               # Middleware cek admin
│   │   └── Requests/
│   └── Models/
│       ├── Event.php
│       ├── Coach.php
│       ├── Achievement.php
│       ├── Member.php
│       ├── Organization.php
│       └── User.php
├── config/
│   ├── site.php                          # Konfigurasi situs (founded_year, dll)
│   └── app.php (dan config lainnya)
├── database/
│   ├── migrations/                       # File migrasi database
│   ├── seeders/                          # File seeder untuk data awal
│   └── factories/
├── resources/
│   ├── css/
│   │   ├── app.css                       # CSS Tailwind
│   │   ├── public.css                    # CSS halaman publik
│   │   └── admin.css                     # CSS admin dashboard
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php             # Layout publik
│       │   └── admin.blade.php           # Layout admin
│       ├── public/
│       │   ├── home.blade.php            # Halaman beranda
│       │   ├── events.blade.php          # Halaman event
│       │   ├── about.blade.php           # Halaman tentang
│       │   └── members.blade.php         # Halaman anggota
│       ├── admin/
│       │   ├── events/                   # CRUD Event views
│       │   ├── coaches/                  # CRUD Pembina views
│       │   ├── achievements/             # CRUD Prestasi views
│       │   ├── member/                   # CRUD Anggota views
│       │   └── agenda/                   # CRUD Jadwal views
│       ├── partials/
│       │   ├── public_nav.blade.php      # Navbar publik
│       │   └── public_footer.blade.php   # Footer publik
│       └── dashboard.blade.php           # Dashboard admin
├── routes/
│   ├── web.php                           # Routes publik & admin
│   └── auth.php                          # Routes autentikasi
├── storage/
│   ├── app/
│   │   ├── public/
│   │   │   ├── events/                   # Folder foto event
│   │   │   ├── coaches/                  # Folder foto pembina
│   │   │   └── ...
│   │   └── private/
│   ├── framework/
│   └── logs/
├── public/
│   ├── index.php                         # Entry point
│   ├── storage/                          # Link ke storage (dibuat otomatis)
│   ├── build/                            # Asset build (css, js terhash)
│   ├── images/                           # Gambar statis
│   └── robots.txt
├── .env                                  # Environment variables
├── composer.json                         # PHP dependencies
├── package.json                          # Node dependencies
├── vite.config.js                        # Vite config
└── README.md                             # Dokumentasi (file ini)
```

---

## 🗄 Database

### Tabel Utama

#### `users`
Menyimpan akun login admin/user.

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| `id` | INT | Primary key |
| `name` | STRING | Nama user |
| `email` | STRING | Email unik |
| `password` | STRING | Password hash |
| `role` | STRING | Role (admin/user) |
| `created_at` | TIMESTAMP | Waktu dibuat |

#### `members`
Menyimpan data anggota pramuka.

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| `id` | INT | Primary key |
| `full_name` | STRING | Nama lengkap |
| `nisn` | STRING | Nomor identitas siswa (unik) |
| `grade_class` | STRING | Kelas/tingkat |
| `position` | STRING | Posisi di organisasi |
| `join_date` | DATE | Tanggal bergabung |
| `created_at` | TIMESTAMP | Waktu dibuat |

#### `coaches`
Menyimpan data pembina.

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| `id` | INT | Primary key |
| `name` | STRING | Nama pembina |
| `position` | STRING | Posisi (Pembina Utama, dll) |
| `photo` | STRING | Path foto (nullable) |
| `bio` | TEXT | Biodata singkat (nullable) |
| `experience_years` | INT | Tahun pengalaman (nullable) |
| `experience` | STRING | Deskripsi pengalaman (legacy) |
| `created_at` | TIMESTAMP | Waktu dibuat |

#### `events`
Menyimpan data kegiatan/event.

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| `id` | INT | Primary key |
| `title` | STRING | Judul event |
| `description` | TEXT | Deskripsi lengkap |
| `date` | DATE | Tanggal pelaksanaan |
| `location` | STRING | Lokasi event |
| `photo` | STRING | Path foto event (nullable) |
| `participants` | STRING | Jumlah peserta |
| `duration` | STRING | Durasi (contoh: 3 Hari 2 Malam) |
| `created_at` | TIMESTAMP | Waktu dibuat |

#### `achievements`
Menyimpan data prestasi.

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| `id` | INT | Primary key |
| `year` | INT | Tahun pencapaian |
| `title` | STRING | Judul prestasi |
| `category` | STRING | Kategori prestasi |
| `created_at` | TIMESTAMP | Waktu dibuat |

---

## 📱 Responsive Design

Aplikasi fully responsive untuk:
- **Desktop** (1024px ke atas)
- **Tablet** (768px - 1023px)
- **Mobile** (480px - 767px)
- **Mobile Kecil** (di bawah 480px)

Media queries telah dioptimalkan di:
- `resources/css/public.css`
- `resources/css/admin.css`

---

## 🔐 Keamanan

- ✅ Autentikasi dengan Laravel Breeze
- ✅ Password di-hash dengan bcrypt
- ✅ CSRF protection
- ✅ Role-based access control (middleware IsAdmin)
- ✅ Input validation pada semua form
- ✅ File upload divalidasi (tipe, ukuran)

---

## 🐛 Troubleshooting

### Foto tidak muncul
Pastikan telah menjalankan:
```powershell
php artisan storage:link
```

### Error "table has no column"
Jalankan migrasi:
```powershell
php artisan migrate
```

### Cache/view stale
Bersihkan cache:
```powershell
php artisan view:clear
php artisan cache:clear
php artisan config:clear
```

### Build asset error
Rebuild assets:
```powershell
npm run build
```

---

## 📝 Panduan Kontribusi

Untuk menambah fitur atau memperbaiki bug:

1. Buat branch baru
2. Lakukan perubahan
3. Test di lokal
4. Commit dengan pesan jelas
5. Push dan buat pull request

---

## 📜 Lisensi

Proyek ini untuk penggunaan internal SMKN 1 Garut.

---

## 👥 Tim

**Nama Sekolah:** SMKN 1 Garut  
**Organisasi:** Pramuka - Ambalan Mohammad Hatta-Rahmi Hatta  
**Tahun Berdiri:** 1984

---

## 📞 Kontak & Dukungan

Untuk pertanyaan atau dukungan teknis, hubungi admin website.

---

**Terakhir diperbarui:** 30 November 2025
