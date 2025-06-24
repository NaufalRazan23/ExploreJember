@extends('layouts.app')

@section('title', $destination->name)

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $destination->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Images and Details -->
        <div class="lg:col-span-2">
            <!-- Featured Image -->
            @if($destination->featured_image)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $destination->featured_image) }}"
                         alt="{{ $destination->name }}"
                         class="w-full h-96 object-cover rounded-xl shadow-lg">
                </div>
            @endif

            <!-- Gallery -->
            @if($destination->gallery && count($destination->gallery) > 0)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Galeri Foto</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($destination->gallery as $image)
                            <img src="{{ asset('storage/' . $image) }}"
                                 alt="{{ $destination->name }}"
                                 class="w-full h-32 object-cover rounded-lg shadow-md hover:shadow-lg transition-shadow cursor-pointer">
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Description -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Deskripsi</h3>
                <div class="prose prose-blue max-w-none">
                    <p class="text-gray-700 leading-relaxed">{{ $destination->description }}</p>
                </div>
            </div>

            <!-- Facilities -->
            @if($destination->facilities && count($destination->facilities) > 0)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Fasilitas</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($destination->facilities as $facility)
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
        </div>

        <!-- Right Column - Info Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $destination->name }}</h1>
                <div class="flex items-center mb-4">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                        {{ $destination->category->name }}
                    </span>
                </div>

                <!-- Info Items -->
                <div class="space-y-4">
                    <!-- Address -->
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Alamat</p>
                            <p class="text-sm text-gray-600">{{ $destination->address }}</p>
                        </div>
                    </div>

                    <!-- Entry Fee -->
                    @if($destination->entry_fee)
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Harga Tiket</p>
                                <p class="text-sm text-gray-600">Rp {{ number_format($destination->entry_fee, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Opening Hours -->
                    @if($destination->opening_hours)
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Jam Buka</p>
                                <p class="text-sm text-gray-600">{{ $destination->opening_hours }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Contact -->
                    @if($destination->contact_number)
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Kontak</p>
                                <p class="text-sm text-gray-600">{{ $destination->contact_number }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Website -->
                    @if($destination->website)
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Website</p>
                                <a href="{{ $destination->website }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800">
                                    Kunjungi Website
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Map Button -->
                @if($destination->latitude && $destination->longitude)
                    <div class="mt-6">
                        <a href="https://maps.google.com/?q={{ $destination->latitude }},{{ $destination->longitude }}"
                           target="_blank"
                           class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            Lihat di Google Maps
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Destinations -->
    @if($relatedWisata->count() > 0)
        <div class="mt-16">
            <h3 class="text-2xl font-bold text-gray-900 mb-8">Wisata Serupa</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedWisata as $related)
                    <div class="group bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        @if($related->featured_image)
                            <div class="relative h-32 overflow-hidden">
                                <img src="{{ asset('storage/' . $related->featured_image) }}"
                                    alt="{{ $related->name }}"
                                    class="w-full h-full object-cover transform transition duration-300 group-hover:scale-110">
                            </div>
                        @endif
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">
                                {{ $related->name }}
                            </h4>
                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($related->description, 60) }}</p>
                            <a href="{{ route('wisata.show', $related) }}"
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
