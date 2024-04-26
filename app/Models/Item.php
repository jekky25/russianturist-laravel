<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Foto;

class Item extends Model
{
    use HasFactory;

    /**
     * get article by id
     * @param  integer  $id
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public static function getById($id)
    {
      $item = self::select('*')
          ->where('items_id', $id)
          ->first();
  
  
      $foto   = $item->fotos()
          ->where('foto_type','item')
          ->orderBy('foto_position')
          ->first()
          ->toArray();
      
      $item['foto']	= $foto;
                  
          return $item;
      }

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
