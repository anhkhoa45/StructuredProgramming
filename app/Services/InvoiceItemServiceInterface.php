<?php
/**
 * Created by PhpStorm.
 * User: hung
 * Date: 01/12/2018
 * Time: 22:31
 */


namespace App\Services;


use Illuminate\Http\Request;

/**
 * Interface ProductServiceInterface
 * @package App\Services\Interfaces
 */
interface InvoiceItemServiceInterface
{
    /**
     * @param $id
     * @return mixed
     */
    function find($id);

    /**
     * @param $id
     * @return mixed
     */
    function delete($id);


    /**
     * Get a number of best seller products
     * @param $num
     * @return InvoiceItem list of best seller Product
     */
    public function getBestSellerProductList($num);
}
