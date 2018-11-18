<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\SAbstractRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProductRepository extends SAbstractRepository
{

    const SORT_BY_ARR = ['DESC', 'ASC'];
    const ORDER_BY = 'id';

    /**
     * Define primary model in this repository.
     * @return string
     */
    public function model()
    {
        return 'App\Product';
    }

    /**
     * Rules create.
     * @return array
     */
    public function rulesCreate()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image',
            'price' => 'required|numeric',
            'size' => 'required',
            'quantity' => 'required',
        ];
    }

    /**
     * Rules update.
     * @return array
     */
    public function rulesUpdate($id)
    {
        $rules = $this->rulesCreate();
        return $rules;
    }

    /**
     * Find a product
     * @param int $productId
     * @return Product
     */
    public function find($productId)
    {
        return Product::find($productId);
    }

    /**
     * Update a product.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return bool
     */
    public function update($request, $id)
    {
        $product = Product::find($id);
        $product->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'size' => $request->get('size'),
            'quantity' => $request->get('quantity')
        ]);
        $avatar = $request->file('image');
        if (isset($avatar)) {
            if($product->avatar != '') Storage::delete($product->avatar);
            $upload = $avatar->getClientOriginalName();
            $filename = str_slug(pathinfo($upload, PATHINFO_FILENAME));
            $fileExtension = str_slug(pathinfo($upload, PATHINFO_EXTENSION));
            $changeName = time() . '_' . $filename . '.' . $fileExtension;
            $avatar->move(Product::PATH_AVATAR, $changeName);
            $avatarPath = Product::PATH_AVATAR . $changeName;
            $product->avatar = $avatarPath;
            $product->save();
        }
        return $product;
    }

    /**
     * Create a product.
     * @param \Illuminate\Http\Request $request
     * @return Product
     */
    public function create($request)
    {
        $product = Product::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'size' => $request->get('size'),
            'quantity' => $request->get('quantity'),
            'image' => ''
        ]);
        $avatar = $request->file('image');
        if (isset($avatar)) {
            $upload = $avatar->getClientOriginalName();
            $filename = str_slug(pathinfo($upload, PATHINFO_FILENAME));
            $fileExtension = str_slug(pathinfo($upload, PATHINFO_EXTENSION));
            $changeName = time() . '_' . $filename . '.' . $fileExtension;
            $avatar->move(Product::PATH_AVATAR, $changeName);
            $avatarPath = Product::PATH_AVATAR . $changeName;
            $product->avatar = $avatarPath;
            $product->save();
        }
        return $product;
    }

    /**
     * Delete a product.
     * @param int $id
     */
    public function delete($id)
    {
        $product = $this->find($id);
        $product->delete();
    }
    
    /**
     * Count product
     * @return number
     */
    public function count(){
        return Product::count();
    }

}
