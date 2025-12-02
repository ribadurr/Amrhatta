# USE CASE DIAGRAM - Pramuka SMKN 1 Garut

## Diagram Visual

```
                        ADMIN PANEL
                            │
            ┌───────────────────────────────────┐
            │                                   │
            ↓                                   ↓
    ┌──────────────────┐          ┌──────────────────────┐
    │  Manage Members  │          │  Manage Events       │
    │  - Create        │          │  - Create            │
    │  - Read/View     │          │  - Edit              │
    │  - Update        │          │  - Delete            │
    │  - Delete        │          │  - Assign Members    │
    │  - Export (CSV)  │          │  - Assign Coach      │
    │  - Import (CSV)  │          └──────────────────────┘
    └──────────────────┘                    │
            │                                │
            │                                ↓
            │                    ┌──────────────────────┐
            │                    │  Manage Achievements │
            │                    │  - Create            │
            │                    │  - Edit              │
            │                    │  - Delete            │
            │                    │  - Link Members      │
            │                    │  - Link Events       │
            │                    └──────────────────────┘
            │                                │
            │                                ↓
            └───────────────────────────────────┘
                           │
                           ↓
                    ┌──────────────────────┐
                    │  Manage Coaches      │
                    │  - Create            │
                    │  - Edit              │
                    │  - Delete            │
                    │  - Upload Photo      │
                    └──────────────────────┘


                        PUBLIC PAGES
                            │
            ┌───────────────────────────────────┐
            │                                   │
            ↓                                   ↓
    ┌──────────────────┐          ┌──────────────────────┐
    │  Browse Members  │          │  Browse Events       │
    │  - View List     │          │  - View Upcoming     │
    │  - Paginate      │          │  - View Details      │
    │  - Filter        │          │  - See Coach Info    │
    └──────────────────┘          └──────────────────────┘
            │                                │
            │                                ↓
            │                    ┌──────────────────────┐
            │                    │  View About/Info     │
            │                    │  - History           │
            │                    │  - Vision/Mission    │
            │                    │  - Achievements      │
            │                    │  - Coaches Profile   │
            │                    └──────────────────────┘
            │                                │
            │                                ↓
            └───────────────────────────────────┘
                           │
                           ↓
                    ┌──────────────────────┐
                    │  Authentication      │
                    │  - Login             │
                    │  - Logout            │
                    │  - Register (future) │
                    └──────────────────────┘
```

---

## Penjelasan Singkat Use Cases

### 🔐 ADMIN PANEL (Manajemen Data)

#### 1. **Manage Members** (Kelola Anggota)
**Deskripsi:**
Admin dapat mengelola data anggota Pramuka dengan lengkap.

**Use Cases:**
- **Create** - Tambah anggota baru dengan foto, NISN, kelas, jabatan
- **Read/View** - Melihat daftar semua anggota dengan detail lengkap
- **Update** - Edit data anggota (nama, kelas, jabatan, foto)
- **Delete** - Hapus anggota dari sistem
- **Export (CSV)** - Export daftar anggota ke file Excel/CSV
- **Import (CSV)** - Import data anggota dari file CSV/Excel (batch)

**Contoh Alur:** Admin buka halaman Members → Klik "Tambah Anggota" → Isi form (nama, NISN, kelas, foto) → Simpan → Anggota muncul di list

---

#### 2. **Manage Events** (Kelola Kegiatan)
**Deskripsi:**
Admin dapat membuat dan mengelola event/kegiatan Pramuka.

**Use Cases:**
- **Create** - Buat event baru (judul, tanggal, lokasi, durasi, foto)
- **Edit** - Ubah detail event yang sudah dibuat
- **Delete** - Hapus event dari sistem
- **Assign Members** - Pilih anggota mana saja yang ikut event (via checklist)
- **Assign Coach** - Tentukan pembina yang mengawasi event

**Contoh Alur:** Admin buat event "Camping" → Pilih tanggal & lokasi → Upload foto event → Centang anggota yang ikut → Pilih pembina → Simpan

---

#### 3. **Manage Achievements** (Kelola Prestasi)
**Deskripsi:**
Admin dapat mencatat prestasi/penghargaan yang diraih anggota.

**Use Cases:**
- **Create** - Buat prestasi baru (nama, tahun, kategori)
- **Edit** - Ubah detail prestasi
- **Delete** - Hapus prestasi
- **Link Members** - Hubungkan prestasi ke anggota yang mendapatkannya (bisa multiple)
- **Link Events** - Hubungkan prestasi ke event mana yang menghasilkan prestasi itu

**Contoh Alur:** Admin input prestasi "Juara Lomba Camping 2024" → Link ke member (Ade, Budi, Citra) → Link ke Event "Camping 2024" → Simpan

---

#### 4. **Manage Coaches** (Kelola Pembina)
**Deskripsi:**
Admin dapat mengelola data pembina/instruktur.

**Use Cases:**
- **Create** - Tambah pembina baru (nama, NIP, posisi, bio)
- **Edit** - Edit data pembina
- **Delete** - Hapus pembina dari sistem
- **Upload Photo** - Unggah/ubah foto profil pembina

**Contoh Alur:** Admin tambah pembina "Pak Suprapto" → Input NIP & posisi → Upload foto profil → Simpan

---

### 👥 PUBLIC PAGES (Halaman Publik)

#### 5. **Browse Members** (Lihat Daftar Anggota)
**Deskripsi:**
Pengunjung website dapat melihat daftar anggota Pramuka.

**Use Cases:**
- **View List** - Melihat daftar semua anggota dalam bentuk grid/card
- **Paginate** - Navigasi ke halaman berikutnya jika anggota banyak
- **Filter** - Cari anggota berdasarkan nama atau kriteria lain (optional)

**Contoh Alur:** Pengunjung buka halaman "Keanggotaan" → Lihat daftar anggota dengan foto → Klik "Next" untuk halaman berikutnya

---

#### 6. **Browse Events** (Lihat Daftar Kegiatan)
**Deskripsi:**
Pengunjung dapat melihat kegiatan-kegiatan yang akan atau sudah dilakukan.

**Use Cases:**
- **View Upcoming** - Melihat event yang akan datang
- **View Details** - Klik event untuk melihat detail lengkap
- **See Coach Info** - Melihat pembina yang mengawasi event

**Contoh Alur:** Pengunjung buka "Event" → Lihat daftar event mendatang → Klik "Camping" → Lihat detail (tanggal, lokasi, pembina, anggota yang ikut)

---

#### 7. **View About/Info** (Lihat Info Tentang Kami)
**Deskripsi:**
Pengunjung dapat membaca informasi lengkap tentang organisasi.

**Use Cases:**
- **History** - Membaca sejarah Pramuka di sekolah
- **Vision/Mission** - Melihat visi dan misi organisasi
- **Achievements** - Melihat prestasi-prestasi yang telah diraih
- **Coaches Profile** - Melihat profil pembina dan bidangnya

**Contoh Alur:** Pengunjung buka "Tentang Kami" → Baca sejarah → Lihat visi/misi → Scroll ke prestasi → Lihat profil pembina dengan foto

---

#### 8. **Authentication** (Autentikasi)
**Deskripsi:**
Sistem login untuk akses admin.

**Use Cases:**
- **Login** - Admin masuk menggunakan email & password
- **Logout** - Admin keluar dari sistem
- **Register** (future) - Fitur registrasi user baru (direncanakan)

**Contoh Alur:** Admin input email → Input password → Klik "Masuk" → Redirect ke dashboard

---

## Tabel Ringkas Use Cases

| No | Use Case | Actor | Deskripsi |
|----|-----------|---------|----|
| 1 | Create Member | Admin | Tambah anggota baru dengan data lengkap |
| 2 | Read/View Members | Admin, Public | Lihat daftar anggota |
| 3 | Update Member | Admin | Edit data anggota |
| 4 | Delete Member | Admin | Hapus anggota dari sistem |
| 5 | Export Members | Admin | Download data anggota ke CSV |
| 6 | Import Members | Admin | Upload daftar anggota dari CSV |
| 7 | Create Event | Admin | Buat kegiatan baru |
| 8 | Edit Event | Admin | Ubah detail kegiatan |
| 9 | Delete Event | Admin | Hapus kegiatan |
| 10 | Assign Members to Event | Admin | Pilih anggota yang ikut event |
| 11 | Create Achievement | Admin | Buat prestasi baru |
| 12 | Link Achievement to Members | Admin | Hubungkan prestasi ke anggota |
| 13 | Create Coach | Admin | Tambah pembina baru |
| 14 | View Member List | Public | Lihat daftar anggota publik |
| 15 | View Event List | Public | Lihat daftar kegiatan publik |
| 16 | View About Info | Public | Baca informasi organisasi |
| 17 | Login | Admin | Masuk ke sistem admin |
| 18 | Logout | Admin | Keluar dari sistem admin |

---

## Aktor Dalam Sistem

### 1. **Admin**
- Orang yang mengelola seluruh data sistem
- Akses penuh ke CRUD (Create, Read, Update, Delete)
- Bisa upload/manage foto dan file
- Bisa export/import data

### 2. **Public User (Pengunjung)**
- Orang yang mengakses website Pramuka
- Hanya bisa melihat (Read) data publik
- Tidak bisa edit atau hapus data
- Bisa melihat: anggota, event, prestasi, info organisasi

### 3. **System (Optional Future)**
- Automated email notifications
- Scheduled tasks (backup data, cleanup)
- Reporting system

---

## Hubungan Antar Use Cases

**Hierarki:**
```
Manage Members
├── Create Member (dengan foto upload)
├── Read Members (lihat di list publik)
├── Update Member (edit data/foto)
├── Delete Member
├── Export Members (CSV)
└── Import Members (CSV)

Manage Events
├── Create Event (dengan foto)
├── Edit Event
├── Delete Event
└── Assign Members (N:N relationship)

Manage Achievements
├── Create Achievement
├── Edit Achievement
├── Delete Achievement
├── Link Members (N:N relationship)
└── Link Events (1:N relationship)

Browse (Public)
├── View Member List (paginated, with photos)
├── View Event List (upcoming)
├── View About/Achievements/Coaches
└── Authentication (Login/Logout)
```

---

## Key Features dari Use Cases

✅ **Photo Management** - Setiap member, event, coach bisa punya foto
✅ **Many-to-Many Relationships** - Member bisa ikut banyak event, event bisa punya banyak member
✅ **CSV Import/Export** - Bulk operation untuk member
✅ **Pagination** - Handle banyak data dengan pagination
✅ **Dark Theme UI** - Semua interface menggunakan dark theme dengan gold accent
✅ **Responsive Design** - Bisa diakses dari mobile, tablet, desktop
✅ **Role-Based Access** - Admin vs Public User memiliki hak akses berbeda

---

**Dokumentasi dibuat:** 2 Desember 2025
**Sistem:** Pramuka SMKN 1 Garut
**Framework:** Laravel 11.x
