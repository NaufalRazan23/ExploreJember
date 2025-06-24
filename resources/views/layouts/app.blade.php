<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Explore Jember') }} - @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .fade-in { animation: fadeIn 0.5s ease-in; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .hover-scale { transition: transform 0.2s; }
        .hover-scale:hover { transform: scale(1.02); }

        /* Background Image Styles */
        .bg-main {
            background-image: url('{{ asset('images/backgrounds/' . ($backgroundImage ?? 'main-bg.jpg')) }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* Alternative Background Classes */
        .bg-home { background-image: url('{{ asset('images/backgrounds/home-bg.jpg') }}'); }
        .bg-auth { background-image: url('{{ asset('images/backgrounds/auth-bg.jpg') }}'); }
        .bg-admin { background-image: url('{{ asset('images/backgrounds/admin-bg.jpg') }}'); }
        .bg-destinations { background-image: url('{{ asset('images/backgrounds/destinations-bg.jpg') }}'); }
        .bg-search { background-image: url('{{ asset('images/backgrounds/search-bg.jpg') }}'); }

        .bg-overlay {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .bg-overlay-light {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .content-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Footer Styles */
        footer {
            background-image: none !important;
            background-attachment: scroll !important;
            position: relative;
            z-index: 10;
        }

        /* Ensure body background doesn't affect footer */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: inherit;
            z-index: -1;
            pointer-events: none;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen">
    <!-- Background Image Container -->
    <div class="{{ $backgroundClass ?? 'bg-main' }} fixed inset-0 z-0"></div>
    <!-- Header -->
    <header class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200">
        <nav class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                        <span class="text-2xl transform group-hover:rotate-12 transition-transform duration-300">🏛️</span>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-teal-500 bg-clip-text text-transparent hover:from-teal-500 hover:to-blue-600 transition-all duration-300">
                            Explore Jember
                        </span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    @auth
                        <a href="{{ route('home') }}"
                           class="{{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50 px-3 py-2 rounded-lg' : 'text-gray-600 hover:text-blue-600' }} transition-colors duration-200 font-medium hover:scale-105 transform">
                            Beranda
                        </a>
                        <a href="{{ route('destinations.index') }}"
                           class="{{ request()->routeIs('destinations.*') || request()->routeIs('wisata.*') ? 'text-blue-600 bg-blue-50 px-3 py-2 rounded-lg' : 'text-gray-600 hover:text-blue-600' }} transition-colors duration-200 font-medium hover:scale-105 transform">
                            Wisata
                        </a>
                        <a href="{{ route('search') }}"
                           class="{{ request()->routeIs('search') ? 'text-blue-600 bg-blue-50 px-3 py-2 rounded-lg' : 'text-gray-600 hover:text-blue-600' }} transition-colors duration-200 font-medium hover:scale-105 transform">
                            Cari Wisata
                        </a>

                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="{{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.users.*') || request()->routeIs('admin.wisata.*') || request()->routeIs('admin.admins.*') ? 'text-blue-600 bg-blue-50 px-3 py-2 rounded-lg' : 'text-gray-600 hover:text-blue-600' }} transition-colors duration-200 font-medium hover:scale-105 transform">
                                Dashboard Admin
                            </a>
                            <a href="{{ route('admin.profile.edit') }}"
                               class="{{ request()->routeIs('admin.profile.*') ? 'text-blue-600 bg-blue-50 px-3 py-2 rounded-lg' : 'text-gray-600 hover:text-blue-600' }} transition-colors duration-200 font-medium hover:scale-105 transform">
                                Edit Profil
                            </a>
                        @endif

                        @if(auth()->user()->isUser())
                            <a href="{{ route('user.profile.index') }}"
                               class="{{ request()->routeIs('user.profile.*') ? 'text-blue-600 bg-blue-50 px-3 py-2 rounded-lg' : 'text-gray-600 hover:text-blue-600' }} transition-colors duration-200 font-medium hover:scale-105 transform">
                                Profil Saya
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="text-red-600 hover:text-red-800 transition-colors duration-200 font-medium hover:scale-105 transform"
                                    onclick="return confirm('Apakah Anda yakin ingin logout?')">
                                Logout
                            </button>
                        </form>
                    @else
                        <!-- Show login message for guests -->
                        <div class="text-gray-600 font-medium">
                            Silakan login untuk mengakses website
                        </div>
                        <a href="{{ route('login') }}"
                           class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium hover:scale-105 transform">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-full text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-teal-500 hover:from-teal-500 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 hover:scale-105 transform">
                            Daftar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-colors duration-200">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden hidden fade-in" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    @auth
                        <a href="{{ route('home') }}"
                           class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition-all duration-200">
                            Beranda
                        </a>
                        <a href="{{ route('destinations.index') }}"
                           class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('destinations.*') || request()->routeIs('wisata.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition-all duration-200">
                            Wisata
                        </a>
                        <a href="{{ route('search') }}"
                           class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('search') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition-all duration-200">
                            Cari Wisata
                        </a>

                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.users.*') || request()->routeIs('admin.wisata.*') || request()->routeIs('admin.admins.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition-all duration-200">
                                Dashboard Admin
                            </a>
                            <a href="{{ route('admin.profile.edit') }}"
                               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.profile.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition-all duration-200">
                                Edit Profil
                            </a>
                        @endif

                        @if(auth()->user()->isUser())
                            <a href="{{ route('user.profile.index') }}"
                               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('user.profile.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }} transition-all duration-200">
                                Profil Saya
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 hover:text-red-800 hover:bg-red-50 transition-all duration-200"
                                    onclick="return confirm('Apakah Anda yakin ingin logout?')">
                                Logout
                            </button>
                        </form>
                    @else
                        <div class="px-3 py-2 text-gray-600 font-medium text-center">
                            Silakan login untuk mengakses website
                        </div>
                        <a href="{{ route('login') }}"
                           class="block px-3 py-2 rounded-md text-base font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 transition-all duration-200 text-center">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                           class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gradient-to-r from-blue-600 to-teal-500 hover:from-teal-500 hover:to-blue-600 transition-all duration-200 text-center mx-3">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content with top padding for fixed header -->
    <main class="container mx-auto px-4 pt-24 pb-16 min-h-screen relative z-10">
        <div class="{{ $overlayClass ?? 'bg-overlay' }} rounded-2xl p-6 min-h-[calc(100vh-12rem)]">
        @if(session('success'))
            <div class="mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm fade-in relative group hover-scale" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline ml-2">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-sm fade-in relative group hover-scale" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline ml-2">{{ session('error') }}</span>
                </div>
            </div>
        @endif

            @yield('content')
        </div>
    </main>

    <!-- Back to top button -->
    <button id="back-to-top"
            class="fixed bottom-8 right-8 p-3 rounded-full bg-blue-600 text-white shadow-lg cursor-pointer hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 opacity-0 translate-y-10"
            onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            style="display: none;">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white relative overflow-hidden z-20" style="background: #0f172a !important;">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-800/90 via-slate-900/95 to-blue-900/90"></div>

        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-blue-500/20 to-teal-500/20"></div>
            <div class="absolute top-10 left-10 w-32 h-32 bg-blue-400/10 rounded-full blur-xl"></div>
            <div class="absolute bottom-10 right-10 w-40 h-40 bg-teal-400/10 rounded-full blur-xl"></div>
        </div>

        <div class="container mx-auto px-4 py-12 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Tentang -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-xl font-bold mb-4 bg-gradient-to-r from-blue-300 to-teal-300 bg-clip-text text-transparent">Tentang Explore Jember</h3>
                    <p class="text-slate-300 mb-4 leading-relaxed">Temukan permata tersembunyi dan destinasi indah di Jember melalui katalog wisata komprehensif kami. Rasakan budaya, alam, dan atraksi yang membuat Jember unik.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="group p-2 rounded-lg bg-slate-700/50 hover:bg-blue-600 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="group p-2 rounded-lg bg-slate-700/50 hover:bg-sky-500 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="group p-2 rounded-lg bg-slate-700/50 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-white transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.061-1.28.073-1.687.073-4.947s-.015-3.667-.073-4.947c-.059-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Tautan Cepat -->
                <div>
                    <h3 class="text-xl font-bold mb-4 text-blue-200">Tautan Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-slate-300 hover:text-blue-300 transition-colors duration-200 flex items-center group">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-3 group-hover:bg-blue-300 transition-colors duration-200"></span>
                            Beranda
                        </a></li>
                        <li><a href="{{ route('destinations.index') }}" class="text-slate-300 hover:text-blue-300 transition-colors duration-200 flex items-center group">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-3 group-hover:bg-blue-300 transition-colors duration-200"></span>
                            Wisata
                        </a></li>
                        <li><a href="{{ route('search') }}" class="text-slate-300 hover:text-blue-300 transition-colors duration-200 flex items-center group">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-3 group-hover:bg-blue-300 transition-colors duration-200"></span>
                            Cari Wisata
                        </a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="text-xl font-bold mb-4 text-blue-200">Kontak</h3>
                    <ul class="space-y-3 text-slate-300">
                        <li class="flex items-center space-x-3 group hover:bg-slate-700/30 p-2 rounded-lg transition-colors duration-200">
                            <div class="p-2 bg-blue-600/20 rounded-lg group-hover:bg-blue-600/30 transition-colors duration-200">
                                <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="group-hover:text-blue-200 transition-colors duration-200">info@lensajember.com</span>
                        </li>
                        <li class="flex items-center space-x-3 group hover:bg-slate-700/30 p-2 rounded-lg transition-colors duration-200">
                            <div class="p-2 bg-teal-600/20 rounded-lg group-hover:bg-teal-600/30 transition-colors duration-200">
                                <svg class="w-4 h-4 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <span class="group-hover:text-teal-200 transition-colors duration-200">+62 331 123456</span>
                        </li>
                        <li class="flex items-center space-x-3 group hover:bg-slate-700/30 p-2 rounded-lg transition-colors duration-200">
                            <div class="p-2 bg-purple-600/20 rounded-lg group-hover:bg-purple-600/30 transition-colors duration-200">
                                <svg class="w-4 h-4 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span class="group-hover:text-purple-200 transition-colors duration-200">Jl. Kalimantan No.37, Jember</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Hak Cipta -->
            <div class="border-t border-slate-600/50 mt-12 pt-8 text-center">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-slate-400">&copy; {{ date('Y') }} Explore Jember. Semua hak dilindungi.</p>
                    <div class="flex items-center space-x-4 text-sm text-slate-400">
                        <a href="#" class="hover:text-blue-300 transition-colors duration-200">Kebijakan Privasi</a>
                        <span class="text-slate-600">•</span>
                        <a href="#" class="hover:text-blue-300 transition-colors duration-200">Syarat & Ketentuan</a>
                        <span class="text-slate-600">•</span>
                        <a href="#" class="hover:text-blue-300 transition-colors duration-200">Bantuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Back to top button
        const backToTopButton = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.style.display = 'block';
                setTimeout(() => {
                    backToTopButton.classList.remove('opacity-0', 'translate-y-10');
                }, 50);
            } else {
                backToTopButton.classList.add('opacity-0', 'translate-y-10');
                setTimeout(() => {
                    backToTopButton.style.display = 'none';
                }, 300);
            }
        });
    </script>
</body>
</html>
