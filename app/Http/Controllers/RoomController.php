<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Http\Controllers\BaseController as BaseController;


class RoomController extends BaseController
{
	/*
		1.Pagination list 
	*/
	public function list()
	{
		$room=Room::with('product')->get();
		return $this->showResponse($room,200);
	}

}
