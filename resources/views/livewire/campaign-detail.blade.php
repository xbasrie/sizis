<div class="bg-gray-50 min-h-screen pb-12">
    <!-- Breadcrumb (Optional, simplistic) -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
            <nav class="flex text-sm text-gray-500 font-medium">
                <a href="/" class="hover:text-lazismu-orange transition">Beranda</a>
                <span class="mx-2 text-gray-300">/</span>
                <span class="text-gray-900 truncate">{{ Str::limit($campaign->judul, 40) }}</span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-12">
            
            <!-- Main Content (Left) -->
            <div class="lg:col-span-8">
                <!-- Image -->
                <div class="relative h-96 w-full rounded-2xl overflow-hidden shadow-lg mb-8 group">
                    @if($campaign->foto)
                        <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ \Illuminate\Support\Facades\Storage::url($campaign->foto) }}" alt="{{ $campaign->judul }}">
                    @else
                        <div class="h-full w-full bg-gray-200 flex items-center justify-center text-gray-500 text-lg font-medium">
                            No Image Available
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                         <span class="bg-lazismu-orange text-white px-4 py-1.5 rounded-full text-sm font-bold shadow-md">
                            Sedang Berjalan
                         </span>
                    </div>
                </div>

                <!-- Title & stats for mobile (hidden on desktop usually, but kept for clarity) -->
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                    {{ $campaign->judul }}
                </h1>

                <!-- Tabs / Content -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-4">
                        <h3 class="text-lg font-bold text-gray-900">Cerita Penggalangan Dana</h3>
                    </div>
                    <div class="p-8 prose prose-orange max-w-none prose-lg text-gray-600 leading-relaxed">
                        {!! $campaign->deskripsi !!}
                    </div>
                    
                    <!-- Share Section -->
                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                         <span class="font-medium text-gray-700">Bagikan kebaikan ini:</span>
                         <div class="flex space-x-4">
                             <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:opacity-90 transition">
                                <span class="sr-only">Facebook</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
                             </button>
                             <button class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:opacity-90 transition">
                                <span class="sr-only">WhatsApp</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                             </button>
                         </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar (Right) -->
            <div class="lg:col-span-4 mt-8 lg:mt-0">
                <div class="sticky top-24 space-y-6">
                    
                    <!-- Progress Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform transition-all hover:shadow-xl">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Target Donasi</h3>
                            
                            @php
                                $percentage = $campaign->target_dana > 0 
                                    ? min(100, round(($campaign->dana_terkumpul / $campaign->target_dana) * 100)) 
                                    : 0;
                            @endphp

                            <div class="flex items-end gap-2 mb-2">
                                <span class="text-3xl font-extrabold text-lazismu-orange">Rp {{ number_format($campaign->dana_terkumpul, 0, ',', '.') }}</span>
                            </div>
                            <div class="text-sm text-gray-500 mb-4">
                                terkumpul dari target <span class="font-semibold text-gray-700">Rp {{ number_format($campaign->target_dana, 0, ',', '.') }}</span>
                            </div>

                            <div class="w-full bg-gray-100 rounded-full h-3 mb-6">
                                <div class="bg-lazismu-orange h-3 rounded-full relative" style="width: {{ $percentage }}%">
                                    <div class="absolute -right-2 -top-1 w-5 h-5 bg-white rounded-full border-2 border-lazismu-orange shadow-sm"></div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center text-sm font-medium text-gray-500 mb-6">
                                <span>{{ $percentage }}% Tercapai</span>
                                <span>{{ $campaign->created_at->diffForHumans() }}</span>
                            </div>

                            <!-- Integrated Donation Form Component -->
                            <livewire:donation-form :campaign="$campaign" />
                        </div>
                    </div>

                    <!-- Security Badge -->
                    <div class="bg-blue-50 rounded-xl p-4 flex items-center gap-4 border border-blue-100">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Donasi Aman & Transparan</h4>
                            <p class="text-xs text-gray-600">Terverifikasi oleh Lazismu Pusat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
