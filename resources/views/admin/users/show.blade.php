@extends('layouts.app')

@section('title', 'Detail User - ' . $user->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-start mb-8">
        <div class="flex items-center">
            <a href="{{ route('admin.users.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Detail User</h1>
                <p class="text-gray-600 mt-2">Informasi lengkap pengguna</p>
            </div>
        </div>

        <div class="flex space-x-3">
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus User
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- User Profile -->
            <div class="bg-white rounded-lg shadow-md p-6">
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
                            @if($user->email_verified_at)
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                    ✓ Email Terverifikasi
                                </span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                                    ✗ Email Belum Terverifikasi
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- User Information -->
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
            <div class="bg-white rounded-lg shadow-md p-6">
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

                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-900">Two-Factor Authentication</p>
                            <p class="text-sm text-gray-600">Keamanan tambahan untuk akun</p>
                        </div>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                            Tidak Aktif
                        </span>
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
                    <button class="w-full btn-secondary" disabled>
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Kirim Email
                    </button>

                    <button class="w-full btn-secondary" disabled>
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Reset Password
                    </button>

                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus User
                        </button>
                    </form>
                </div>
            </div>

            <!-- User Statistics -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Statistik User</h3>

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

                    @if($user->email_verified_at)
                        <div>
                            <label class="block text-gray-500">Email Verified At</label>
                            <p class="text-gray-900">{{ $user->email_verified_at->toISOString() }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
