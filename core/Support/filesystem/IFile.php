<?php

namespace Core\Support\Filesystem;

interface IFile
{
    /**
     * Initialize File instance
     * @param  string  $filename
     */
    public function __construct(string $filename);

    /**
     * Copy the file using passed path argumments
     * @param  string  $path - don't forget the filename!
     * @return bool
     */
    public function copy(string $path);

    /**
     * Write the current file with passed data
     * @param  string $data
     * @return void
     */
    public function write(string $data);

    /**
     * Destroy file
     * @return bool
     */
    public function destroy();

    public function type();

    /**
     * Get the content of the file
     * @return string
     */
    public function get();

    /**
     * Get the filepath
     * @return string
     */
    public function path();

    /**
     * Check if the file exists
     * @return bool
     */
    public function exists();

    /**
     * Get the modified file timestamp
     * @return int|false
     */
    public function modified();

    /**
     * Get the create file timestamp
     * @return int|false
     */
    public function createTimestamp();

    /**
     * Get the last access file timestamp
     * @return int|false
     */
    public function lastAccess();
}
