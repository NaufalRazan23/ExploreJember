@extends('layouts.app')

@section('title', 'Destinations')

@section('content')
    <!-- Header Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-teal-500 -mx-4 px-4 py-8 mb-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Jelajahi Wisata</h1>
                    <p class="text-white/90">Temukan tempat-tempat menakjubkan di Jember</p>
                </div>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.wisata.create') }}"
                       class="inline-flex items-center px-6 py-3 rounded-lg bg-white text-blue-600 hover:bg-blue-50 transition-all duration-200 font-semibold shadow-md hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Wisata Baru
                    </a>
                @endif
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16" style="background: linear-gradient(to right bottom, transparent 49%, white 50%)"></div>
    </div>

    <!-- Filters Section (if needed) -->
    <div class="mb-8">
        <div class="bg-white rounded-xl shadow-md p-4">
            <div class="flex flex-wrap gap-2">
                @foreach($categories as $category)
                    <a href="{{ route('destinations.index', ['category' => $category->id]) }}"
                       class="px-4 py-2 rounded-full {{ request('category') == $category->id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}
                              transition-colors duration-200">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Destinations Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($destinations as $destination)
            <div class="group bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                @if($destination->featured_image)
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $destination->featured_image) }}"
                             alt="{{ $destination->name }}"
                             class="w-full h-full object-cover transform transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                            {{ $destination->name }}
                        </h2>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            {{ $destination->category->name }}
                        </span>
                    </div>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $destination->description }}</p>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('destinations.show', $destination) }}"
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                            <span>Lihat Detail</span>
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    <div class="mt-12">
        {{ $destinations->links() }}
    </div>

    @if($destinations->isEmpty())
        <div class="text-center py-12">
            <div class="mb-4">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada wisata ditemukan</h3>
            <p class="text-gray-600">Kami tidak dapat menemukan wisata yang sesuai dengan kriteria Anda.</p>
        </div>
    @endif
@endsection
