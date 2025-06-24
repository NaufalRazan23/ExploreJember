@extends('layouts.app')

@section('title', 'Selamat Datang di Explore Jember')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-teal-500 rounded-2xl overflow-hidden mb-12">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="relative px-8 py-16 md:py-24">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                    Temukan Keindahan Harta Tersembunyi Jember
                </h1>
                <p class="text-xl text-white/90 mb-8">
                    Jelajahi destinasi menakjubkan, landmark budaya, dan keajaiban alam yang membuat Jember menjadi tujuan wisata yang unik.
                </p>
                <!-- Search Form -->
                <form action="{{ route('search') }}" method="GET" class="mb-6">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" name="search" placeholder="Cari wisata berdasarkan nama atau lokasi..."
                                   value="{{ request('search') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>
                        <div class="sm:w-48">
                            <select name="category" class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                <option value="">Semua Kategori</option>
                                @if(isset($categories))
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }} class="text-gray-900">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="px-6 py-3 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200 font-semibold shadow-sm hover:shadow-md flex items-center justify-center">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                    </div>
                </form>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('destinations.index') }}"
                       class="inline-flex items-center px-6 py-3 rounded-lg bg-white text-blue-600 hover:bg-blue-50 transition-colors duration-200 font-semibold">
                        <span>Jelajahi Wisata</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="#featured"
                       class="inline-flex items-center px-6 py-3 rounded-lg bg-blue-700 text-white hover:bg-blue-800 transition-colors duration-200 font-semibold">
                        Tempat Unggulan
                    </a>
                </div>
            </div>
        </div>
        <!-- Decorative pattern -->
        <div class="absolute bottom-0 left-0 right-0 h-32" style="background: linear-gradient(to right bottom, transparent 49%, white 50%)"></div>
    </div>

    <!-- Statistics Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Total Wisata</h3>
                <span class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Destination::count() }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Kategori</h3>
                <span class="p-2 bg-teal-100 text-teal-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Category::count() }}</p>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Tempat Unggulan</h3>
                <span class="p-2 bg-yellow-100 text-yellow-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Destination::where('is_featured', true)->count() }}</p>
        </div>
    </div>

    <!-- Search Results Section -->
    @if(isset($wisata) && (request('search') || request('category')))
    <div class="mb-16">
        <div class="mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                Hasil Pencarian
                @if(request('search'))
                    untuk "{{ request('search') }}"
                @endif
                @if(request('category') && isset($categories))
                    @php $selectedCategory = $categories->firstWhere('id', request('category')) @endphp
                    @if($selectedCategory)
                        dalam kategori "{{ $selectedCategory->name }}"
                    @endif
                @endif
            </h2>
            <p class="text-gray-600">Ditemukan {{ $wisata->total() }} wisata</p>
        </div>

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
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">
                                {{ $destination->name }}
                            </h3>
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
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $wisata->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada wisata ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci pencarian atau kategori.</p>
            </div>
        @endif
    </div>
    @endif

    <!-- Categories Section -->
    @if(isset($categories) && $categories->count() > 0)
    <div class="mb-16">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Jelajahi Berdasarkan Kategori</h2>
                <p class="text-gray-600">Temukan destinasi sempurna berdasarkan minat Anda</p>
            </div>
            <a href="{{ route('destinations.index') }}" class="text-blue-600 hover:text-blue-800 font-medium hidden md:inline-block">
                Lihat Semua Wisata &rarr;
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($categories as $category)
                <div class="group bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:-translate-y-1 hover:shadow-xl relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/80 to-teal-500/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="p-6 relative">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 group-hover:text-white transition-colors duration-300">
                                {{ $category->name }}
                            </h3>
                            @if($category->icon)
                                <span class="text-2xl group-hover:text-white transition-colors duration-300">
                                    {{ $category->icon }}
                                </span>
                            @endif
                        </div>
                        <p class="text-gray-600 mb-4 group-hover:text-white/90 transition-colors duration-300">
                            {{ $category->description }}
                        </p>
                        <a href="{{ route('categories.show', $category) }}"
                           class="inline-flex items-center text-blue-600 hover:text-white font-medium transition-colors duration-300">
                            <span>Lihat Wisata</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-6 md:hidden">
            <a href="{{ route('destinations.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                Lihat Semua Wisata &rarr;
            </a>
        </div>
    </div>
    @endif

    <!-- Featured Destinations Section -->
    @if(isset($featuredDestinations) && $featuredDestinations->count() > 0)
    <div class="mb-16" id="featured">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Featured Destinations</h2>
                <p class="text-gray-600">Handpicked places you shouldn't miss</p>
            </div>
            <a href="{{ route('destinations.index') }}" class="text-blue-600 hover:text-blue-800 font-medium hidden md:inline-block">
                View All Destinations &rarr;
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredDestinations as $destination)
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
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">
                            {{ $destination->name }}
                        </h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($destination->description, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('destinations.show', $destination) }}"
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                <span>Learn More</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                            @if($destination->entry_fee)
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                    Rp {{ number_format($destination->entry_fee, 0, ',', '.') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-6 md:hidden">
            <a href="{{ route('destinations.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                View All Destinations &rarr;
            </a>
        </div>
    </div>
    @endif

    <!-- Call to Action -->
    <div class="bg-gradient-to-br from-blue-600 to-teal-500 rounded-2xl p-8 md:p-12 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Jelajahi Lebih Banyak Wisata</h2>
            <p class="text-white/90 text-lg mb-8 max-w-2xl mx-auto">
                Temukan destinasi menakjubkan lainnya di Jember dan nikmati pengalaman wisata yang tak terlupakan.
            </p>
            <a href="{{ route('destinations.index') }}"
               class="inline-flex items-center px-6 py-3 rounded-lg bg-white text-blue-600 hover:bg-blue-50 transition-colors duration-200 font-semibold">
                <span>Lihat Semua Wisata</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
@endsection
