<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'product_left',
        'external_id',
        'created_at'
    ];

    /*
        merging tables category and product
    */
    public function category(){
        return $this->belongsToMany(Category::class,'category_product','product_id',
            'category_id');
    }
}
