<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 14:27
 */

namespace App\Services;


use Illuminate\Http\Request;

/**
 * Interface ProductServiceInterface
 * @package App\Services\Interfaces
 */
interface ProductServiceInterface extends ServiceInterface
{
    /**
     * Count product
     * @return number
     */
    public function count();
    
    /**
     * @param $request
     * @return mixed
     */
    function checkQuantity(Request $request);
}
