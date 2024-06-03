<?php
namespace App\Services;

use App\Models\Town;

class TownService
{
	private $towns;
	/**
	 * get all towns
	 * @return \Illuminate\Database\Eloquent\Collection 
	 */
	public function getAll()
	{
		$this->towns = Town::select('*')->orderBy('towns_name')->get();
		$this->getFotos();
		return $this->towns;
	}

	/**
	 * add pictures of the towns to the object
	 * @return void
	 */
	public function getFotos()
	{
		foreach ($this->towns as &$row) 
		{
			$foto = $row->fotos()
				->where('foto_type','town')
				->orderBy('foto_position')
				->first();
			$row['fotos'] = $foto;
		
			$stars = '';
			$row['fotoStr']		= !empty ($row['fotos']) ? asset('fotos/towns/' . $row['fotos']['foto_id'] . '.jpg') : asset ('image/no_foto.jpg');
        }
	}

	/**
     * get town by name
     * @param  string  $name
     * @return \Illuminate\Database\Eloquent\Collection 
     */
	public function getByName($name)
	{
		$town = Town::select('*')
				->where('towns_eng_name', $name)
				->first();

		$town->towns_description = str_replace("\n", "\n<br />\n", $town->towns_description);
		$town->country = $town->country()->first();

		$foto   = $town->fotos()
				->where('foto_type','town')
				->orderBy('foto_position')
				->first()
				->toArray();
		
		$town->foto	= $foto;
		return $town;
    }


	public function getPictureLink($town, $width, $height)
	{
		$foto_out 					= !empty ($town->foto) ? asset('/fotos/towns/' . $town->foto['foto_id'] . '.jpg') : '';
		$town->towns_img 			= !empty($foto_out) ? '<img title="' . $town->towns_name . '" alt="' . $town->towns_name . '" src="' . $foto_out . '" width="' . $width . '" height="' . $height . '">' : '';
		return ($town);
	}
}