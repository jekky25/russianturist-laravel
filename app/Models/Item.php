<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Foto;

class Item extends Model
{
    use HasFactory;

    /**
     * get fotos
     */
    public function fotos()
    {
      return $this->hasMany(
        Foto::class,
        'foto_parent_id',
        'items_id');
    }
}
