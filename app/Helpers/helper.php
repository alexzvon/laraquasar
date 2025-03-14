<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('maxIndexDir')) {
    function maxIndexDir($dirs = [])
    {
        $arrIndex = [];

        foreach ($dirs as $dir) {
            $arr = explode('/', $dir);
            $arrIndex[] = (int) end($arr);
        }

        return $arrIndex ? max($arrIndex) : -1;
  }
}

if (!function_exists('indexDirPictureImage')) {
    function indexDirPictureImage($dir = '')
    {
        $arr = explode('/', $dir);
        array_pop($arr);

        return array_pop($arr);
  }
}

if (!function_exists('reInstanceArray')) {
    function reInstanceArray($arr = [])
    {
        $new = [];
        foreach($arr as $val) $new[] = $val;

        return $new;
  }
}
