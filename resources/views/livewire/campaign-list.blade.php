<div>
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-y-0 left-0 w-1/2 bg-gray-50"></div>
        </div>
        <div class="relative max-w-7xl mx-auto lg:grid lg:grid-cols-2 lg:px-8">
            <div class="px-4 pt-16 pb-16 sm:px-6 sm:pt-24 sm:pb-32 lg:max-w-xl lg:px-0">
                <div class="sm:flex sm:flex-col sm:items-start">
                    <div class="inline-flex items-center px-3 py-1 rounded-full border border-orange-100 bg-orange-50 text-orange-600 text-sm font-medium mb-6">
                        <span class="flex h-2 w-2 rounded-full bg-lazismu-orange mr-2"></span>
                        Program Terbaru 2026
                    </div>
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl mb-6 leading-tight">
                        Aksi Bersama untuk <span class="text-lazismu-orange">Sesama</span>
                    </h1>
                    <p class="text-lg text-gray-500 mb-8 leading-relaxed">
                        Salurkan kepedulian Anda melalui Lazismu. Bersama kita wujudkan kehidupan yang lebih baik bagi mereka yang membutuhkan melalui Zakat, Infaq, dan Sedekah.
                    </p>
                    <div class="mt-4 sm:flex sm:justify-center lg:justify-start gap-4">
                        <a href="#campaigns" class="w-full sm:w-auto flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-full text-white bg-lazismu-orange hover:bg-orange-600 md:text-lg shadow-lg shadow-orange-500/30 transition-all hover:-translate-y-1">
                            Mulai Donasi
                        </a>
                        <a href="#" class="w-full sm:w-auto flex items-center justify-center px-8 py-4 border border-gray-200 text-base font-bold rounded-full text-gray-700 bg-white hover:bg-gray-50 md:text-lg transition-all hover:border-orange-200">
                            Pelajari Cara Kerja
                        </a>
                    </div>
                </div>
            </div>
            <!-- Hero Image/Graphic -->
            <div class="hidden lg:block absolute inset-y-0 right-0 w-1/2 bg-lazismu-orange/10">
                <div class="h-full w-full object-cover flex items-center justify-center">
                   <!-- Decorative Pattern or Image -->
                   <svg class="h-full w-full text-lazismu-orange/20" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                       <path d="M0 0 C 50 100 80 100 100 0 Z"></path>
                   </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-lazismu-orange py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <div>
                    <div class="text-4xl font-bold mb-2">150+</div>
                    <div class="text-orange-100 font-medium">Program Aktif</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">12K+</div>
                    <div class="text-orange-100 font-medium">Donatur Terdaftar</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">5M+</div>
                    <div class="text-orange-100 font-medium">Dana Terhimpun</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">25K+</div>
                    <div class="text-orange-100 font-medium">Penerima Manfaat</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Campaigns List -->
    <div id="campaigns" class="bg-gray-50 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-lazismu-orange font-semibold tracking-wide uppercase text-sm mb-3">Program Unggulan</h2>
                <h3 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-4">Mari Bantu Mereka yang Membutuhkan</h3>
                <p class="text-gray-500 text-lg">Pilih program kebaikan yang ingin Anda dukung hari ini.</p>
            </div>

            <!-- Optional: Search/Filter (Visual only for now) -->
            <div class="max-w-xl mx-auto mb-12 relative">
                <input type="text" placeholder="Cari program donasi..." class="w-full px-6 py-4 rounded-full border-none shadow-lg focus:ring-2 focus:ring-lazismu-orange text-gray-700 pl-14">
                <svg class="w-6 h-6 text-gray-400 absolute left-5 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>

            <div class="grid gap-10 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
                @foreach($campaigns as $campaign)
                <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col h-full transform hover:-translate-y-1">
                    
                    <!-- Image Area -->
                    <div class="relative h-56 w-full overflow-hidden">
                        <div class="absolute inset-0 bg-gray-200 animate-pulse" wire:loading></div>
                        @if($campaign->foto)
                            <img class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ \Illuminate\Support\Facades\Storage::url($campaign->foto) }}" alt="{{ $campaign->judul }}">
                        @else
                            <div class="h-full w-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-lazismu-orange shadow-sm">
                            DONASI
                        </div>
                    </div>
                    
                    <!-- Content Area -->
                    <div class="p-6 flex-1 flex flex-col">
                        <a href="{{ route('campaign.detail', $campaign->slug) }}" class="block">
                            <h4 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-lazismu-orange transition line-clamp-2">
                                {{ $campaign->judul }}
                            </h4>
                            <div class="text-gray-500 text-sm line-clamp-2 mb-6 leading-relaxed">
                                {!! Str::limit(strip_tags($campaign->deskripsi), 120) !!}
                            </div>
                        </a>

                        <div class="mt-auto">
                            <!-- Progress Bar -->
                            @php
                                $percentage = $campaign->target_dana > 0 
                                    ? min(100, round(($campaign->dana_terkumpul / $campaign->target_dana) * 100)) 
                                    : 0;
                            @endphp
                            
                            <div class="mb-5">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-600 font-medium">Terkumpul</span>
                                    <span class="text-lazismu-orange font-bold">{{ $percentage }}%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-lazismu-orange h-2.5 rounded-full transition-all duration-1000 ease-out" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="flex justify-between mt-2 text-xs text-gray-500 font-medium">
                                    <span>Rp {{ number_format($campaign->dana_terkumpul, 0, ',', '.') }}</span>
                                    <span>Target: Rp {{ number_format($campaign->target_dana, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <a href="{{ route('campaign.detail', $campaign->slug) }}" class="block w-full text-center px-6 py-3 border border-lazismu-orange text-lazismu-orange font-bold rounded-xl hover:bg-lazismu-orange hover:text-white transition-all shadow-sm hover:shadow-md">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
