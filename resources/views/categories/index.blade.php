@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Kategori Wisata</h1>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.wisata.create') }}" class="btn-primary">
                Tambah Kategori Baru
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h2>
                        @if($category->icon)
                            <span class="text-2xl">{{ $category->icon }}</span>
                        @endif
                    </div>
                    <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">{{ $category->destinations_count }} wisata</span>
                        <a href="{{ route('categories.show', $category) }}" class="text-blue-600 hover:text-blue-800">
                            Lihat Detail &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
