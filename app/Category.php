<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Product;
class Category extends Model
{
	protected $table = 'category';
  public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'parent_id'
    ];

   	public function product(){
   		return $this->belongsToMany(Product::class,'category_product',
   			    'category_id',
            'product_id');
   	}
}
