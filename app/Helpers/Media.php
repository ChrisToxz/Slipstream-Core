<?php

namespace App\Helpers;

class Media
{
    public static function isVideo($media)
    {
        if(strstr(self::getType($media), "video/")){
            return true;
        }
    }

    public static function isImage($media)
    {
        if(strstr(self::getType($media), "image/")){
            return true;
        }
    }

    public static function getType($media)
    {
        return mime_content_type($media);
    }
}
