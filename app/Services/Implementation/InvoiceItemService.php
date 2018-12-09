<?php
/**
 * Created by PhpStorm.
 * User: hung
 * Date: 01/12/2018
 * Time: 22:32
 */


namespace App\Services\Implementation;


use App\Services\InvoiceItemServiceInterface;
use App\Storage\LaravelImpl\UserAvatarStorage;
use App\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\FileExistsException;

class InvoiceItemService implements InvoiceItemServiceInterface
{
    const PAGE_SIZE = 8;


    /**
     * @param $id
     * @return mixed
     */
    function find($id)
    {
        return InvoiceItem::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    function delete($id)
    {
        $transaction = InvoiceItem::find($id);

        if(!is_null($transaction)){
            $product=$transaction->product;
            $product->quantity=$product->quantity+$transaction->quatity;
            $transaction->delete();
        }

    }

    /**
     * Get a number of best seller products
     * @param $num
     * @return InvoiceItem list of best seller Product
     */
    public function getBestSellerProductList($num) {
        return InvoiceItem::groupBy('product_id')
            ->selectRaw('product_id, sum(quantity) as sum')
            ->orderBy('sum', 'desc')
            ->take($num)
            ->get();
    }
}
