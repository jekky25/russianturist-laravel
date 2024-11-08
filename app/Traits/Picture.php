<?php

namespace App\Traits;

trait Picture {

    /**
     * replace spaces
     * @param  string  $str

     * @return string
     */
	public function getSizeParams($pictureId, $imgWidth) {
        $img = asset ('/fotos/hotels/' . $pictureId . '.jpg');
		$im = imagecreatefromjpeg( $img );

		$resultX_im =imageSX($im);
		$resultY_im =imageSY($im);
		$img_koefficient = $resultX_im / $resultY_im;

		if ($resultX_im > $imgWidth)
		{
			$resultX_im = $imgWidth;
  			$resultY_im = $resultX_im / $img_koefficient;
		}

		imageDestroy($im);

		$resultX_im_l = $resultX_im - 3;
		if ($resultX_im_l < 0)
			$resultX_im_l = 0;

		$resultY_im_l = $resultY_im - 3;
		if ($resultY_im_l < 0)
  			$resultY_im_l = 0;

        return [
            'resultX_im_l' => $resultX_im_l,
            'resultY_im_l' => $resultY_im_l
        ];
    }
}