@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Profil Saya</h1>
            <p class="text-gray-600 mt-2">Kelola informasi profil dan pengaturan akun Anda</p>
        </div>

        <a href="{{ route('user.profile.edit') }}" class="btn-primary">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Profil
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Profile Card -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <!-- Profile Header -->
                <div class="flex items-center mb-6">
                    <div class="h-20 w-20 rounded-full bg-blue-100 flex items-center justify-center mr-6">
                        <span class="text-blue-600 font-bold text-2xl">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <div class="flex items-center mt-2">
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium mr-3">
                                {{ ucfirst($user->role) }}
                            </span>

                        </div>
                    </div>
                </div>

                <!-- Profile Information -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Profil</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                            <p class="text-gray-900">{{ $user->name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                            <p class="text-gray-900">{{ $user->email }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Role</label>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>



                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Bergabung</label>
                            <p class="text-gray-900">{{ $user->created_at->format('d M Y, H:i') }}</p>
                            <p class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Terakhir Diperbarui</label>
                            <p class="text-gray-900">{{ $user->updated_at->format('d M Y, H:i') }}</p>
                            <p class="text-sm text-gray-500">{{ $user->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Account Activity -->
                <div class="border-t border-gray-200 pt-6 mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Aktivitas Akun</h3>

                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-green-50 rounded-lg">
                            <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Akun Dibuat</p>
                                <p class="text-sm text-gray-600">{{ $user->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>



                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Terakhir Diperbarui</p>
                                <p class="text-sm text-gray-600">{{ $user->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h3>

                <div class="space-y-3">
                    <a href="{{ route('user.profile.edit') }}" class="w-full btn-primary block text-center">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profil
                    </a>

                    <a href="{{ route('home') }}" class="w-full btn-secondary block text-center">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>

                    <a href="{{ route('destinations.index') }}" class="w-full btn-secondary block text-center">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                        Jelajahi Wisata
                    </a>
                </div>
            </div>

            <!-- Account Statistics -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Statistik Akun</h3>

                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-500">User ID</span>
                        <span class="font-medium">#{{ $user->id }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Lama Bergabung</span>
                        <span class="font-medium">{{ $user->created_at->diffInDays(now()) }} hari</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Status Akun</span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                            Aktif
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Wisata</span>
                        <span class="font-medium">{{ \App\Models\Destination::count() }} tersedia</span>
                    </div>
                </div>
            </div>

            <!-- Security Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Keamanan</h3>

                <div class="space-y-4">
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-900">Password</p>
                            <p class="text-sm text-gray-600">Terakhir diperbarui {{ $user->updated_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            Aman
                        </span>
                    </div>


                </div>
            </div>

            <!-- Account Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Akun</h3>

                <div class="space-y-3 text-sm">
                    <div>
                        <label class="block text-gray-500">User ID</label>
                        <p class="text-gray-900 font-mono">{{ $user->id }}</p>
                    </div>

                    <div>
                        <label class="block text-gray-500">Created At</label>
                        <p class="text-gray-900">{{ $user->created_at->toISOString() }}</p>
                    </div>

                    <div>
                        <label class="block text-gray-500">Updated At</label>
                        <p class="text-gray-900">{{ $user->updated_at->toISOString() }}</p>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
