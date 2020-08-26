<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Database\QueryException;
use PDOException;
use App\Http\Controllers\BaseController as BaseController;
use Validator;


class ProductController extends BaseController
{
	/*
		1.Pagination list 
	*/
	public function listPaginate()
	{
		$product=Product::with('Category')->paginate(50);
		return $this->showResponse($product,200);
	}

	/*
		2.Sort the products by prices and date
	*/
	public function sortProduct($order,$val){
		// Check order valid or does not
		if ($order != 'asc' and $order != 'desc'){
			return $this->errorResponse("order must be ASC or DESC",["query_error"],404); 
		}
		// try and catch for query exception which occurs when doesn't exist
		try {
			$sorted_products = Product::with('category')->orderBy($val,$order)->get();
			return $this->showResponse($sorted_products,200);
		} 
		catch (QueryException $e) 
		{
		   return $this->errorResponse("query error",["query_error"],404);
		} 
		catch (PDOException $e) {
		   return $this->errorResponse("pdo_error",["pdo_error"],404);
		} 
	}

	/*
		3.Get product by external ID
	*/
	public function getProductById($id){
		$sorted_products = Product::with('category')->where('id',$id)->get();
		// check size of array to send message item not found
		if (sizeof($sorted_products) == 0){
			return $this->errorResponse('Item not found',['ItemNotFound'],502);
		}
		return $this->showResponse($sorted_products,200);
	}
	/*
		4.Get product by Category_extenal_ID
	*/	
	public function getProductByCategoryID($id){
		$sorted_products = Category::with('product')->where('id',$id)->get();
		return $this->showResponse($sorted_products,200);
	}
	/*
		5.Create method for create product and return it's id and code of request
	*/
	public function createProduct(Request $request){
		$input_fields = $request->all();

		$validator = Validator::make($input_fields, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'product_left' => 'required',
            'created_at' => 'required'
        ]);
        if($validator->fails()){
            return $this->errorResponse('Validation Error.', $validator->errors());
        }
        try{
        	$product = Product::create($input_fields);
        	return $this->showResponse($product->id,200);
        }
        catch (QueryException $e){
		    $errorCode = $e->errorInfo[1];
		    if($errorCode == 1062){
		    	return $this->errorResponse('duplicate_error',['duplicate_error']);
		    }
		}

	}
	/*
		6.Delete method exactly product 
	*/
	public function deleteProduct($id){
		$product=Product::find($id);
		// $product->delete();
		if (empty($product)){
			return $this->errorResponse('id doesnt exist',[],404);
		}
		$product->delete();
		return $this->showResponse('deeleted',200);
	}
}
