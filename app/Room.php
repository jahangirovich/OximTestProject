<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Product;
class Room extends Model
{
	protected $table = 'rooms';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'created_at',
        'place'
    ];

    public function product(){
        return $this->belongsToMany(Product::class,'product_room','room_id',
            'product_id');
    }
}
