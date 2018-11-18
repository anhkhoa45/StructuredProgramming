<?php
/**
 * Created by PhpStorm.
 * User: anhkhoa45
 * Date: 18/11/2018
 * Time: 14:27
 */

namespace App\Services\Implementation;


use App\Product;
use App\Services\ProductServiceInterface;
use App\Storage\ProductImageStorageInterface;
use League\Flysystem\FileExistsException;
use Illuminate\Http\Request;

class ProductService implements ProductServiceInterface
{
    protected $productRepository;
    protected $productImageStorage;

    function __construct(ProductImageStorageInterface $imageStorage)
    {
        $this->productImageStorage = $imageStorage;
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

    function index(Request $request) {
        if($request->has('categories')){
            $query = Product::whereHas(
                'categories',
                function ($query) use ($request) {
                    $query->whereIn('categories.id', $request->query('categories'));
                }
            )
                ->with('categories');
        } else {
            $query = Product::with('categories');
        }


        if($request->has('name')){
            $query = $query->where('products.name', 'LIKE', '%'.$request->query('name').'%');
        }

        if($request->has('size')){
            $query = $query->whereIn('products.size', $request->query('size'));
        }

        if($request->has('gender')){
            $query = $query->whereIn('products.gender', $request->query('gender'));
        }

        if($request->filled('price_min')){
            $query = $query->where('products.price', '>=', $request->query('price_min'));
        }

        if($request->filled('price_max')){
            $query = $query->where('products.price', '<=', $request->query('price_max'));
        }

        $products = $query->paginate(6);

        return $products;
    }

    /**
     * @param $request
     * @return mixed
     */
    function store(Request $request)
    {
        if($request->has('image')){
            try{
                $image = $this->productImageStorage->store($request->file('image'));
            } catch (FileExistsException $e) {
                throw $e;
            }
        } else {
            $image = '';
        }

        $product = Product::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'size' => $request->get('size'),
            'quantity' => $request->get('quantity'),
            'image' => $image
        ]);
        return $product;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($request->has('image')){
            $image = $this->productImageStorage->replace($product->image, $request->file('image'));
        } else {
            $image = $product->image;
        }

        $product = Product::update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'size' => $request->get('size'),
            'quantity' => $request->get('quantity'),
            'image' => $image
        ]);

        return $product;
    }

    /**
     * @param $request
     * @return mixed
     */
    function checkQuantity(Request $request)
    {
        $prodIds = $request->get('product_ids');
        $products = Product::select(['id', 'quantity'])->whereIn('id', $prodIds)->get()->toArray();

        return $products;
    }

    /**
     * @param $id
     * @return mixed
     */
    function delete($id)
    {
        $product = Product::find($id);
        if(!is_null($product))
            $product->delete();
    }

    function find($id)
    {
        return Product::find($id);
    }
}
