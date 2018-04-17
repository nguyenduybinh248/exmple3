<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //
	public function index(){
		return view('file');
	}
	public function doUpload(Request $request){

		$file = $request->image;
		$file->move('img',$file->getClientOriginalName());
		$path = 'img/' . $file->getClientOriginalName();


		//hàm sẽ trả về đường dẫn mới của file trên server
	}
}
