<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Foto;

class Country extends Model
{
    use HasFactory;

    public function getAll()
    {
        $countries = self::select('*')->get();
        foreach ($countries as &$row) 
		{
		
			$foto               = $row->fotos()
				                ->where('foto_type','country')
				                ->orderBy('foto_position')
				                ->limit(1)
				                ->get();
			$row['fotos']       = $foto;
            $row['fotoStr'] 	= !empty ($row['fotos']) ? asset('fotos/countries/' . $row['fotos'][0]['foto_id'] . '.jpg') : asset ('image/no_foto.jpg');
        }
        return $countries;
    }

    public function fotos()
    {
      return $this->hasMany(
        Foto::class,
        'foto_parent_id',
        'countries_id');
    }
}
