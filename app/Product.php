<?php

namespace App;

use App\Storage\LaravelImpl\ProductImageStorage;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image', 'price', 'size', 'quantity'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'product_category');
    }

    public function getImageUrl(){
        $prodImgStorage = new ProductImageStorage;
        return $prodImgStorage->getProductPublicImage($this);
    }
}
