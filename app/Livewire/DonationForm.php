<?php

namespace App\Livewire;

use App\Models\Campaign;
use App\Models\ZIS;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class DonationForm extends Component
{
    use WithFileUploads;
    public Campaign $campaign;
    
    public $nama;
    public $email; // Optional, but good for Midtrans
    public $nominal;
    public $keterangan;
    
    public $showSuccessModal = false;

    public $bukti_transfer;
    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'nominal' => 'required|numeric|min:10000',
        'keterangan' => 'nullable|string|max:500',
        'bukti_transfer' => 'required|image|max:2048', // 2MB Max
    ];

    public function mount(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function donate()
    {
        $this->validate();

        // 1. Create Order ID
        $orderId = 'DON-' . time() . '-' . Str::random(5);

        // 2. Upload Bukti Transfer
        $buktiTransferPath = $this->bukti_transfer->store('bukti_transfer', 'public');

        // 3. Create ZIS Record (Pending)      
        // 3. Create ZIS Record (Pending)      
        $kategoriId = $this->campaign->kategori_zis_id ?? (\App\Models\KategoriZis::first()->id ?? 1);
        
        $amil = \App\Models\Amil::where('nama_amil', 'Online Campaign')->first();
        $amilId = $amil ? $amil->id : (\App\Models\Amil::first()->id ?? 1);
        $rekeningId = \App\Models\Rekening::exists() ? \App\Models\Rekening::first()->id : 1;

        ZIS::create([
            'order_id' => $orderId,
            'payment_status' => 'pending',
            'campaign_id' => $this->campaign->id,
            'nama' => $this->nama,
            'uang' => $this->nominal,
            'keterangan' => $this->keterangan ?? ('Donasi untuk ' . $this->campaign->judul),
            'jenis_donatur' => 'Perorangan', // Default
            'tlp' => '-', // Default
            'alamat' => '-', // Default
            'jiwa' => 0,
            'beras' => 0,
            'kategori_zis_id' => $kategoriId,
            'amil_id' => $amilId, 
            'rekening_id' => $rekeningId,
            'bukti_transfer' => $buktiTransferPath,
        ]);

        session()->flash('message', 'Terima kasih! Donasi Anda sedang diverifikasi oleh admin.');
        
        $this->showSuccessModal = true;

        // Reset Form
        $this->reset(['nama', 'email', 'nominal', 'keterangan', 'bukti_transfer']);
    }

    public function closeSuccessModal()
    {
        $this->showSuccessModal = false;
        // Optional: Redirect or just stay on page
    }
    
    public function render()
    {
        return view('livewire.donation-form');
    }
}
