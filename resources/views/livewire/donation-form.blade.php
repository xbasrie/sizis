<div class="mt-6 border-t border-gray-100 pt-6">
    @if (session()->has('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4 rounded-r">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4 rounded-r">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="donate" class="space-y-4" enctype="multipart/form-data">
        
        <!-- Quick Amounts -->
        <div class="grid grid-cols-2 gap-3 mb-2">
            <button type="button" wire:click="$set('nominal', 50000)" class="py-2 px-3 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:border-lazismu-orange hover:text-lazismu-orange hover:bg-orange-50 transition">
                Rp 50.000
            </button>
            <button type="button" wire:click="$set('nominal', 100000)" class="py-2 px-3 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:border-lazismu-orange hover:text-lazismu-orange hover:bg-orange-50 transition">
                Rp 100.000
            </button>
            <button type="button" wire:click="$set('nominal', 200000)" class="py-2 px-3 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:border-lazismu-orange hover:text-lazismu-orange hover:bg-orange-50 transition">
                Rp 200.000
            </button>
            <button type="button" wire:click="$set('nominal', 500000)" class="py-2 px-3 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:border-lazismu-orange hover:text-lazismu-orange hover:bg-orange-50 transition">
                Rp 500.000
            </button>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nominal Lainnya</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">Rp</span>
                    </div>
                    <input wire:model.live="nominal" type="number" min="10000" class="block w-full pl-10 pr-12 py-3 border-gray-300 rounded-xl focus:ring-lazismu-orange focus:border-lazismu-orange text-gray-900 placeholder-gray-400 bg-gray-50 focus:bg-white transition" placeholder="0">
                </div>
                @error('nominal') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                <input wire:model="nama" type="text" class="block w-full py-3 px-4 border-gray-300 rounded-xl focus:ring-lazismu-orange focus:border-lazismu-orange text-gray-900 bg-gray-50 focus:bg-white transition" placeholder="Nama Hamba Allah">
                @error('nama') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email (Opsional)</label>
                <input wire:model="email" type="email" class="block w-full py-3 px-4 border-gray-300 rounded-xl focus:ring-lazismu-orange focus:border-lazismu-orange text-gray-900 bg-gray-50 focus:bg-white transition" placeholder="email@contoh.com">
                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Bukti Transfer</label>
                <input wire:model="bukti_transfer" type="file" id="bukti_transfer" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-lazismu-orange hover:file:bg-orange-100 transition">
                <p class="text-xs text-gray-500 mt-1">Silakan transfer ke rekening yang tersedia di atas, lalu upload bukti transfer di sini.</p>
                @error('bukti_transfer') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                
                @if ($bukti_transfer) 
                    <div class="mt-2">
                        <img src="{{ $bukti_transfer->temporaryUrl() }}" class="h-24 w-auto rounded shadow-sm">
                    </div>
                @endif
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Doa/Dukungan (Opsional)</label>
                <textarea wire:model="keterangan" rows="3" class="block w-full py-3 px-4 border-gray-300 rounded-xl focus:ring-lazismu-orange focus:border-lazismu-orange text-gray-900 bg-gray-50 focus:bg-white transition" placeholder="Tulis doa atau pesan dukungan..."></textarea>
                @error('keterangan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <button type="submit" wire:loading.attr="disabled" class="w-full mt-6 flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-base font-bold text-white bg-lazismu-orange hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lazismu-orange transition-all hover:shadow-orange-500/30 disabled:opacity-75 disabled:cursor-not-allowed">
            <span wire:loading.remove>Kirim Donasi</span>
            <span wire:loading class="flex items-center gap-2">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Mengirim...
            </span>
        </button>
        <p class="text-xs text-center text-gray-400 mt-4">
            Dengan berdonasi, Anda menyetujui Syarat & Ketentuan Lazismu.
        </p>
    </form>


    <!-- Success Modal -->
    @if($showSuccessModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none bg-gray-900/20 backdrop-blur-sm transition-opacity" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="relative w-full max-w-md mx-auto my-6 px-4">
            <!--content-->
            <div class="border-0 rounded-2xl shadow-xl relative flex flex-col w-full bg-white outline-none focus:outline-none overflow-hidden">
                <!--body-->
                <div class="relative p-8 flex-auto text-center">
                    <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">
                        Terima Kasih!
                    </h3>
                    
                    <p class="text-gray-600 text-base leading-relaxed mb-6">
                        Donasi Anda telah berhasil dikirim dan sedang dalam proses verifikasi oleh tim kami. Semoga menjadi amal jariyah yang berkah.
                    </p>
                    
                    <button 
                        class="w-full bg-lazismu-orange text-white active:bg-orange-700 font-bold uppercase text-sm px-6 py-3.5 rounded-xl shadow hover:shadow-lg outline-none focus:outline-none ease-linear transition-all duration-150 hover:bg-orange-600 focus:ring-4 focus:ring-orange-200" 
                        type="button" 
                        wire:click="closeSuccessModal"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
