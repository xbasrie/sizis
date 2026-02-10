<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'target_dana',
        'dana_terkumpul',
        'foto',
        'status',
        'midtrans_payment_link',
        'kategori_zis_id',
    ];

    public function kategoriZis()
    {
        return $this->belongsTo(KategoriZis::class);
    }

    protected $casts = [
        'status' => 'boolean',
        'target_dana' => 'integer',
        'dana_terkumpul' => 'integer',
    ];
}
