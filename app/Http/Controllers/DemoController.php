<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index(){
        return view('demoindex');
    }

    public function index2(){
        $data='ABC';
        return view ('demoindex2',compact('data'));
    }

    public function index3(){
        return response ()->json([
            'status'=>true,
            'data'=>[
                'name'=> 'San pham 1',
                'price'=> 500000,
            ]

        ]);
    }


    public function index4($id){
        $data='ABC';
        return view('demoindex4',compact('data','id'));


    }
    public function index5($id = null){
        $data= 'Du lieu dua vao';
        return view('demoindex5',compact('data','id'));

    }
    public function index6($id = null){
        $data= 'INDEX6';
        dump($id);
        return view('demoindex6',compact('data','id'));
    }




    
}
