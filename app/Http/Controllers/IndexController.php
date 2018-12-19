<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $number = 0;

    public function __construct(Request $request){
    }
    public function index(){
    	 return view('index');
    }

    public function extractData(Request $request){
		if($request->isMethod('post')){
			$index = request('index');
            $second_index = $index + 1;
            $third_index = $second_index + 1;
            $fourth_index = $third_index + 1;
            $fifth_index = $fourth_index + 1;

            //$dataArr = explode("\n", file_get_contents('C:\Users\user\python\result.txt'));
            $dataArr = explode("\n", file_get_contents(storage_path('app/result.txt')));  
		 }

		  echo json_encode(array('0'=>json_encode($dataArr[$index]),'1'=>json_encode($dataArr[$second_index]), '2'=>json_encode($dataArr[$third_index]), '3'=>json_encode($dataArr[$fourth_index]), '4'=>json_encode($dataArr[$fifth_index]) ));
         

    }

}
