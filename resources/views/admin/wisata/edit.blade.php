@extends('layouts.app')

@section('title', 'Edit Wisata')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.wisata.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Wisata</h1>
            <p class="text-gray-600 mt-2">Perbarui informasi wisata "{{ $wisata->name }}"</p>
        </div>
    </div>

    <form action="{{ route('admin.wisata.update', $wisata) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Wisata *</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                   placeholder="Masukkan nama wisata" value="{{ old('name', $wisata->name) }}">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                            <select id="category_id" name="category_id" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $wisata->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="entry_fee" class="block text-sm font-medium text-gray-700 mb-2">Harga Tiket (Rp)</label>
                            <input type="number" id="entry_fee" name="entry_fee" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('entry_fee') border-red-500 @enderror"
                                   placeholder="0 (kosongkan jika gratis)" value="{{ old('entry_fee', $wisata->entry_fee) }}">
                            @error('entry_fee')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi *</label>
                        <textarea id="description" name="description" rows="4" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                  placeholder="Deskripsikan wisata ini...">{{ old('description', $wisata->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Location Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Lokasi</h3>

                    <div class="space-y-4">
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                            <textarea id="address" name="address" rows="3" required
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror"
                                      placeholder="Masukkan alamat lengkap wisata">{{ old('address', $wisata->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Latitude *</label>
                                <input type="number" id="latitude" name="latitude" step="any" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('latitude') border-red-500 @enderror"
                                       placeholder="-8.1234567" value="{{ old('latitude', $wisata->latitude) }}">
                                @error('latitude')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Longitude *</label>
                                <input type="number" id="longitude" name="longitude" step="any" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('longitude') border-red-500 @enderror"
                                       placeholder="113.1234567" value="{{ old('longitude', $wisata->longitude) }}">
                                @error('longitude')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Tambahan</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="opening_hours" class="block text-sm font-medium text-gray-700 mb-2">Jam Buka</label>
                            <input type="text" id="opening_hours" name="opening_hours"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('opening_hours') border-red-500 @enderror"
                                   placeholder="08:00 - 17:00" value="{{ old('opening_hours', $wisata->opening_hours) }}">
                            @error('opening_hours')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Kontak</label>
                            <input type="text" id="contact_number" name="contact_number"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('contact_number') border-red-500 @enderror"
                                   placeholder="0812-3456-7890" value="{{ old('contact_number', $wisata->contact_number) }}">
                            @error('contact_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                            <input type="url" id="website" name="website"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('website') border-red-500 @enderror"
                                   placeholder="https://example.com" value="{{ old('website', $wisata->website) }}">
                            @error('website')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Facilities -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Fasilitas</h3>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @php
                            $commonFacilities = [
                                'Parkir', 'Toilet', 'Mushola', 'Warung Makan', 'Gazebo', 'Area Bermain',
                                'WiFi', 'ATM', 'Spot Foto', 'Pemandu Wisata', 'Penyewaan Alat', 'Camping Ground'
                            ];
                            $currentFacilities = old('facilities', $wisata->facilities ?? []);
                        @endphp

                        @foreach($commonFacilities as $facility)
                            <label class="flex items-center">
                                <input type="checkbox" name="facilities[]" value="{{ $facility }}"
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                       {{ in_array($facility, $currentFacilities) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">{{ $facility }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Current Featured Image -->
                @if($wisata->featured_image)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Gambar Utama Saat Ini</h3>
                        <img src="{{ asset('storage/' . $wisata->featured_image) }}" alt="{{ $wisata->name }}"
                             class="w-full h-48 object-cover rounded-lg">
                    </div>
                @endif

                <!-- Featured Image -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ $wisata->featured_image ? 'Ganti Gambar Utama' : 'Upload Gambar Utama' }}
                    </h3>

                    <div>
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar Baru</label>

                        <!-- New Image Preview -->
                        <div id="featured_image_preview" class="mb-4 hidden">
                            <img id="featured_image_img" src="" alt="Preview" class="w-full h-48 object-cover rounded-lg border border-gray-300">
                            <button type="button" id="remove_featured_image" class="mt-2 px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">
                                Hapus Gambar Baru
                            </button>
                        </div>

                        <input type="file" id="featured_image" name="featured_image" accept="image/jpeg,image/png,image/jpg,image/gif"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('featured_image') border-red-500 @enderror">
                        @error('featured_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengganti.</p>
                    </div>
                </div>

                <!-- Current Gallery -->
                @if($wisata->gallery && count($wisata->gallery) > 0)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Galeri Saat Ini</h3>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($wisata->gallery as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $wisata->name }}"
                                     class="w-full h-20 object-cover rounded">
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Gallery -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        {{ $wisata->gallery && count($wisata->gallery) > 0 ? 'Ganti Galeri Foto' : 'Upload Galeri Foto' }}
                    </h3>

                    <div>
                        <label for="gallery" class="block text-sm font-medium text-gray-700 mb-2">Upload Galeri</label>
                        <input type="file" id="gallery" name="gallery[]" accept="image/*" multiple
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('gallery.*') border-red-500 @enderror">
                        @error('gallery.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Pilih beberapa gambar sekaligus. Maksimal 2MB per file.</p>
                        @if($wisata->gallery && count($wisata->gallery) > 0)
                            <p class="mt-1 text-sm text-yellow-600">⚠️ Upload gambar baru akan mengganti semua gambar galeri yang ada.</p>
                        @endif
                    </div>
                </div>

                <!-- Settings -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pengaturan</h3>

                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1"
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                   {{ old('is_featured', $wisata->is_featured) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">Jadikan wisata unggulan</span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="space-y-3">
                        <button type="submit" class="w-full btn-primary">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Perbarui Wisata
                        </button>

                        <a href="{{ route('admin.wisata.show', $wisata) }}" class="w-full btn-secondary block text-center">
                            Lihat Detail
                        </a>

                        <a href="{{ route('admin.wisata.index') }}" class="w-full text-gray-600 hover:text-gray-800 block text-center">
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Featured Image Preview (same as create form)
    const featuredImageInput = document.getElementById('featured_image');
    const featuredImagePreview = document.getElementById('featured_image_preview');
    const featuredImageImg = document.getElementById('featured_image_img');
    const removeFeaturedImageBtn = document.getElementById('remove_featured_image');

    featuredImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (2MB = 2048KB)
            if (file.size > 2048 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                e.target.value = '';
                return;
            }

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung! Gunakan JPG, PNG, atau GIF.');
                e.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                featuredImageImg.src = e.target.result;
                featuredImagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    removeFeaturedImageBtn.addEventListener('click', function() {
        featuredImageInput.value = '';
        featuredImagePreview.classList.add('hidden');
        featuredImageImg.src = '';
    });

    // Gallery Preview
    const galleryInput = document.getElementById('gallery');
    galleryInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);

        // Validate each file
        for (let file of files) {
            if (file.size > 2048 * 1024) {
                alert(`File ${file.name} terlalu besar! Maksimal 2MB per file.`);
                e.target.value = '';
                return;
            }

            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert(`File ${file.name} format tidak didukung! Gunakan JPG, PNG, atau GIF.`);
                e.target.value = '';
                return;
            }
        }

        if (files.length > 10) {
            alert('Maksimal 10 foto untuk galeri!');
            e.target.value = '';
            return;
        }
    });
});
</script>
@endpush
