<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPenerima extends Model
{
    use HasFactory;
        protected $fillable = [
      'kategori',
    ];

    public function Penerima(): HasMany
    {
        return $this->hasMany(Penerima::class);
    }
}
