<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 14:08
 */

namespace App\Storage;



use App\Product;

interface ProductImageStorageInterface extends StorageInterface
{
    /**
     * @param Product $product
     * @return mixed
     */
    function getProductPublicImage(Product $product);
}
