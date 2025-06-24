@extends('layouts.app')

@section('title', $destination->name)

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-6 flex items-center text-sm text-gray-600">
        <a href="{{ route('destinations.index') }}" class="hover:text-blue-600 transition-colors duration-200">Destinations</a>
        <span class="mx-2">/</span>
        <a href="{{ route('categories.show', $destination->category) }}" class="hover:text-blue-600 transition-colors duration-200">
            {{ $destination->category->name }}
        </a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $destination->name }}</span>
    </div>

    <div class="max-w-5xl mx-auto">
        <!-- Main Image and Basic Info -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
            @if($destination->featured_image)
                <div class="relative h-96">
                    <img src="{{ asset('storage/' . $destination->featured_image) }}"
                         alt="{{ $destination->name }}"
                         class="w-full h-full object-cover"
                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder-destination.jpg') }}'; this.alt='Gambar tidak tersedia';">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                        <div class="flex items-center justify-between">
                            <h1 class="text-4xl font-bold">{{ $destination->name }}</h1>
                            <span class="px-4 py-2 bg-blue-600 bg-opacity-90 backdrop-blur-sm rounded-full text-sm font-medium">
                                {{ $destination->category->name }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="p-8">
                <!-- Description -->
                <div class="prose max-w-none mb-8">
                    <p class="text-gray-600 text-lg leading-relaxed">{{ $destination->description }}</p>
                </div>

                <!-- Quick Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Opening Hours -->
                    @if($destination->opening_hours)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <span class="p-2 bg-blue-100 text-blue-600 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </span>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Opening Hours</h3>
                                    <p class="text-gray-600">{{ $destination->opening_hours }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Entry Fee -->
                    @if($destination->entry_fee)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <span class="p-2 bg-green-100 text-green-600 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </span>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Entry Fee</h3>
                                    <p class="text-gray-600">Rp {{ number_format($destination->entry_fee, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Contact -->
                    @if($destination->contact_number)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <span class="p-2 bg-yellow-100 text-yellow-600 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </span>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Contact</h3>
                                    <p class="text-gray-600">{{ $destination->contact_number }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Location and Facilities -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Location -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Location</h2>
                        <div class="bg-gray-50 rounded-xl p-6">
                            <p class="flex items-start text-gray-600">
                                <svg class="w-4 h-4 mr-3 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $destination->address }}
                            </p>
                        </div>
                    </div>

                    <!-- Facilities -->
                    @if($destination->facilities)
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Facilities</h2>
                            <div class="bg-gray-50 rounded-xl p-6">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($destination->facilities as $facility)
                                        <span class="inline-flex items-center px-3 py-1 bg-white border border-gray-200 rounded-full text-sm text-gray-700">
                                            {{ $facility }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Gallery -->
                @if($destination->gallery)
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Gallery</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($destination->gallery as $image)
                                <div class="aspect-w-16 aspect-h-12 group">
                                    <img src="{{ asset('storage/' . $image) }}"
                                         alt="Gallery image of {{ $destination->name }}"
                                         class="w-full h-full object-cover rounded-xl transition duration-300 group-hover:opacity-90"
                                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder-gallery.jpg') }}'; this.alt='Gambar tidak tersedia';">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Website Link -->
                @if($destination->website)
                    <div class="mt-8 text-center">
                        <a href="{{ $destination->website }}"
                           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200"
                           target="_blank">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Visit Official Website
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('destinations.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Wisata
            </a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.wisata.edit', $destination) }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Wisata
                </a>
            @endif
        </div>
    </div>
@endsection
