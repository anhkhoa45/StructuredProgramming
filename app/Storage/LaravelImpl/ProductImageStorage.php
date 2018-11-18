<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 10:58
 */

namespace App\Storage\LaravelImpl;


use App\Product;
use App\Storage\ProductImageStorageInterface;

class ProductImageStorage extends Storage implements ProductImageStorageInterface
{
    const PUBLIC_DIR = '/storage/products/';
    const DEFAULT_IMAGE = '/storage/products/default.jpg';

    /**
     * @return string path to base directory, relative to '@projectDir/storage/'
     */
    function baseDir()
    {
        return storage_path('app/public/products');
    }

    /**
     * @param Product $product
     * @return mixed|string
     */
    function getProductPublicImage(Product $product){
        if($product->image == '' || !$this->checkExist($product->image))
            return self::DEFAULT_IMAGE;

        return self::PUBLIC_DIR.$product->image;
    }
}
