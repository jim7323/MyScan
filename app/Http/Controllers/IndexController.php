<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct(Request $request){
    }
    public function index(){
    	 return view('index');
    }

    public function extractData(Request $request){
		if($request->isMethod('post')){
			$index = request('index');
            
            $dataArr = explode("\n", file_get_contents('C:\Users\user\python\result.txt'));  
		 }

		  echo json_encode(array('dataArr'=>json_encode($dataArr[$index])));
         

    }

}
