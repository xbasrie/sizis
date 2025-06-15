<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penerima extends Model
{
    use HasFactory;
        protected $fillable = [
        'nama',
        'alamat',
        'notlp',
        'kategori_penerima_id', // Kolom foreign key
    ];

    public function kategoriPenerima(): BelongsTo
    {
        return $this->belongsTo(KategoriPenerima::class);
    }
}
