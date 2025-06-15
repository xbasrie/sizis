<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriZis extends Model
{
    use HasFactory;
        protected $fillable = [
      'kategori',
      'jenis',
    ];
    
    public function getDisplayNameAttribute(): string
    {
        return $this->kategori . ' - ' . $this->jenis;
    }
}
