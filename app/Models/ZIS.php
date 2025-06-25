<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ZIS extends Model
{
    use HasFactory;
    protected $fillable = [
      'donatur_id',
      'nama',
      'alamat',
      'tlp',
      'jenis_donatur',
      'kategori_zis_id',
      'jiwa',
      'beras',
      'uang',
      'keterangan',
      'rekening_id',
      'amil_id',
    ];

    public function donatur(): BelongsTo
    {
        return $this->belongsTo(Donatur::class, 'donatur_id');
    }

    public function rekening(): BelongsTo
    {
        // Menghubungkan 'rekening_id' di tabel z_i_s ke 'id' di tabel rekenings
        return $this->belongsTo(Rekening::class, 'rekening_id');
    }

    public function amil(): BelongsTo
    {
        return $this->belongsTo(Amil::class, 'amil_id');
    }
    
    public function kategoriZis(): BelongsTo
    {
        return $this->belongsTo(KategoriZis::class);
    }
}
