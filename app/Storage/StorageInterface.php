<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 10:59
 */

namespace App\Storage;

use SplFileInfo as File;

interface StorageInterface
{
    /**
     * @param $fileName
     * @return mixed
     */
    function checkExist($fileName);

    /**
     * @param File $file file to store
     * @return string path to new file
     */
    function store($file);

    /**
     * @param string $fileName
     * @return string path to deleted file
     */
    function delete($fileName);

    /**
     * @param string $old old file name
     * @param File $new
     * @return string path to new file
     */
    function replace($oldFileName, $new);
}
