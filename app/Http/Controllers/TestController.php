<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;


class TestController extends Controller
{
    public function index(Request $request)
    {
        //dump($request);
        if (isset($_GET['name'])) {
            echo $_GET['name'];
        }
        return view('test');
    }

    public function add(Request $request)
    {
        $id = $request->id;
        $values = $request->value;

        foreach ($id as $value => $item) {
            echo $values[$value] . " - ";
            echo $item . "<br>";
        }


        dump($request);

        $data_r = $request->data;


    }
}
