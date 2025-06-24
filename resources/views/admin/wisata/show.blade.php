@extends('layouts.app')

@section('title', 'Detail Wisata - ' . $wisata->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-start mb-8">
        <div class="flex items-center">
            <a href="{{ route('admin.wisata.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $wisata->name }}</h1>
                <p class="text-gray-600 mt-2">Detail informasi wisata</p>
            </div>
        </div>

        <div class="flex space-x-3">
            <a href="{{ route('wisata.show', $wisata) }}" target="_blank" class="btn-secondary">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                Lihat di Frontend
            </a>
            <a href="{{ route('admin.wisata.edit', $wisata) }}" class="btn-primary">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Wisata
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Featured Image -->
            @if($wisata->featured_image)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $wisata->featured_image) }}"
                         alt="{{ $wisata->name }}"
                         class="w-full h-96 object-cover">
                </div>
            @endif

            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Wisata</label>
                        <p class="text-gray-900">{{ $wisata->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Kategori</label>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            {{ $wisata->category->name }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Harga Tiket</label>
                        @if($wisata->entry_fee)
                            <p class="text-gray-900 font-medium">Rp {{ number_format($wisata->entry_fee, 0, ',', '.') }}</p>
                        @else
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Gratis</span>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                        @if($wisata->is_featured)
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                                Wisata Unggulan
                            </span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">Wisata Biasa</span>
                        @endif
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-500 mb-2">Deskripsi</label>
                    <div class="prose prose-blue max-w-none">
                        <p class="text-gray-700 leading-relaxed">{{ $wisata->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Location Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Lokasi</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Alamat Lengkap</label>
                        <p class="text-gray-700">{{ $wisata->address }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Latitude</label>
                            <p class="text-gray-900 font-mono">{{ $wisata->latitude }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Longitude</label>
                            <p class="text-gray-900 font-mono">{{ $wisata->longitude }}</p>
                        </div>
                    </div>

                    @if($wisata->latitude && $wisata->longitude)
                        <div class="mt-4">
                            <a href="https://maps.google.com/?q={{ $wisata->latitude }},{{ $wisata->longitude }}"
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                Lihat di Google Maps
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Additional Information -->
            @if($wisata->opening_hours || $wisata->contact_number || $wisata->website)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Tambahan</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($wisata->opening_hours)
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Jam Buka</label>
                                <p class="text-gray-900">{{ $wisata->opening_hours }}</p>
                            </div>
                        @endif

                        @if($wisata->contact_number)
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Nomor Kontak</label>
                                <p class="text-gray-900">{{ $wisata->contact_number }}</p>
                            </div>
                        @endif

                        @if($wisata->website)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500 mb-1">Website</label>
                                <a href="{{ $wisata->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    {{ $wisata->website }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Facilities -->
            @if($wisata->facilities && count($wisata->facilities) > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Fasilitas</h3>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($wisata->facilities as $facility)
                            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm text-gray-700">{{ $facility }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Gallery -->
            @if($wisata->gallery && count($wisata->gallery) > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Galeri Foto</h3>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($wisata->gallery as $image)
                            <img src="{{ asset('storage/' . $image) }}"
                                 alt="{{ $wisata->name }}"
                                 class="w-full h-32 object-cover rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-pointer">
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h3>

                <div class="space-y-3">
                    <a href="{{ route('admin.wisata.edit', $wisata) }}" class="w-full btn-primary block text-center">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Wisata
                    </a>

                    <a href="{{ route('wisata.show', $wisata) }}" target="_blank" class="w-full btn-secondary block text-center">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Lihat di Frontend
                    </a>

                    <form action="{{ route('admin.wisata.destroy', $wisata) }}" method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus wisata ini? Tindakan ini tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Wisata
                        </button>
                    </form>
                </div>
            </div>

            <!-- Meta Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Meta</h3>

                <div class="space-y-3 text-sm">
                    <div>
                        <label class="block text-gray-500">Slug</label>
                        <p class="text-gray-900 font-mono">{{ $wisata->slug }}</p>
                    </div>

                    <div>
                        <label class="block text-gray-500">Dibuat</label>
                        <p class="text-gray-900">{{ $wisata->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-gray-500">Terakhir Diperbarui</label>
                        <p class="text-gray-900">{{ $wisata->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Statistik</h3>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Gambar</span>
                        <span class="font-medium">
                            {{ ($wisata->featured_image ? 1 : 0) + ($wisata->gallery ? count($wisata->gallery) : 0) }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Fasilitas</span>
                        <span class="font-medium">{{ $wisata->facilities ? count($wisata->facilities) : 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
