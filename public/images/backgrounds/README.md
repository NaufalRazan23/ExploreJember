# Background Images Template

## 📁 Folder Structure
```
public/images/backgrounds/
├── main-bg.jpg          # Default background untuk semua halaman
├── home-bg.jpg          # Background untuk halaman beranda
├── auth-bg.jpg          # Background untuk login & register
├── admin-bg.jpg         # Background untuk halaman admin
├── destinations-bg.jpg  # Background untuk halaman wisata
├── search-bg.jpg        # Background untuk halaman pencarian
└── default-bg.jpg       # Fallback background
```

## 🎨 Cara Mengganti Background

### 1. **Ganti Background Specific Page:**
- Upload foto baru dengan nama yang sama
- Contoh: Ganti `home-bg.jpg` untuk mengubah background beranda

### 2. **Ganti Background Semua Halaman:**
- Upload foto baru dengan nama `main-bg.jpg`
- Atau edit file `config/backgrounds.php` untuk mengubah default

### 3. **Tambah Background Baru:**
1. Upload foto ke folder ini
2. Edit `config/backgrounds.php`
3. Tambahkan konfigurasi baru

## 📐 Spesifikasi Foto

### **Ukuran Recommended:**
- **Resolusi:** 1920x1080 atau lebih tinggi
- **Aspect Ratio:** 16:9 atau 16:10
- **Format:** JPG, PNG, atau WebP
- **File Size:** Maksimal 2MB untuk performa optimal

### **Tips Foto yang Bagus:**
- ✅ **High Resolution** - Minimal 1920px width
- ✅ **Good Lighting** - Foto terang dan jelas
- ✅ **Low Noise** - Hindari foto yang grainy
- ✅ **Relevant Content** - Sesuai dengan tema tourism
- ✅ **Safe Areas** - Hindari detail penting di tepi foto

## 🎯 Mapping Background per Halaman

| Halaman | File Background | Keterangan |
|---------|----------------|------------|
| Beranda | `home-bg.jpg` | Halaman utama website |
| Login/Register | `auth-bg.jpg` | Halaman authentication |
| Admin Dashboard | `admin-bg.jpg` | Semua halaman admin |
| Daftar Wisata | `destinations-bg.jpg` | Halaman wisata & kategori |
| Pencarian | `search-bg.jpg` | Halaman search |
| Default | `main-bg.jpg` | Fallback untuk halaman lain |

## ⚙️ Konfigurasi Advanced

### **Edit Background Config:**
File: `config/backgrounds.php`

```php
'pages' => [
    'home' => [
        'image' => 'home-bg.jpg',        // Nama file
        'class' => 'bg-home',            // CSS class
        'overlay' => 'bg-overlay',       // Overlay transparency
    ],
]
```

### **Overlay Options:**
- `bg-overlay` - Transparan 85% (default)
- `bg-overlay-light` - Transparan 95% (untuk teks gelap)

## 🔧 Troubleshooting

### **Background Tidak Muncul:**
1. Cek nama file harus exact match
2. Pastikan file ada di folder `public/images/backgrounds/`
3. Clear cache: `php artisan view:clear`
4. Refresh browser dengan Ctrl+F5

### **Background Blur/Pixelated:**
1. Upload foto dengan resolusi lebih tinggi
2. Compress foto dengan tools online
3. Gunakan format WebP untuk file size kecil

### **Performance Issues:**
1. Compress foto sebelum upload
2. Gunakan format WebP
3. Maksimal file size 2MB

## 📱 Responsive Design

Background akan otomatis responsive untuk:
- ✅ **Desktop** (1920px+)
- ✅ **Tablet** (768px - 1919px)  
- ✅ **Mobile** (320px - 767px)

## 🎨 Rekomendasi Foto

### **Tema yang Cocok:**
- 🏞️ **Landscape Jember** - Pemandangan alam
- 🏛️ **Landmark** - Bangunan bersejarah
- 🌅 **Golden Hour** - Foto dengan lighting bagus
- 🎨 **Cultural** - Budaya dan tradisi lokal
- 🌿 **Nature** - Alam dan taman

### **Hindari:**
- ❌ Foto dengan watermark
- ❌ Foto terlalu gelap/terang
- ❌ Foto dengan teks/logo besar
- ❌ Foto portrait orientation
- ❌ Foto dengan copyright issues

---

**💡 Tip:** Gunakan tools seperti TinyPNG atau Squoosh.app untuk compress foto sebelum upload!
