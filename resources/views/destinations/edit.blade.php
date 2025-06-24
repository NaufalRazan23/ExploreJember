@extends('layouts.app')

@section('title', 'Edit ' . $destination->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('destinations.show', $destination) }}" class="text-blue-600 hover:text-blue-800">&larr; Back to Destination</a>
    </div>

    <div class="card">
        <div class="p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit {{ $destination->name }}</h1>

            <form action="{{ route('destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $destination->name) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category_id" id="category_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $destination->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="5"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $destination->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea name="address" id="address" rows="2"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('address', $destination->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                            <input type="number" step="any" name="latitude" id="latitude"
                                   value="{{ old('latitude', $destination->latitude) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('latitude')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                            <input type="number" step="any" name="longitude" id="longitude"
                                   value="{{ old('longitude', $destination->longitude) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('longitude')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                        @if($destination->featured_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $destination->featured_image) }}"
                                     alt="Current featured image" class="h-32 w-auto">
                            </div>
                        @endif
                        <input type="file" name="featured_image" id="featured_image"
                               class="mt-1 block w-full" accept="image/*">
                        @error('featured_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gallery" class="block text-sm font-medium text-gray-700">Gallery Images</label>
                        @if($destination->gallery)
                            <div class="mt-2 grid grid-cols-4 gap-4">
                                @foreach($destination->gallery as $image)
                                    <img src="{{ asset('storage/' . $image) }}"
                                         alt="Gallery image" class="h-24 w-24 object-cover">
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="gallery[]" id="gallery" multiple
                               class="mt-1 block w-full" accept="image/*">
                        @error('gallery')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="entry_fee" class="block text-sm font-medium text-gray-700">Entry Fee (Rp)</label>
                        <input type="number" name="entry_fee" id="entry_fee"
                               value="{{ old('entry_fee', $destination->entry_fee) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('entry_fee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="opening_hours" class="block text-sm font-medium text-gray-700">Opening Hours</label>
                        <input type="text" name="opening_hours" id="opening_hours"
                               value="{{ old('opening_hours', $destination->opening_hours) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('opening_hours')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number"
                               value="{{ old('contact_number', $destination->contact_number) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('contact_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                        <input type="url" name="website" id="website"
                               value="{{ old('website', $destination->website) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('website')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="facilities" class="block text-sm font-medium text-gray-700">Facilities</label>
                        <div class="mt-2 space-y-2">
                            @php
                                $facilities = ['Parking', 'Toilet', 'Food Court', 'Prayer Room', 'Souvenir Shop', 'Tour Guide', 'Rest Area', 'WiFi'];
                                $currentFacilities = old('facilities', $destination->facilities ?? []);
                            @endphp
                            @foreach($facilities as $facility)
                                <div class="flex items-center">
                                    <input type="checkbox" name="facilities[]" id="facility_{{ $loop->index }}"
                                           value="{{ $facility }}" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                           {{ in_array($facility, $currentFacilities) ? 'checked' : '' }}>
                                    <label for="facility_{{ $loop->index }}" class="ml-2 text-sm text-gray-700">{{ $facility }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('facilities')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn-primary">
                            Update Destination
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
