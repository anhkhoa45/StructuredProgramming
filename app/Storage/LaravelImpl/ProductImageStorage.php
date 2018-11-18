<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 10:58
 */

namespace App\Storage\LaravelImpl;


use App\Storage\ProductImageStorageInterface;

class ProductImageStorage extends Storage implements ProductImageStorageInterface
{
    /**
     * @return string path to base directory, relative to '@projectDir/storage/'
     */
    function baseDir()
    {
        return storage_path('app/public/products');
    }
}
