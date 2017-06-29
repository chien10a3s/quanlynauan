<?php
/**
 * Created by PhpStorm.
 * User: danon
 * Date: 6/22/2017
 * Time: 10:44 PM
 */

namespace App\Helpers;


class CommonHelper
{
    /**
     * Get image object
     * @param $image_path
     * @return string
     */
    public static function getPublicImagePath($image_path)
    {
        $image_default = "";
        if (!empty($image_path)) {
            if (!filter_var($image_path, FILTER_VALIDATE_URL) === false) {
                return $image_path;
            } else {
                if (file_exists(public_path() . $image_path)) {
                    $image_default = $image_path;
                }
            }
        }else{
            $image_default = "/images/noimage.jpg?time=1477933214";
        }
        return $image_default;
    }
}