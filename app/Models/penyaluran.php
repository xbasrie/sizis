<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class penyaluran extends Model
{
    use HasFactory;
    protected $fillable = [
        'penerima_id',
        'amil_id',
        'uang',
        'beras',
        'tanggal_penyaluran',
        'keterangan',
        'kategori_zis_id',
    ];

    public function penerima(): BelongsTo
    {
        return $this->belongsTo(Penerima::class);
    }

    // Definisikan relasi ke model Amil
    public function amil(): BelongsTo
    {
        return $this->belongsTo(Amil::class);
    }

    public function kategoriZis(): BelongsTo
    {
        return $this->belongsTo(KategoriZis::class);
    }
}
