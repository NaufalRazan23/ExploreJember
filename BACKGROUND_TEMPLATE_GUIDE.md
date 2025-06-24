# 🎨 Background Template Guide - Explore Jember

## 📁 Struktur File Background

### **Lokasi File:**
```
public/images/backgrounds/
├── main-bg.jpg          # ⭐ Default untuk semua halaman
├── home-bg.jpg          # 🏠 Halaman beranda
├── auth-bg.jpg          # 🔐 Login & Register
├── admin-bg.jpg         # 👨‍💼 Dashboard admin
├── destinations-bg.jpg  # 🏞️ Halaman wisata
├── search-bg.jpg        # 🔍 Halaman pencarian
└── default-bg.jpg       # 🛡️ Fallback backup
```

## 🚀 Cara Mengganti Background (Super Mudah!)

### **Method 1: Ganti File Langsung**
1. **Siapkan foto** (JPG/PNG, minimal 1920x1080)
2. **Rename foto** sesuai nama yang diinginkan
3. **Upload ke folder** `public/images/backgrounds/`
4. **Replace file lama** dengan nama yang sama
5. **Refresh website** - Background langsung berubah!

### **Method 2: Ganti via Configuration**
1. **Edit file** `config/backgrounds.php`
2. **Ubah nama file** di konfigurasi
3. **Upload foto baru** ke folder backgrounds
4. **Clear cache:** `php artisan config:clear`

## 🎯 Mapping Background per Halaman

| 🌐 Halaman | 📁 File Background | 🎨 CSS Class | 📝 Keterangan |
|------------|-------------------|--------------|---------------|
| **Beranda** | `home-bg.jpg` | `bg-home` | Halaman utama website |
| **Login/Register** | `auth-bg.jpg` | `bg-auth` | Authentication pages |
| **Admin Dashboard** | `admin-bg.jpg` | `bg-admin` | Semua halaman admin |
| **Wisata/Destinations** | `destinations-bg.jpg` | `bg-destinations` | Daftar & detail wisata |
| **Pencarian** | `search-bg.jpg` | `bg-search` | Halaman search |
| **Default** | `main-bg.jpg` | `bg-main` | Fallback untuk halaman lain |

## 📐 Spesifikasi Foto Recommended

### **✅ Ukuran & Format:**
- **Resolusi:** 1920x1080 atau lebih tinggi
- **Aspect Ratio:** 16:9 (landscape)
- **Format:** JPG (recommended), PNG, WebP
- **File Size:** 500KB - 2MB (optimal)

### **✅ Kualitas Foto:**
- **High Resolution** - Tajam dan jelas
- **Good Lighting** - Tidak terlalu gelap/terang
- **Relevant Content** - Sesuai tema tourism Jember
- **No Watermark** - Bersih tanpa logo/text
- **Landscape Orientation** - Horizontal, bukan portrait

## 🎨 Template Konfigurasi

### **File: `config/backgrounds.php`**
```php
'pages' => [
    'home' => [
        'image' => 'home-bg.jpg',        // 📁 Nama file foto
        'class' => 'bg-home',            // 🎨 CSS class
        'overlay' => 'bg-overlay',       // 🔍 Transparansi overlay
    ],
    
    'login' => [
        'image' => 'auth-bg.jpg',
        'class' => 'bg-auth', 
        'overlay' => 'bg-overlay-light', // Lebih transparan
    ],
    
    // Tambah konfigurasi baru di sini...
]
```

### **Overlay Options:**
- `bg-overlay` - 85% transparan (default)
- `bg-overlay-light` - 95% transparan (untuk background gelap)

## 🔧 Commands untuk Manage Background

### **Check Background Status:**
```bash
php artisan background:manage check
```

### **List Available Backgrounds:**
```bash
php artisan background:manage list
```

### **Show Configuration:**
```bash
php artisan background:manage config
```

## 🎯 Contoh Penggunaan

### **Scenario 1: Ganti Background Beranda**
1. Siapkan foto landscape Jember (misal: `jember-sunset.jpg`)
2. Rename menjadi `home-bg.jpg`
3. Upload ke `public/images/backgrounds/`
4. Replace file lama
5. Refresh website - Done! ✅

### **Scenario 2: Tambah Background Baru untuk Profile Page**
1. **Upload foto** `profile-bg.jpg` ke folder backgrounds
2. **Edit** `config/backgrounds.php`:
```php
'user.profile.*' => [
    'image' => 'profile-bg.jpg',
    'class' => 'bg-profile',
    'overlay' => 'bg-overlay',
],
```
3. **Tambah CSS** di `resources/views/layouts/app.blade.php`:
```css
.bg-profile { background-image: url('{{ asset('images/backgrounds/profile-bg.jpg') }}'); }
```
4. **Clear cache:** `php artisan config:clear`

## 🛠️ Troubleshooting

### **❌ Background Tidak Muncul:**
1. ✅ Cek nama file exact match (case-sensitive)
2. ✅ Pastikan file ada di `public/images/backgrounds/`
3. ✅ Clear cache: `php artisan view:clear`
4. ✅ Hard refresh browser: Ctrl+F5

### **❌ Background Blur/Pixelated:**
1. ✅ Upload foto resolusi lebih tinggi (min 1920px)
2. ✅ Gunakan format JPG dengan quality 85-95%
3. ✅ Compress dengan tools: TinyPNG, Squoosh.app

### **❌ Website Loading Lambat:**
1. ✅ Compress foto sebelum upload (max 2MB)
2. ✅ Gunakan format WebP untuk file size kecil
3. ✅ Optimize foto dengan tools online

## 📱 Responsive Design

Background otomatis responsive untuk:
- 🖥️ **Desktop** (1920px+)
- 📱 **Tablet** (768px - 1919px)
- 📱 **Mobile** (320px - 767px)

## 🎨 Rekomendasi Tema Foto

### **✅ Cocok untuk Tourism Website:**
- 🏞️ **Landscape Jember** - Gunung, pantai, sawah
- 🏛️ **Landmark** - Candi, museum, bangunan bersejarah
- 🌅 **Golden Hour** - Sunrise/sunset dengan lighting bagus
- 🎨 **Cultural** - Festival, tradisi, budaya lokal
- 🌿 **Nature** - Taman, hutan, air terjun

### **❌ Hindari:**
- ❌ Foto dengan watermark/logo
- ❌ Foto terlalu gelap atau terlalu terang
- ❌ Foto portrait orientation
- ❌ Foto dengan copyright issues
- ❌ Foto dengan noise/grain tinggi

---

## 🚀 Quick Start

1. **Download foto landscape Jember** (1920x1080+)
2. **Rename sesuai kebutuhan** (home-bg.jpg, auth-bg.jpg, dll)
3. **Upload ke** `public/images/backgrounds/`
4. **Refresh website** - Background langsung berubah!

**💡 Pro Tip:** Gunakan foto dengan tema yang konsisten untuk branding Explore Jember yang kuat!
