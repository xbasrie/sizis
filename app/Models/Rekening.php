<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    protected $fillable = [
      'bank',
      'nama',
      'norek',
    ];

    public function getDisplayNameAttribute(): string
    {
        // Gabungkan kolom 'nama_bank' dan 'atas_nama'
        return $this->bank . ' (a.n. ' . $this->nama . ')';
    }
}
