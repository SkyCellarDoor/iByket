<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueController extends Controller
{
    public function index(){

    return view('vuetest');

    }
    public function storage(Request $request){

        echo json_encode(['test'=>'test!']);
        exit();

    }
}
