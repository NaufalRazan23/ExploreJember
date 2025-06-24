@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Search Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            Hasil Pencarian
            @if($search)
                untuk "{{ $search }}"
            @endif
        </h1>
        <p class="text-gray-600">Ditemukan {{ $wisata->total() }} wisata</p>
    </div>

    <!-- Search Form -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form action="{{ route('search') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Kata Kunci</label>
                    <input type="text"
                           id="search"
                           name="q"
                           placeholder="Cari wisata berdasarkan nama, lokasi, atau deskripsi..."
                           value="{{ $search }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="category" id="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-4 flex justify-between items-center">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari Wisata
                </button>
                @if($search || request('category'))
                    <a href="{{ route('search') }}" class="text-gray-600 hover:text-gray-800">
                        Reset Pencarian
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Results -->
    @if($wisata->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($wisata as $destination)
                <div class="group bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    @if($destination->featured_image)
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $destination->featured_image) }}"
                                alt="{{ $destination->name }}"
                                class="w-full h-full object-cover transform transition duration-300 group-hover:scale-110">
                            <div class="absolute top-0 right-0 bg-blue-600 text-white px-3 py-1 m-3 rounded-full text-sm">
                                {{ $destination->category->name }}
                            </div>
                        </div>
                    @else
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">
                            {{ $destination->name }}
                        </h3>

                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ Str::limit($destination->address, 50) }}
                        </div>

                        <p class="text-gray-600 mb-4">{{ Str::limit($destination->description, 100) }}</p>

                        <div class="flex justify-between items-center">
                            <a href="{{ route('wisata.show', $destination) }}"
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                <span>Lihat Detail</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                            @if($destination->entry_fee)
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                    Rp {{ number_format($destination->entry_fee, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                    Gratis
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $wisata->appends(request()->query())->links() }}
        </div>
    @else
        <!-- No Results -->
        <div class="text-center py-16">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
            </svg>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Tidak ada wisata ditemukan</h3>
            <p class="text-gray-500 mb-6">
                @if($search)
                    Tidak ada wisata yang cocok dengan pencarian "{{ $search }}".
                @else
                    Tidak ada wisata yang ditemukan dengan kriteria yang dipilih.
                @endif
            </p>
            <div class="space-x-4">
                <a href="{{ route('search') }}" class="btn-secondary">
                    Coba Pencarian Lain
                </a>
                <a href="{{ route('home') }}" class="btn-primary">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    @endif

    <!-- Suggestions -->
    @if($wisata->count() == 0 && $search)
        <div class="mt-12 bg-blue-50 rounded-lg p-6">
            <h4 class="text-lg font-medium text-blue-900 mb-2">Saran Pencarian:</h4>
            <ul class="text-blue-800 space-y-1">
                <li>• Periksa ejaan kata kunci</li>
                <li>• Gunakan kata kunci yang lebih umum</li>
                <li>• Coba kategori yang berbeda</li>
                <li>• Hapus beberapa filter pencarian</li>
            </ul>
        </div>
    @endif
</div>
@endsection
