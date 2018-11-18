<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 11:20
 */

namespace App\Storage\LaravelImpl;


use App\Storage\StorageInterface;
use Illuminate\Contracts\Filesystem\FileExistsException;
use Illuminate\Http\UploadedFile;
use League\Flysystem\FileNotFoundException;

abstract class Storage implements StorageInterface
{

    /**
     * @return string path to base directory relative by @projectDir/storage/app
     */
    abstract function baseDir();

    /**
     * @param $fileName
     * @return boolean
     */
    function checkExist($fileName)
    {
        return file_exists($this->baseDir().$fileName);
    }

    /** Store a file to storage
     * @param UploadedFile $file file to store
     * @return string path to new file
     * @exception FileExistsException
     */
    function store($file)
    {
        $upload = $file->getClientOriginalName();
        $filename = str_slug(pathinfo($upload, PATHINFO_FILENAME));
        $fileExtension = str_slug(pathinfo($upload, PATHINFO_EXTENSION));
        $newName = time() . '_' . $filename . '.' . $fileExtension;

        if($this->checkExist($newName)) {
            throw new FileExistsException();
        } else {
            $file->move($this->baseDir(), $newName);
            return $newName;
        }
    }

    /** Delete file from storage
     * @param string $fileName
     * @return string path to deleted file
     * @exception FileNotFoundException
     */
    function delete($fileName)
    {
        $filePath = $this->baseDir().$fileName;
        if(!$this->checkExist($fileName)) {
            throw new FileNotFoundException($fileName);
        } else {
            unlink($filePath);
        }
        return $filePath;
    }

    /** replace a file or create if not exist
     * @param string $oldFileName old file name
     * @param UploadedFile $new
     * @return string path to new file
     */
    function replace($oldFileName, $new)
    {
        if($this->checkExist($oldFileName)){
            $this->delete($oldFileName);
        }

        try {
            $this->store($new);
            return $new;
        } catch (FileExistsException $e) {
            throw $e;
        }
    }
}
