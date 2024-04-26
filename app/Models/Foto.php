<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    /**
    * get hotel
    */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
