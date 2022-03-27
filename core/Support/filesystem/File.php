<?php

namespace Core\Support\Filesystem;

class File implements IFile
{
    public $filename;
    public $data;

    /**
     * Initialize File instance
     * @param  string  $filename
     */
    public function __construct(string $filename)
    {
        if (!file_exists($filename)) return;
        $this->filename = $filename;
    }

    /**
     * Copy the file using passed path argumments
     * @param  string  $path - don't forget the filename!
     * @return bool
     */
    public function copy(string $path)
    {
        $file = fopen($path, 'w');
        fwrite($file, $this->get());
        fclose($file);
        return file_exists($path);
    }

    /**
     * Write the current file with passed data
     * @param  string $data
     * @return void
     */
    public function write(string $data)
    {
        $file = fopen($this->filename, 'w');
        fwrite($file, $data);
        fclose($file);
    }

    /**
     * Destroy file
     * @return bool
     */
    public function destroy()
    {
        return unlink($this->filename);
    }

    public function type()
    {
        return filetype($this->filename);
    }

    /**
     * Get the content of the file
     * @return string
     */
    public function get()
    {
        return file_get_contents($this->filename);
    }

    /**
     * Get the filepath
     * @return string
     */
    public function path()
    {
        return $this->filename;
    }

    /**
     * Get the modified file timestamp
     * @return int|false
     */
    public function modified()
    {
        return filemtime($this->filename);
    }

    /**
     * Get the create file timestamp
     * @return int|false
     */
    public function create()
    {
        return filectime($this->filename);
    }

    /**
     * Get the last access file timestamp
     * @return int|false
     */
    public function lastaccess()
    {
        return fileatime($this->filename);
    }
}
