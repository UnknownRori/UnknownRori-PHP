<?php

namespace Core\Support\Filesystem;

use Core\Support\Collection;

class Storage
{
    protected static $uploadDir = './public/storage';
    protected static $defaultOption = [
        'overwrite' => false,
        'max-size' => 500000,
        'type' => 'image',
    ];

    public static function upload($file, array $option = null)
    {
        // dd($file);
        self::$defaultOption = new Collection(self::$defaultOption);
        if (!is_null($option)) {
            self::$defaultOption->fill($option);
            self::$defaultOption->save();
        };
        $target_upload = self::$uploadDir . '/' . basename($file["name"]);
        $file['type'] = explode('/', $file['type']);
        if ($file['type'][0] == 'image') {
            $file['img_size'] = getimagesize($file["tmp_name"]);
        }

        if ($file['type'][0] == self::$defaultOption->get('type')) {
            if ($file['size'] < self::$defaultOption->get('max-size')) {

                if (self::$defaultOption->get('overwrite') == true) {
                    move_uploaded_file($file["tmp_name"], $target_upload);
                    return $target_upload;
                } else {

                    if (!file_exists($target_upload)) {
                        move_uploaded_file($file["tmp_name"], $target_upload);
                        return $target_upload;
                    }
                }
            }
        }
    }
}
