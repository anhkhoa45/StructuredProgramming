<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const PATH_IMAGE = '/storage/products/images/';
    const PATH_IMAGE_DEFAULT = '/storage/products/default.jpg';

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
        if(file_exists(self::PATH_IMAGE.$this->image)){
            return self::PATH_IMAGE.$this->image;
        } else {
            return self::PATH_IMAGE_DEFAULT;
        }
    }
}
