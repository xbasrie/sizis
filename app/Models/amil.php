<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class amil extends Model
{
    use HasFactory;
        protected $fillable = [
        'nama_amil',
        'notlp_amil',
    ];
}
