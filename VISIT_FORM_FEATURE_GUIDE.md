# 🎯 Fitur Form Kunjungan Wisata - Dokumentasi

## 📋 Overview
Fitur ini memungkinkan user (bukan admin) untuk mengisi form kunjungan pada setiap tempat wisata. Setiap user hanya bisa membuat satu form per destinasi, namun form tersebut bisa diedit kapan saja.

## ✨ Fitur yang Ditambahkan

### 1. 📝 Form Kunjungan
- **Tanggal Kunjungan**: User memilih hari dan tanggal kunjungan
- **Waktu Datang & Pergi**: Input dalam format jam (HH:MM)
- **Jenis Kunjungan**: 
  - Sendirian
  - Rombongan (memunculkan field jumlah orang)
- **Jumlah Orang**: Wajib diisi jika memilih rombongan (min: 2, max: 100)
- **Saran**: Input untuk memberikan saran pengembangan tempat wisata
- **Review**: Input untuk memberikan review tempat wisata

### 2. 🔐 Akses Control
- **Hanya User** yang bisa mengisi form (Admin tidak bisa)
- **Satu akun = satu form** per destinasi
- **Form bisa diedit** kapan saja oleh user yang sama
- **Form bisa dihapus** oleh user yang membuatnya

### 3. 📊 Penghitung Pengunjung
- Menampilkan **total pengunjung** di setiap halaman wisata
- Dihitung berdasarkan jumlah user yang telah mengisi form

## 🗂️ File yang Dibuat/Dimodifikasi

### Database
1. **Migration**: `2025_06_24_182647_create_visit_forms_table.php`
   - Tabel untuk menyimpan data form kunjungan
   - Relationship ke users dan destinations
   - Unique constraint untuk user_id + destination_id

2. **Model**: `app/Models/VisitForm.php`
   - Model untuk handle visit forms
   - Relationships ke User dan Destination

### Controllers
1. **VisitFormController**: `app/Http/Controllers/User/VisitFormController.php`
   - `store()`: Menyimpan/update form kunjungan
   - `show()`: Mengambil data form user
   - `destroy()`: Menghapus form kunjungan

2. **HomeController**: Update method `show()`
   - Menambahkan data userVisitForm dan totalVisitors

### Routes
- `POST user/wisata/{destination}/visit-form` - Simpan/update form
- `GET user/wisata/{destination}/visit-form` - Ambil data form
- `DELETE user/wisata/{destination}/visit-form` - Hapus form

### Views
1. **wisata/show.blade.php**: 
   - Tombol "Isi Form Kunjungan"
   - Modal popup dengan form lengkap
   - Counter total pengunjung
   - JavaScript untuk handling form

2. **layouts/app.blade.php**:
   - Menambahkan CSRF meta tag

### Models Update
1. **User.php**: Menambahkan relationship `visitForms()`
2. **Destination.php**: 
   - Menambahkan relationship `visitForms()`
   - Menambahkan accessor `getTotalVisitorsAttribute()`

## 🎮 Cara Penggunaan

### Untuk User:
1. **Login sebagai user** (bukan admin)
2. **Buka halaman detail wisata** 
3. **Klik tombol "Isi Form Kunjungan"** (hijau)
4. **Isi form** dalam modal popup:
   - Pilih tanggal kunjungan (minimal hari ini)
   - Isi waktu datang dan pergi
   - Pilih jenis kunjungan (sendirian/rombongan)
   - Jika rombongan, isi jumlah orang
   - Isi saran dan review (optional)
5. **Klik "Simpan"**

### Fitur Edit:
- Jika user sudah pernah mengisi form, tombol berubah menjadi **"Edit Form Kunjungan"**
- Form akan terisi dengan data sebelumnya
- User bisa mengubah dan menyimpan ulang

### Fitur Hapus:
- Dalam modal edit, ada tombol **"Hapus Form"** (merah)
- Menghapus form kunjungan user untuk destinasi tersebut

### Untuk Admin:
- **Admin tidak bisa** mengisi form kunjungan
- Admin hanya bisa **melihat counter** total pengunjung di halaman wisata

## 🔍 Validasi

### Client-side (JavaScript):
- Waktu pergi harus lebih lambat dari waktu datang
- Form validation untuk required fields

### Server-side (Laravel):
- Tanggal kunjungan minimal hari ini
- Format waktu yang valid (HH:MM)
- Waktu pergi harus setelah waktu datang
- Jumlah orang wajib diisi untuk rombongan (min: 2, max: 100)
- Maksimal 1000 karakter untuk saran dan review

## 🔧 Technical Features

### AJAX Form Submission:
- Form dikirim via AJAX tanpa refresh halaman
- Real-time error handling
- Loading state pada tombol submit

### Database Optimization:
- Unique constraint mencegah duplicate form
- Proper foreign key relationships
- Efficient counting dengan accessor

### Security:
- CSRF protection
- Role-based access (hanya user)
- Input validation dan sanitization

## 📈 Benefits

1. **User Engagement**: User dapat berinteraksi lebih dengan destinasi
2. **Data Collection**: Admin mendapat data kunjungan dan feedback
3. **User Experience**: Interface yang user-friendly dengan popup modal
4. **Data Integrity**: Satu user satu form per destinasi
5. **Scalability**: Mudah untuk ditambahkan fitur analytics di masa depan

## 🚀 Future Enhancements (Opsional)

1. **Dashboard Analytics** untuk admin melihat statistik kunjungan
2. **Rating System** dengan bintang
3. **Photo Upload** dalam form kunjungan
4. **Email Notification** untuk admin ketika ada form baru
5. **Export Data** kunjungan ke Excel/PDF
6. **Chart/Graph** untuk visualisasi data kunjungan

## 🔗 Route Testing

Untuk testing, bisa menggunakan route berikut:
- `GET /wisata/{destination-slug}` - Halaman detail wisata (login sebagai user)
- `POST /user/wisata/{destination}/visit-form` - Submit form (AJAX)
- `DELETE /user/wisata/{destination}/visit-form` - Hapus form (AJAX)

Pastikan sudah login sebagai user (role: 'user') untuk bisa mengakses fitur ini.

## 🔧 Bug Fixes

### 2025-01-24: Regex Validation Fix
**Problem**: Error "preg_match(): No ending delimiter '/' found" pada validasi backend
**Solution**: Mengganti regex validation untuk `arrival_time` dan `departure_time` dari:
```php
'arrival_time' => 'required|regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/',
'departure_time' => 'required|regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/',
```

Menjadi:
```php
'arrival_time' => 'required|date_format:H:i',
'departure_time' => 'required|date_format:H:i',
```

Menggunakan `date_format:H:i` yang merupakan cara standar Laravel untuk validasi format waktu, lebih aman dan tidak menimbulkan error regex.
