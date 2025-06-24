# 🌟 Explore Jember - Lensa Wisata Digital

<div align="center">
  
  ![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
  ![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white)
  ![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
  ![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

  **Platform digital untuk mengeksplorasi destinasi wisata terbaik di Kabupaten Jember** 🏞️

  [Demo Live](https://github.com/NaufalRazan23/ExploreJember) • [Dokumentasi](#-instalasi) • [Kontribusi](#-kontribusi)

</div>

---

## 📋 Deskripsi

**Explore Jember** adalah aplikasi web yang dirancang khusus untuk mempromosikan dan mengelola destinasi wisata di Kabupaten Jember. Platform ini menyediakan antarmuka yang user-friendly baik untuk wisatawan yang ingin mengeksplorasi tempat-tempat menarik maupun admin yang perlu mengelola data wisata.

### ✨ Fitur Utama

- 🏠 **Dashboard Interaktif** - Tampilan homepage yang menarik dengan informasi wisata terkini
- 🗂️ **Manajemen Wisata** - CRUD lengkap untuk destinasi wisata dengan kategori
- 🖼️ **Galeri Foto** - Upload dan manajemen gambar wisata yang responsif
- 📍 **Peta Lokasi** - Integrasi koordinat geografis untuk setiap destinasi
- 🔍 **Pencarian & Filter** - Sistem pencarian berdasarkan nama, kategori, dan lokasi
- 👥 **Multi-Role System** - Pembagian akses untuk Admin dan User
- 📱 **Responsive Design** - Tampilan optimal di semua perangkat
- 💰 **Info Harga Tiket** - Informasi lengkap biaya masuk dan fasilitas

## 🎯 Target Pengguna

- 🧳 **Wisatawan** - Mencari informasi destinasi wisata di Jember
- 🏛️ **Pengelola Wisata** - Mengelola dan mempromosikan destinasi
- 🎓 **Pelajar/Mahasiswa** - Referensi untuk tugas atau penelitian
- 🏢 **Dinas Pariwisata** - Platform resmi promosi wisata daerah

## 🛠️ Teknologi yang Digunakan

| Kategori | Teknologi |
|----------|-----------|
| **Backend** | Laravel 10.x, PHP 8.1+ |
| **Frontend** | Blade Templates, TailwindCSS, JavaScript |
| **Database** | MySQL |
| **Storage** | Laravel Storage (Public Disk) |
| **Authentication** | Laravel Built-in Auth |
| **Development** | Vite, Composer, NPM |

## 📂 Struktur Project

```
ExploreJember/
├── 📁 app/
│   ├── 📁 Http/Controllers/
│   │   ├── 📁 Admin/          # Controller untuk admin panel
│   │   ├── 📁 Auth/           # Authentication controllers
│   │   └── 📁 User/           # User-facing controllers
│   ├── 📁 Models/             # Eloquent models
│   └── 📁 Services/           # Business logic services
├── 📁 resources/
│   └── 📁 views/
│       ├── 📁 admin/          # Admin panel views
│       ├── 📁 auth/           # Login/Register views
│       └── 📁 layouts/        # Layout templates
├── 📁 database/
│   ├── 📁 migrations/         # Database migrations
│   └── 📁 seeders/           # Sample data seeders
└── 📁 public/
    └── 📁 images/            # Static assets & backgrounds
```

## ⚡ Instalasi

### Prasyarat
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- Git

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/NaufalRazan23/ExploreJember.git
   cd ExploreJember
   ```

2. **Install Dependencies**
   ```bash
   # Install PHP dependencies
   composer install
   
   # Install Node.js dependencies
   npm install
   ```

3. **Setup Environment**
   ```bash
   # Copy environment file
   cp .env.example .env
   
   # Generate application key
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=explore_jember
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Setup Database**
   ```bash
   # Jalankan migrations
   php artisan migrate
   
   # Jalankan seeders (data sample)
   php artisan db:seed
   ```

6. **Setup Storage**
   ```bash
   # Buat symbolic link untuk storage
   php artisan storage:link
   ```

7. **Setup Images** ⚠️ **PENTING!**
   ```bash
   # Windows
   mkdir storage\app\public\wisata
   mkdir storage\app\public\wisata\gallery
   xcopy backup_images\wisata storage\app\public\wisata /E /Y
   
   # Linux/Mac
   mkdir -p storage/app/public/wisata
   mkdir -p storage/app/public/wisata/gallery
   cp -r backup_images/wisata/* storage/app/public/wisata/
   ```

8. **Jalankan Aplikasi**
   ```bash
   # Development server
   php artisan serve
   
   # Build assets (di terminal terpisah)
   npm run dev
   ```

9. **Akses Aplikasi**
   - URL: `http://127.0.0.1:8000`
   - Admin: `admin@admin.com` / `password`
   - User: `user@user.com` / `password`

## 👤 Akun Default

| Role | Email | Password | Akses |
|------|-------|----------|-------|
| **Admin** | admin@admin.com | password | Panel admin lengkap |
| **User** | user@user.com | password | Browsing wisata |

## 🎨 Fitur Detail

### 🏛️ Panel Admin
- **Dashboard** - Statistik dan overview data wisata
- **Kelola Wisata** - CRUD destinasi dengan upload gambar
- **Kelola Kategori** - Manajemen kategori wisata
- **Kelola User** - Manajemen pengguna sistem
- **Profile Management** - Update informasi admin

### 🧭 Interface User
- **Homepage** - Showcase wisata unggulan
- **Katalog Wisata** - Daftar lengkap destinasi
- **Detail Wisata** - Informasi lengkap + galeri foto
- **Pencarian** - Filter berdasarkan kategori dan lokasi
- **Profile** - Manajemen akun pengguna

## 🔧 Troubleshooting

### ❌ Gambar Tidak Muncul?
1. Cek storage link: `php artisan storage:link`
2. Pastikan folder permissions benar
3. Copy gambar dari `backup_images/` ke `storage/app/public/wisata/`

### ❌ Database Error?
1. Cek konfigurasi `.env`
2. Pastikan database MySQL sudah running
3. Import ulang dengan `php artisan migrate:fresh --seed`

### ❌ Permission Error? (Linux/Mac)
```bash
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data bootstrap/cache/
chmod -R 755 storage/
```

## 🤝 Kontribusi

Kami menerima kontribusi! Berikut cara berkontribusi:

1. **Fork** repository ini
2. **Buat branch** fitur baru (`git checkout -b feature/AmazingFeature`)
3. **Commit** perubahan (`git commit -m 'Add some AmazingFeature'`)
4. **Push** ke branch (`git push origin feature/AmazingFeature`)
5. **Buat Pull Request**

## 📄 Lisensi

Project ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk detail.

## 👨‍💻 Developer

**Naufal Razzan**
- GitHub: [@NaufalRazan23](https://github.com/NaufalRazan23)
- Email: [naufal.razzan@example.com](mailto:naufal.razzan@example.com)

## 🙏 Acknowledgments

- **Laravel Framework** - Framework PHP yang amazing
- **TailwindCSS** - Utility-first CSS framework
- **Kabupaten Jember** - Inspirasi destinasi wisata
- **Universitas Jember** - Dukungan akademik

---

<div align="center">

**⭐ Jangan lupa berikan star jika project ini membantu! ⭐**

**Made with ❤️ for Jember Tourism**

</div>
