# 🚀 Setup Guide - Explore Jember

## 📋 Langkah-langkah Setup untuk Teman

### 🔧 1. Clone Repository
```bash
git clone https://github.com/NaufalRazzan23/LensaJember.git
cd LensaJember
```

### 📦 2. Install Dependencies
```bash
composer install
npm install
```

### ⚙️ 3. Setup Environment
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 🗄️ 4. Setup Database
1. **Buat database baru** di phpMyAdmin dengan nama: `explore_jember`
2. **Import database** yang sudah diberikan
3. **Edit file `.env`** sesuaikan database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=explore_jember
DB_USERNAME=root
DB_PASSWORD=
```

### 🔗 5. Create Storage Link
```bash
php artisan storage:link
```

### 🖼️ 6. Setup Images (PENTING!)
**Masalah:** Gambar yang diupload tidak ikut di GitHub

**Solusi:**
1. **Minta folder backup_images** dari teman yang memberikan project
2. **Copy gambar** ke folder yang benar:

#### Windows:
```cmd
# Buat folder jika belum ada
mkdir storage\app\public\wisata
mkdir storage\app\public\wisata\gallery

# Copy gambar dari backup
xcopy backup_images\wisata storage\app\public\wisata /E /Y
```

#### Linux/Mac:
```bash
# Buat folder jika belum ada
mkdir -p storage/app/public/wisata
mkdir -p storage/app/public/wisata/gallery

# Copy gambar dari backup
cp -r backup_images/wisata/* storage/app/public/wisata/
```

### 🚀 7. Start Application
```bash
php artisan serve
```

### 🔐 8. Login Credentials
- **Admin:** admin@admin.com / password
- **User:** user@user.com / password

## 🛠️ Troubleshooting

### ❌ Gambar Tidak Muncul?
1. **Check storage link:**
   ```bash
   php artisan storage:link
   ```

2. **Check folder permissions** (Linux/Mac):
   ```bash
   chmod -R 755 storage/
   chmod -R 755 public/storage/
   ```

3. **Check apakah gambar ada:**
   ```bash
   # Windows
   dir storage\app\public\wisata
   
   # Linux/Mac
   ls -la storage/app/public/wisata/
   ```

### ❌ Database Error?
1. **Check database connection** di `.env`
2. **Import ulang database** jika perlu
3. **Run migration** jika ada error:
   ```bash
   php artisan migrate
   ```

### ❌ Permission Error?
```bash
# Linux/Mac only
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data bootstrap/cache/
```

## 📁 Struktur Folder Gambar

Setelah setup benar, struktur folder harus seperti ini:
```
storage/
├── app/
│   ├── public/
│   │   ├── wisata/           # Featured images
│   │   └── wisata/gallery/   # Gallery images
│   └── ...
public/
├── storage/                  # Symbolic link (dibuat otomatis)
└── ...
```

## 🔍 Cara Check Apakah Setup Berhasil

1. **Buka website:** http://127.0.0.1:8000
2. **Login sebagai admin**
3. **Buka halaman wisata**
4. **Check apakah gambar muncul**

Jika gambar masih tidak muncul, **minta folder backup_images** dari pemberi project!

## 📞 Contact
Jika masih ada masalah, hubungi pemberi project untuk:
- File backup_images/
- Database export terbaru
- Bantuan troubleshooting
