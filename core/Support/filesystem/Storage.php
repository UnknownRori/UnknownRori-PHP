<?php

namespace Core\Support\Filesystem;

use Core\Support\Collection;

class Storage
{
    protected static $uploadDir;
    protected static $option = [
        'overwrite' => true,
        'max-size' => 500000,
        'type' => 'image',
    ];

    /**
     * Upload a file into public/storage directory
     * @param  file $file
     * @param  array $option
     * @return string|void Uploaded path
     */
    public static function upload($file, array $option = null)
    {
        $path = require($_ENV['APP_DIR'] . '/config/storage.php');
        self::$uploadDir = $_ENV['ROOT_PROJECT'] . $path['path'];
        self::$option = collect(self::$option);
        if (!is_null($option)) {
            self::$option->fill($option);
            self::$option->save();
        };
        $target_upload = self::$uploadDir . '/' . basename($file["name"]);
        $file['type'] = explode('/', $file['type']);
        if ($file['type'][0] == 'image') {
            $file['img_size'] = getimagesize($file["tmp_name"]);
        }

        if ($file['type'][0] == self::$option->get('type')) {
            if ($file['size'] < self::$option->get('max-size')) {

                if (self::$option->get('overwrite') == true) {
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
