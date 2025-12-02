# 🎯 Sistem Informasi & Administrasi Pramuka SMKN 1 Garut

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

1. [Teknologi](#teknologi)
2. [Instalasi Cepat](#instalasi-cepat)
3. [Fitur Utama](#fitur-utama)
4. [Struktur Database & ERD](#struktur-database--erd)
5. [Panduan Penggunaan](#panduan-penggunaan)
6. [Struktur Folder](#struktur-folder)

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

## 🗄 Struktur Database & ERD

### Entity Relationship Diagram

```
┌──────────────────────────────────────────────────────────┐
│            PRAMUKA SMKN 1 GARUT - DATABASE              │
└──────────────────────────────────────────────────────────┘

                        ┌─────────────┐
                        │    User     │
                        ├─────────────┤
                        │ id (PK)     │
                        │ name        │
                        │ email       │
                        │ password    │
                        │ timestamps  │
                        └─────────────┘


                      ┌────────────────┐
                      │     Coach      │
                      ├────────────────┤
                      │ id (PK)        │
                      │ name           │
                      │ position       │
                      │ nip            │
                      │ bio            │
                      │ photo          │
                      │ experience     │
                      │ timestamps     │
                      └────────────────┘
                           ▲
               ┌────────────┬┘
               │ coach_id   │
               │     FK     │
        ┌──────▼──┐    ┌────▼──────────┐
        │ Member  │    │    Event      │
        ├─────────┤    ├───────────────┤
        │ id (PK) │    │ id (PK)       │
        │ name    │    │ title         │
        │ nisn    │    │ description   │
        │ class   │    │ date          │
        │ position│    │ location      │
        │ coach_id│───▶│ photo         │
        │ join    │    │ participants  │
        │ date    │    │ duration      │
        └───┬─────┘    │ coach_id (FK) │
            │          │ timestamps    │
            │          └───────────────┘
            │                 ▲
      ┌─────┴────────────┐    │
      │                  │    │
   ┌──▼────────────┐  ┌──┴────────────────┐
   │ event_member  │  │  Achievement     │
   ├───────────────┤  ├──────────────────┤
   │ id (PK)       │  │ id (PK)          │
   │ event_id (FK) │  │ year             │
   │ member_id(FK) │  │ title            │
   │ status        │  │ category         │
   │ timestamps    │  │ image            │
   └───────────────┘  │ event_id (FK)    │
                      │ timestamps       │
      ┌───────────────┤──────────────────┤
      │               │                  │
 ┌────▼─────────────────┐               │
 │achievement_member    │               │
 ├──────────────────────┤               │
 │id (PK)               │               │
 │achievement_id (FK)◄──┤───────────────┘
 │member_id (FK) ◄──────┤────────┐
 │timestamps            │        │
 └──────────────────────┘        │
                                 │
                    (many-to-many join table)
```

### Relasi Database

| Relasi | Tipe | Keterangan |
|--------|------|-----------|
| Coach → Member | 1:N | Satu pembina : banyak anggota |
| Coach → Event | 1:N | Satu pembina : banyak event |
| Event → Achievement | 1:N | Satu event : banyak prestasi |
| Member ↔ Event | N:N | Melalui `event_member` table |
| Member ↔ Achievement | N:N | Melalui `achievement_member` table |

### Tabel Utama

**Users** - Admin login  
```sql
id, name, email, password, created_at, updated_at
```

**Members** - Anggota Pramuka  
```sql
id, full_name, nisn, grade_class, position, join_date, coach_id, created_at, updated_at
```

**Coaches** - Pembina  
```sql
id, name, position, nip, bio, photo, experience, created_at, updated_at
```

**Events** - Kegiatan  
```sql
id, title, description, date, location, photo, participants, duration, coach_id, created_at, updated_at
```

**Achievements** - Prestasi  
```sql
id, year, title, category, image, event_id, created_at, updated_at
```

**Pivot Tables:**
- `event_member(id, event_id, member_id, status, created_at, updated_at)` - Hubung Member ↔ Event
- `achievement_member(id, achievement_id, member_id, created_at, updated_at)` - Hubung Member ↔ Achievement

---

## 📖 Panduan Penggunaan

### Login Admin
```
URL: http://localhost:8000/login
Email: admin@example.test
Password: password
```

### Mengelola Event
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
