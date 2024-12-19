<?
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\Foto;
use File;

class ImageService
{
	const SEPARATOR			= '/';
	const PATH_STORAGE		= 'storage';

	/**
	 * put image to the storage
	 * @param string $dir
	 * @param UploadedFile $file 
	 *
	 * @return string
	 */
	public function put($dir = null, UploadedFile $file)
	{
		if ($dir == null) throw new \Exception('Failed directory.');
		$url = Storage::put($dir, $file);
		return $this->removeDirFromString($url, $dir);
	}

	/**
	 * destroy image from the storage
	 * @param string $url
	 *
	 * @return bool
	 */
	public function destroy($url)
	{
		Storage::delete($this->addAppDir($url));
		return true;
	}

	/**
	 * destroy image from the storage and from the model
	 * @param Foto $foto
	 *
	 * @return bool
	 */
	public function destroyFoto(Foto $foto)
	{
		$this->destroy($foto->ImagePath);
		$foto->delete();
		return true;
	}

	public function addAppDir($url)
	{
		return str_replace(self::PATH_STORAGE . self::SEPARATOR,'', $url);
	}

	/**
	 * update image in the storage
	 * @param string $url
	 * @param string $dir
	 * @param UploadedFile $file
	 *
	 * @return string
	 */
	public function update($url, $dir = null, UploadedFile $file)
	{
		$this->destroy($url);
		return $this->put($dir, $file);
	}

	/**
	 * clear the full image url from the directory url
	 * @param string $url
	 * @param string $dir
	 *
	 * @return string
	 */
	public function removeDirFromString($url, $dir)
	{
		return str_replace($dir . self::SEPARATOR, '', $url);
	}

	/**
	 * copy pictures from the old folder to the new folder in the storage
	 * @param Foto $picture
	 *
	 * @return void
	 */
	public static function copyFromOldToNewFormat(Foto $picture)
	{
		try {
			$picture->image = $picture->id . '.jpg';
			$putPath		= $picture->getStorageSectionByName($picture->type) . self::SEPARATOR . $picture->image;
			$oldFileName	= $picture->getOldPathPicture();
			$oldFile		= File::get($oldFileName);
			Storage::put($putPath, $oldFile);
			$picture->update();
		} catch (\Exception $e) {
			throw new \Exception('Failed to copy a picture '.$e->getMessage());
		}
	}
}