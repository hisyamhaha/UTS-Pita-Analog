# SK04 — Aplikasi Preservasi & Restorasi Pita Analog
**Ujian Tengah Semester (UTS) Pemrograman Framework**
- **NIM**: 422410033
- **Nama**: Hisyam K.
- **Topik Studi Kasus**: SK04 — Restorasi Pita Analog
- **Teknologi**: Laravel 12 + MySQL + Tailwind CSS v4 + Vite

---

## 📻 Deskripsi Aplikasi
Aplikasi pendataan dan preservasi arsip koleksi pita rekaman analog (Cassette Tape, Reel-to-Reel, 8-Track, DAT, Elcaset, Microcassette). Sistem ini dirancang untuk mendata kondisi fisik pita, mengklasifikasikan tingkat kerusakan fisik, serta mengelola rencana, proses, dan penyelesaian tindakan restorasi laboratorium audio menggunakan alur kerja transaksional database.

### UI / Design System
Antarmuka dirancang khusus bertema **Retro Analog Cassette & Studio Archive**:
- **Palet Warna Earthy**: Cokelat pita magnetik (`#241a14`, `#54392b`), Krem kertas sampul (`#f9f5ed`, `#f4ebd9`, `#e7d8c0`), Hijau zaitun studio (`#4f5d2f`), Amber/oranye indikator VU (`#c96b1b`), dan Karat peringatan (`#9e3820`).
- **Elemen Grafis Analog**: Spool reel kaset berputar, garis pita kaset 3 warna (vintage label stripes), tape counter digital mekanis, VU meter audio bar, dan aksen sekrup di sudut modul.
- **Tipografi**: Aksentuasi monospace (`Space Mono`) untuk kode koleksi, status, serial, dan data teknis, dipadu dengan font sans-serif modern (`Plus Jakarta Sans`) untuk keterbacaan data.
- **Brutalisme Retro**: Border tebal 2px (`border-2 border-[#241a14]`) dan drop shadow keras tanpa blur (`shadow-retro`: `4px 4px 0px 0px #241a14`).

---

## 🗄️ Entitas & Relasi Database (Eloquent)

1. **Kategori Format** (`kategori_formats`) — Master Format:
   - Relasi: `hasMany` ke `KoleksiPita`.
   - Atribut: `id`, `nama_format`, `deskripsi`, `timestamps`.

2. **Koleksi Pita** (`koleksi_pitas`) — Entitas Utama:
   - Relasi: `belongsTo` ke `KategoriFormat`.
   - Relasi: `hasOne` ke `DetailKondisi`.
   - Relasi: `belongsToMany` ke `TindakanRestorasi` (via pivot `koleksi_tindakan`).
   - Atribut: `id`, `kode_koleksi` (unik), `nama_koleksi`, `kategori_format_id`, `tahun`, `deskripsi`, `timestamps`.

3. **Detail Kondisi** (`detail_kondisis`) — One-to-One:
   - Relasi: `belongsTo` ke `KoleksiPita`.
   - Atribut: `id`, `koleksi_pita_id` (foreign key & unique), `kondisi_awal`, `tingkat_kerusakan` (enum: `ringan`, `sedang`, `berat`), `catatan`, `timestamps`.

4. **Tindakan Restorasi** (`tindakan_restorasis`) — Master Tindakan:
   - Relasi: `belongsToMany` ke `KoleksiPita` (via pivot `koleksi_tindakan`).
   - Atribut: `id`, `nama_tindakan`, `deskripsi`, `timestamps`.

5. **Pivot Koleksi-Tindakan** (`koleksi_tindakan`) — Many-to-Many:
   - Atribut Pivot: `id`, `koleksi_pita_id`, `tindakan_restorasi_id`, `status` (enum: `rencana`, `proses`, `selesai`), `tanggal_mulai`, `tanggal_selesai`, `catatan`, `timestamps`.
   - Didefinisikan dengan `->withPivot(['id', 'status', 'tanggal_mulai', 'tanggal_selesai', 'catatan'])->withTimestamps()`.

---

## ⚡ Fitur Utama

- **Dashboard Statistik & Telemetri**:
  - Ringkasan total koleksi pita, total kategori format, total tindakan master.
  - Jumlah tindakan aktif di meja kerja (`proses`) dan tindakan terpreservasi (`selesai`).
  - Bar meter persentase distribusi kerusakan fisik (Ringan, Sedang, Berat).
  - Monitoring antrean meja kerja konservator (status `proses`).
  - Tabel 5 pita koleksi terbaru yang masuk ke sistem.
- **Manajemen Koleksi Pita**:
  - Pencarian fleksibel berdasarkan kode koleksi atau judul rekaman.
  - Filter ganda berdasarkan kategori format, tingkat kerusakan, dan status restorasi.
  - Form pendaftaran & edit terpadu: menyimpan data koleksi, detail kondisi (one-to-one), dan pilihan tindakan pivot (many-to-many) sekaligus dalam satu **DB Transaction** via `KoleksiService`.
  - Tampilan detail bergaya kaset tape lengkap dengan grafik spool reel, label sleeve, status kerusakan, dan alur tindakan restorasi.
  - Hapus koleksi dengan konfirmasi aman (cascade otomatis membersihkan detail & pivot).
- **Master Data Kategori Format**:
  - CRUD lengkap dengan validasi keunikan format dan proteksi relasi.
- **Master Data Tindakan Restorasi**:
  - CRUD lengkap standar operasional preservasi pita magnetik.

---

## 🚀 Panduan Instalasi & Menjalankan Proyek

### 1. Kebutuhan Sistem
- PHP >= 8.2 (ekstensi `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`)
- Composer >= 2.0
- MySQL / MariaDB (XAMPP / Standalone)
- Node.js >= 18.x & NPM

### 2. Kloning / Akses Direktori Proyek
```bash
cd UTS_422410033_Hisyam_K_SK04
```

### 3. Instalasi Dependency PHP & Node
```bash
composer install
npm install
```

### 4. Konfigurasi Lingkungan (.env)
Pastikan berkas `.env` telah disesuaikan dengan koneksi database MySQL:
```env
APP_NAME="SK04 Restorasi Pita Analog"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uts_sk04_restorasi_pita
DB_USERNAME=root
DB_PASSWORD=
```

Buat database di MySQL jika belum ada:
```sql
CREATE DATABASE uts_sk04_restorasi_pita CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Generate application key:
```bash
php artisan key:generate
```

### 5. Menjalankan Migrasi & Seeding Data Dummy
Jalankan perintah berikut untuk membuat seluruh tabel dan menyuntikkan data seeder:
```bash
php artisan migrate:fresh --seed
```
*Hasil seeder:*
- **11 Kategori Format** (C-60/C-90 Type I, CrO2 Type II, Metal Type IV, Reel 1/4" 15 ips, 8-Track, DAT, Elcaset, dsb).
- **11 Tindakan Restorasi** (Tape Baking, Pembersihan Jamur Ultrasonik, Splicing Block, Azimuth Alignment, Re-housing, dsb).
- **24 Koleksi Pita Analog** (arsip musik & sejarah lisan Indonesia legendaris).
- **24 Detail Kondisi Fisik** (kondisi awal, tingkat kerusakan ringan/sedang/berat, catatan).
- **65+ Relasi Pivot Koleksi-Tindakan** (status rencana/proses/selesai, tanggal mulai/selesai, catatan teknis).

### 6. Build Frontend Asset (Vite + Tailwind CSS v4)
```bash
npm run build
```
Atau untuk mode pengembangan:
```bash
npm run dev
```

### 7. Menjalankan Web Server
```bash
php artisan serve
```
Akses aplikasi melalui browser di: **http://localhost:8000** atau **http://127.0.0.1:8000**

---

## 🧪 Pengujian Otomatis (Testing)
Jalankan pengujian unit dan fitur:
```bash
php artisan test
```
Semua 8 unit & feature tests terverifikasi PASS (Dashboard, Index Katalog, Show Detail, KoleksiService DB Transaction, CRUD Kategori, CRUD Tindakan).

---

## 📐 Dokumentasi Diagram (Mermaid & PNG)
Diagram arsitektur dan basis data tersimpan di dalam folder `docs/`:
- `docs/class-diagram.md` & `docs/class-diagram.png`: Relasi class Eloquent model & service.
- `docs/erd.md` & `docs/erd.png`: Entity-Relationship Diagram basis data relasional.

Perintah untuk regenerasi diagram via Mermaid CLI:
```bash
npx -p @mermaid-js/mermaid-cli mmdc -i docs/class-diagram.md -o docs/class-diagram.png -b "#FAF6EE"
npx -p @mermaid-js/mermaid-cli mmdc -i docs/erd.md -o docs/erd.png -b "#FAF6EE"
```
