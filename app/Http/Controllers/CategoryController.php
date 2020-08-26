<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Category;
use Validator;


class CategoryController extends BaseController
{
    /*
		7.List all categories 
	*/
	public function listCategory(){
		$category = Category::all();
		return $this->showResponse($category,200);
	}

	/*
		8.Delete,Add and Update method for Category
	*/
	public function createCategory(Request $request){
		$input_fields = $request->all();
		
		$validator = Validator::make($input_fields, [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return $this->errorResponse('Validation Error.', $validator->errors());
        }
        try{
        	$product = Category::create($input_fields);
        	return $this->showResponse($product->id,200);
        }
        catch (QueryException $e){
		    $errorCode = $e->errorInfo[1];
		    if($errorCode == 1062){
		    	return $this->errorResponse('duplicate_error',['duplicate_error']);
		    }
		}

	}
 
}
