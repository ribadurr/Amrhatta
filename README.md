# 🎯 Pusat Informasi Pramuka SMKN 1 Garut

Aplikasi web modern untuk mengelola informasi dan administrasi Ambalan Mohammad Hatta-Rahmi Hatta SMKN 1 Garut dengan dashboard admin yang intuitif dan halaman publik yang responsif.

**Live Features:**
- 📌 Manajemen Event, Prestasi, Pembina, dan Anggota
- 📱 Fully Responsive (Desktop, Tablet, Mobile)
- 🖼️ Upload Foto dengan Preview
- 📊 Statistik Real-time dari Database
- 🔐 Autentikasi Admin dengan Role-based Access
- 🎨 Modern UI dengan Tailwind CSS & Animasi

---

## 📋 Daftar Isi

1. [Teknologi](#-teknologi)
2. [Instalasi Cepat](#-instalasi-cepat)
3. [Fitur Utama](#-fitur-utama)
4. [USE CASE DIAGRAM](#-use-case-diagram)
5. [Struktur Database & ERD](#-struktur-database--erd)
6. [API Routes](#-api-routes)
7. [Panduan Penggunaan](#-panduan-penggunaan)
8. [Struktur Folder](#-struktur-folder)

---

## 🛠 Teknologi

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Laravel** | 11.x | Framework Backend |
| **PHP** | 8.2+ | Server-side Language |
| **Blade** | Latest | Template Engine |
| **Vite** | 5.x | Build Tool |
| **Tailwind CSS** | 3.x | CSS Framework |
| **MySQL** | 5.7+ | Database |
| **Composer** | Latest | PHP Dependencies |
| **Node.js** | 18+ | Asset Build |

---

## 🚀 Instalasi Cepat

### Prasyarat
```bash
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 5.7+
```

### Setup Steps

```bash
# 1. Clone/ekstrak proyek
cd C:\xampp\htdocs\Amrhatta

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
copy .env.example .env
php artisan key:generate

# 4. Database setup
php artisan migrate
php artisan db:seed

# 5. Link storage untuk upload
php artisan storage:link

# 6. Build assets & run
npm run build
php artisan serve
```

✅ **Akses:** `http://localhost:8000`  
🔑 **Login:** admin@example.test / password

---

## ✨ Fitur Utama

### 🌐 Halaman Publik
- **Beranda** - Statistik live, event terbaru, info singkat
- **Event & Program** - Daftar event dengan foto dan detail pembina
- **Tentang Kami** - Sejarah, visi, misi, daftar prestasi & pembina
- **Keanggotaan** - Daftar anggota dengan pembina, jenjang, syarat & manfaat

### 🎛️ Dashboard Admin
| Menu | Fungsi |
|------|--------|
| **Event** | CRUD event + upload foto kegiatan |
| **Prestasi** | CRUD prestasi dengan kategori & tahun |
| **Pembina** | CRUD pembina + foto profil + biodata |
| **Anggota** | CRUD anggota + hubungan ke pembina |

### 🎁 Fitur Khusus
- ✅ Relasi many-to-many: Event ↔ Member, Achievement ↔ Member
- ✅ Upload & preview foto (2MB max)
- ✅ Responsive design dengan animasi smooth
- ✅ Input validation lengkap
- ✅ Data seeding otomatis
- ✅ Real-time statistics

---

## 📊 USE CASE DIAGRAM

### Diagram Alur Sistem

```
                        SISTEM PRAMUKA SMKN 1 GARUT
                                  │
                    ┌─────────────────────────────┐
                    │                             │
                    ▼                             ▼
            ┌───────────────┐           ┌──────────────────┐
            │   ADMIN SIDE  │           │   PUBLIC SIDE    │
            └───────────────┘           └──────────────────┘
                    │                             │
        ┌───────────┼───────────┐        ┌────────┼────────┐
        │           │           │        │        │        │
        ▼           ▼           ▼        ▼        ▼        ▼
    ┌────────┐ ┌────────┐ ┌────────┐ ┌─────┐ ┌──────┐ ┌────────┐
    │ Member │ │ Event  │ │Coach   │ │View │ │Browse│ │ About  │
    │ CRUD   │ │ CRUD   │ │ CRUD   │ │Home │ │Event │ │ Info   │
    └────────┘ └────────┘ └────────┘ │     │ │ List │ │ Page   │
        │           │           │        │     │      │ │        │
        ▼           ▼           ▼        └─────┘ └──────┘ └────────┘
    ┌────────┐ ┌────────┐ ┌────────┐        │
    │Achievement│ Upload │ Import/ │        └────────┐
    │ CRUD    │ Photos │ Export  │                 │
    └────────┘ └────────┘ └────────┘        ┌──────▼────────┐
                │           │                │   Browse      │
                │           │                │   Members     │
                └─────┬─────┘                └───────────────┘
                      │
                      ▼
            ┌──────────────────────┐
            │   Manage Relations   │
            │   • Event→Member     │
            │   • Achievement→Mbr  │
            │   • Coach→Member     │
            │   • Coach→Event      │
            └──────────────────────┘
```

### Use Cases Detail

| No | Use Case | Actor | Deskripsi |
|----|----------|-------|----------|
| 1 | **Create Member** | Admin | Tambah anggota baru dengan foto, NISN, kelas, pembina |
| 2 | **View Members** | Admin | Lihat daftar semua anggota dengan foto & detail |
| 3 | **Update Member** | Admin | Edit data anggota (nama, kelas, jabatan, foto) |
| 4 | **Delete Member** | Admin | Hapus anggota dari sistem |
| 5 | **Export Members** | Admin | Download data anggota ke file CSV |
| 6 | **Import Members** | Admin | Upload daftar anggota dari file CSV (batch) |
| 7 | **Create Event** | Admin | Buat kegiatan baru (judul, tanggal, lokasi, durasi, foto) |
| 8 | **Edit Event** | Admin | Ubah detail event & assign peserta |
| 9 | **Delete Event** | Admin | Hapus event dari sistem |
| 10 | **Assign Members to Event** | Admin | Pilih anggota yang ikut event (N:N) |
| 11 | **Assign Coach to Event** | Admin | Tentukan pembina yang mendampingi |
| 12 | **Create Achievement** | Admin | Buat prestasi baru (tahun, judul, kategori) |
| 13 | **Link Achievement Members** | Admin | Hubungkan prestasi ke anggota (N:N) |
| 14 | **Link Achievement Event** | Admin | Hubungkan prestasi ke event (1:N) |
| 15 | **Manage Coaches** | Admin | CRUD pembina + upload foto profil |
| 16 | **Admin Login** | Admin | Login dengan email & password |
| 17 | **Admin Logout** | Admin | Keluar dari sistem |
| 18 | **Browse Members** | Public | Lihat daftar anggota dengan foto & pembina (paginated) |
| 19 | **Browse Events** | Public | Lihat daftar event dengan detail & pembina |
| 20 | **View About Info** | Public | Baca sejarah, visi, misi, prestasi, profil pembina |

---

### Entity Relationship Diagram (Lengkap)

```
┌─────────────────────────────────────────────────────────────────┐
│           PRAMUKA SMKN 1 GARUT - DATABASE SCHEMA               │
└─────────────────────────────────────────────────────────────────┘

    ┌────────────────────────────┐
    │         USERS              │
    ├────────────────────────────┤
    │ id (PK)                    │
    │ name                       │
    │ email (UNIQUE)             │
    │ email_verified_at          │
    │ password (hashed)          │
    │ created_at, updated_at     │
    └────────────────────────────┘


┌────────────────────────────┐         ┌────────────────────────────┐
│      COACHES               │◄────────┤      MEMBERS               │
├────────────────────────────┤         ├────────────────────────────┤
│ id (PK)                    │         │ id (PK)                    │
│ name                       │         │ full_name                  │
│ position (Pembina/Wakil)   │  1:N    │ nisn (UNIQUE)              │
│ nip                        │◄────────│ grade_class                │
│ bio/experience             │         │ position (Ketua/Anggota)   │
│ photo (path)               │         │ join_date                  │
│ created_at, updated_at     │         │ coach_id (FK → Coach)      │
└────────────────────────────┘         │ photo (path)               │
                                       │ created_at, updated_at     │
            ▲                          └────────────────────────────┘
            │                                      │
            │                   ┌──────────────────┘
            │                   │
            │                   ▼ (N:N via event_member)
            │          ┌────────────────────────────┐
            │          │       EVENTS               │
            │          ├────────────────────────────┤
            │  1:N     │ id (PK)                    │
            └──────────│ title                      │
                       │ description                │
                       │ date                       │
                       │ location                   │
                       │ photo (path)               │
                       │ participants (int)         │
                       │ duration (hours)           │
                       │ coach_id (FK → Coach)      │
                       │ created_at, updated_at     │
                       └────────────────────────────┘
                               │
                               │ 1:N
                               ▼
                       ┌────────────────────────────┐
                       │    ACHIEVEMENTS            │
                       ├────────────────────────────┤
                       │ id (PK)                    │
                       │ year                       │
                       │ title                      │
                       │ category                   │
                       │ image (path)               │
                       │ event_id (FK → Event)      │
                       │ created_at, updated_at     │
                       └────────────────────────────┘
                               ▲
                               │
                   ┌───────────────────┐
                   │ (N:N via achievement_member)
                   │
              ┌────▼────────────────────────┐
              │   event_member (Pivot)      │
              ├─────────────────────────────┤
              │ id (PK)                     │
              │ event_id (FK)               │
              │ member_id (FK)              │
              │ status (hadir/tidak/izin)   │
              │ created_at, updated_at      │
              └─────────────────────────────┘


         ┌─────────────────────────────────┐
         │achievement_member (Pivot)       │
         ├─────────────────────────────────┤
         │ id (PK)                         │
         │ achievement_id (FK)             │
         │ member_id (FK)                  │
         │ created_at, updated_at          │
         └─────────────────────────────────┘
```

### Relasi Database

| Relasi | Tipe | Keterangan | Cardinality |
|--------|------|-----------|------------|
| Coach → Member | 1:N | Satu pembina membimbing banyak anggota | 1 Coach : N Members |
| Coach → Event | 1:N | Satu pembina mendampingi banyak event | 1 Coach : N Events |
| Event → Achievement | 1:N | Satu event menghasilkan banyak prestasi | 1 Event : N Achievements |
| Member ↔ Event | N:N | Banyak anggota ikut banyak event | via event_member table |
| Member ↔ Achievement | N:N | Banyak anggota dapat banyak prestasi | via achievement_member table |

### Schema Tabel Detail

**users**
```sql
CREATE TABLE users (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  email_verified_at TIMESTAMP NULL,
  password VARCHAR(255),
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

**coaches**
```sql
CREATE TABLE coaches (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  position VARCHAR(100),
  nip VARCHAR(20),
  bio TEXT,
  photo VARCHAR(255) NULL,
  experience VARCHAR(100),
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

**members**
```sql
CREATE TABLE members (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  full_name VARCHAR(255),
  nisn VARCHAR(10) UNIQUE,
  grade_class VARCHAR(50),
  position VARCHAR(100),
  join_date DATE,
  coach_id BIGINT FOREIGN KEY REFERENCES coaches(id) ON DELETE SET NULL,
  photo VARCHAR(255) NULL,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

**events**
```sql
CREATE TABLE events (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255),
  description TEXT,
  date DATE,
  location VARCHAR(255),
  photo VARCHAR(255) NULL,
  participants INT,
  duration INT,
  coach_id BIGINT FOREIGN KEY REFERENCES coaches(id) ON DELETE SET NULL,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

**achievements**
```sql
CREATE TABLE achievements (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  year INT,
  title VARCHAR(255),
  category VARCHAR(100),
  image VARCHAR(255) NULL,
  event_id BIGINT FOREIGN KEY REFERENCES events(id) ON DELETE SET NULL,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

**event_member (Pivot Table)**
```sql
CREATE TABLE event_member (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  event_id BIGINT FOREIGN KEY REFERENCES events(id) ON DELETE CASCADE,
  member_id BIGINT FOREIGN KEY REFERENCES members(id) ON DELETE CASCADE,
  status VARCHAR(50) DEFAULT 'hadir',
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  UNIQUE KEY unique_event_member (event_id, member_id)
);
```

**achievement_member (Pivot Table)**
```sql
CREATE TABLE achievement_member (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  achievement_id BIGINT FOREIGN KEY REFERENCES achievements(id) ON DELETE CASCADE,
  member_id BIGINT FOREIGN KEY REFERENCES members(id) ON DELETE CASCADE,
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  UNIQUE KEY unique_achievement_member (achievement_id, member_id)
);
```


---

## 🛣 API Routes & Controllers

### Public Routes
```
GET  /                          → PublicController@index         # Beranda
GET  /events                    → PublicController@events        # Daftar Event
GET  /about                     → PublicController@about         # Tentang Kami
GET  /members                   → PublicController@members       # Daftar Anggota
```

### Admin Routes (Protected - Require Auth)
```
GET  /dashboard                 → AdminController@index          # Dashboard

GET  /admin/events              → EventController@index          # Daftar Event
GET  /admin/events/create       → EventController@create         # Form Tambah Event
POST /admin/events              → EventController@store          # Simpan Event Baru
GET  /admin/events/{id}/edit    → EventController@edit           # Form Edit Event
PUT  /admin/events/{id}         → EventController@update         # Update Event
DELETE /admin/events/{id}       → EventController@destroy        # Delete Event

GET  /admin/coaches             → CoachController@index          # Daftar Pembina
GET  /admin/coaches/create      → CoachController@create         # Form Tambah Pembina
POST /admin/coaches             → CoachController@store          # Simpan Pembina
GET  /admin/coaches/{id}/edit   → CoachController@edit           # Form Edit Pembina
PUT  /admin/coaches/{id}        → CoachController@update         # Update Pembina
DELETE /admin/coaches/{id}      → CoachController@destroy        # Delete Pembina

GET  /admin/member              → MemberController@index         # Daftar Anggota
GET  /admin/member/create       → MemberController@create        # Form Tambah Anggota
POST /admin/member              → MemberController@store         # Simpan Anggota
GET  /admin/member/{id}/edit    → MemberController@edit          # Form Edit Anggota
PUT  /admin/member/{id}         → MemberController@update        # Update Anggota
DELETE /admin/member/{id}       → MemberController@destroy       # Delete Anggota
GET  /admin/member/export       → MemberController@export        # Export ke CSV
POST /admin/member/import       → MemberController@import        # Import dari CSV

GET  /admin/achievements        → AchievementController@index    # Daftar Prestasi
GET  /admin/achievements/create → AchievementController@create   # Form Tambah Prestasi
POST /admin/achievements        → AchievementController@store    # Simpan Prestasi
GET  /admin/achievements/{id}/edit → AchievementController@edit  # Form Edit Prestasi
PUT  /admin/achievements/{id}   → AchievementController@update   # Update Prestasi
DELETE /admin/achievements/{id} → AchievementController@destroy  # Delete Prestasi

GET  /login                     → AuthController@show            # Form Login
POST /login                     → AuthController@store           # Process Login
POST /logout                    → AuthController@destroy         # Logout
```

### Controller Responsibilities

| Controller | Fungsi Utama |
|-----------|-------------|
| **PublicController** | Handle halaman publik (home, events, members, about) |
| **EventController** | CRUD event, assign members, assign coach |
| **CoachController** | CRUD pembina, upload foto profil |
| **MemberController** | CRUD anggota, import/export CSV, assign coach |
| **AchievementController** | CRUD prestasi, link members, link events |
| **AdminController** | Dashboard dengan statistik |

---

## 📖 Panduan Penggunaan
1. **Admin Panel** → **Events** → **+ Tambah Event**
2. Isi form: Judul, Deskripsi, Tanggal, Lokasi, Pembina
3. Upload foto (opsional)
4. Simpan
5. ✅ Event muncul di `/events` publik dengan pembina yang mendampingi

### Mengelola Anggota
1. **Admin Panel** → **Anggota** → **+ Tambah Anggota**
2. Isi: Nama, NISN, Kelas, Posisi, **Pembina** (relasi)
3. Simpan
4. ✅ Anggota muncul di `/members` dengan nama dan badge pembina

### Mengelola Pembina
1. **Admin Panel** → **Pembina** → **+ Tambah Pembina**
2. Isi: Nama, Posisi, NIP, Biodata, Upload Foto
3. Simpan
4. ✅ Pembina muncul di `/about` dengan foto profil + biodata

### Mengelola Prestasi
1. **Admin Panel** → **Prestasi** → **+ Tambah Prestasi**
2. Isi: Tahun, Judul, Kategori, Pilih Anggota (relasi)
3. Simpan
4. ✅ Prestasi muncul di `/about` dengan detail lengkap

### Import/Export Anggota
- **Export:** Admin → Anggota → **⬇️ Export Excel**
- **Import:** Admin → Anggota → **⬆️ Import** (CSV/XLSX)

---

## 📁 Struktur Folder

```
Amrhatta/
├── app/
│   ├── Http/Controllers/
│   │   ├── PublicController.php     # Halaman publik
│   │   ├── EventController.php      # CRUD Event
│   │   ├── CoachController.php      # CRUD Pembina
│   │   ├── MemberController.php     # CRUD Anggota
│   │   ├── AchievementController.php # CRUD Prestasi
│   │   └── AdminController.php      # Dashboard
│   └── Models/
│       ├── User.php
│       ├── Member.php
│       ├── Coach.php
│       ├── Event.php
│       └── Achievement.php
├── database/
│   ├── migrations/        # Schema definitions
│   ├── seeders/           # Data awal
│   └── factories/
├── resources/
│   ├── css/
│   │   ├── app.css        # Tailwind
│   │   ├── public.css     # Halaman publik
│   │   └── admin.css      # Dashboard admin
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php     # Layout publik
│       │   └── admin.blade.php   # Layout admin
│       ├── public/
│       │   ├── home.blade.php    # Beranda
│       │   ├── events.blade.php  # Events
│       │   ├── about.blade.php   # Tentang Kami
│       │   └── members.blade.php # Anggota
│       └── admin/
│           ├── events/           # Event CRUD
│           ├── coaches/          # Coach CRUD
│           ├── achievements/     # Achievement CRUD
│           └── member/           # Member CRUD
├── routes/
│   ├── web.php            # Routes publik & admin
│   └── auth.php           # Auth routes
└── storage/app/public/    # Upload folder
    ├── events/
    └── coaches/
```

---

## 🔐 Keamanan

- ✅ Laravel Breeze Authentication
- ✅ Bcrypt password hashing
- ✅ CSRF protection
- ✅ Role-based middleware (IsAdmin)
- ✅ Form validation lengkap
- ✅ File type & size checking

---

## 📝 Development Tips

```bash
# Clear cache
php artisan cache:clear && php artisan view:clear

# Database reset
php artisan migrate:reset && php artisan migrate && php artisan db:seed

# Watch assets
npm run dev

# Check relations
php artisan tinker
```

---

## 📊 Ringkasan Aplikasi

- **5 Model** (User, Member, Coach, Event, Achievement)
- **2 Pivot Tables** (event_member, achievement_member)
- **4 Halaman Publik** (Home, Events, About, Members)
- **4 CRUD Admin** (Event, Coach, Member, Achievement)
- **100% Responsive** pada semua device

---

## 🎓 Informasi Sekolah

```
Nama Sekolah       : SMKN 1 Garut
Organisasi         : Pramuka - Ambalan Mohammad Hatta-Rahmi Hatta
Tahun Berdiri      : 1984
Status Aplikasi    : Active Development
```

---

**Dibuat dengan ❤️ untuk Pramuka SMKN 1 Garut | Update: 2 Desember 2025**
