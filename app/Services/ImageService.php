<?
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\Picture;
use File;

class ImageService
{
	const SEPARATOR			= '/';
	const PATH_STORAGE		= 'storage';

	/**
	* get a type of the picture from the model
	* @param string $type
	* @return string
	*/
	public static function getPictureType($type)
	{
		return constant(Picture::class . "::" . $type);
	}

	/**
	* get picture by id
	* @return \App\Models\Picture 
	*/
	public function getById($id)
	{
		return Picture::select('*')
			->where('id', $id)
			->firstOrFail();
	}

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
	 * @param Picture $picture
	 *
	 * @return bool
	 */
	public function destroyPicture(Picture $picture)
	{
		$this->destroy($picture->ImagePath);
		$picture->delete();
		return true;
	}

	public function addAppDir($url)
	{
		return str_replace(self::PATH_STORAGE . self::SEPARATOR,'', $url);
	}

	/**
	 * create image in the model
	 * @param int $parentId
	 * @param string $type
	 * @param UploadedFile $image
	 *
	 * @return void|bool
	 */
	public function create($parentId, $class, $image)
	{
		if (empty($image)) return false;
		$imageName = $this->put($class::IMAGES_DIRECTORY, $image);
		$requestPicture = [
			'parent_id'	=> $parentId,
			'position'	=> Picture::START_SORT,
			'type'		=> $class::IMAGES_TYPE,
			'image'		=> $imageName
		];
		Picture::create($requestPicture);
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
	 * @param Picture $picture
	 *
	 * @return void
	 */
	public static function copyFromOldToNewFormat(Picture $picture)
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