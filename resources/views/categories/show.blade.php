@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800">&larr; Kembali ke Kategori</a>
    </div>

    <div class="card mb-6">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $category->name }}</h1>
                @if($category->icon)
                    <span class="text-3xl">{{ $category->icon }}</span>
                @endif
            </div>
            <p class="text-gray-600 text-lg mb-4">{{ $category->description }}</p>
            @if(auth()->user()->isAdmin())
                <div class="flex space-x-4">
                    <a href="{{ route('admin.wisata.edit', $category) }}" class="btn-primary">Edit Kategori</a>
                    <form action="{{ route('admin.wisata.destroy', $category) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-secondary" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            Hapus Kategori
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Wisata di {{ $category->name }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($destinations as $destination)
            <div class="card">
                @if($destination->featured_image)
                    <img src="{{ asset('storage/' . $destination->featured_image) }}"
                         alt="{{ $destination->name }}"
                         class="w-full h-48 object-cover">
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $destination->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($destination->description, 150) }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('destinations.show', $destination) }}" class="text-blue-600 hover:text-blue-800">
                            View Details &rarr;
                        </a>
                        @if($destination->entry_fee)
                            <span class="text-gray-600">
                                Rp {{ number_format($destination->entry_fee, 0, ',', '.') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $destinations->links() }}
    </div>
</div>
@endsection
