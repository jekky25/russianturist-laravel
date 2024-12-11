<?
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ImageService
{
	const SEPARATOR = '/';

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
		Storage::delete($url);
		return true;
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
}