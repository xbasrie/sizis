<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Lazismu') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">
    
    <!-- Navbar -->
    <header x-data="{ scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 20)"
            :class="{ 'bg-white shadow-md': scrolled, 'bg-white/90 backdrop-blur-sm': !scrolled }"
            class="fixed w-full top-0 z-50 transition-all duration-300 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-2 group">
                        <img src="{{ asset('assets/images/logo-lazismu-WAGE-.png') }}" alt="Lazismu Logo" class="h-12 w-auto">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-600 hover:text-lazismu-orange font-medium transition px-3 py-2 rounded-md hover:bg-orange-50">Beranda</a>
                    <a href="#" class="text-gray-600 hover:text-lazismu-orange font-medium transition px-3 py-2 rounded-md hover:bg-orange-50">Program</a>
                    <a href="#" class="text-gray-600 hover:text-lazismu-orange font-medium transition px-3 py-2 rounded-md hover:bg-orange-50">Tentang Kami</a>
                    <a href="#" class="text-gray-600 hover:text-lazismu-orange font-medium transition px-3 py-2 rounded-md hover:bg-orange-50">Kontak</a>
                </nav>

                <!-- CTA Button -->
                <div class="hidden md:flex items-center">
                    @auth
                        <a href="/admin" class="text-gray-600 hover:text-lazismu-orange font-medium mr-4">Dashboard</a>
                    @else
                        <a href="/admin/login" class="text-gray-600 hover:text-lazismu-orange font-medium mr-4">Masuk</a>
                    @endauth
                    <a href="#campaigns" class="bg-lazismu-orange text-white px-5 py-2.5 rounded-full font-semibold shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 hover:bg-orange-600 transform hover:-translate-y-0.5 transition-all duration-200">
                        Donasi Sekarang
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="text-gray-500 hover:text-gray-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow pt-20">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8 border-t border-gray-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <img src="{{ asset('assets/images/logo-lazismu-WAGE-.png') }}" alt="Lazismu Logo" class="h-10 w-auto bg-white rounded p-1">
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        Lembaga Amil Zakat Nasional yang berkhidmat dalam pemberdayaan masyarakat melalui pendayagunaan dana Zakat, Infaq, Sadaqah.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6 text-white">Program</h3>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="#" class="hover:text-lazismu-orange transition">Pendidikan</a></li>
                        <li><a href="#" class="hover:text-lazismu-orange transition">Kesehatan</a></li>
                        <li><a href="#" class="hover:text-lazismu-orange transition">Ekonomi</a></li>
                        <li><a href="#" class="hover:text-lazismu-orange transition">Dakwah & Sosial</a></li>
                        <li><a href="#" class="hover:text-lazismu-orange transition">Kemanusiaan</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6 text-white">Tentang</h3>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="#" class="hover:text-lazismu-orange transition">Profil</a></li>
                        <li><a href="#" class="hover:text-lazismu-orange transition">Visi Misi</a></li>
                        <li><a href="#" class="hover:text-lazismu-orange transition">Struktur Organisasi</a></li>
                        <li><a href="#" class="hover:text-lazismu-orange transition">Laporan Keuangan</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6 text-white">Hubungi Kami</h3>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-lazismu-orange mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Gedung Pusat Dakwah Muhammadiyah, Jl. Menteng Raya No.62, Jakarta Pusat</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-lazismu-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>info@lazismu.org</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-lazismu-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>021-3150400</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Lazismu. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition"><span class="sr-only">Facebook</span>FB</a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><span class="sr-only">Instagram</span>IG</a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><span class="sr-only">Twitter</span>TW</a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><span class="sr-only">YouTube</span>YT</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
