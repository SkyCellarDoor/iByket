<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;


class TestController extends Controller
{
    public function index()
    {
        $users = Test::all();

        foreach ($users as $user) {

            $name = Test::find($user->id);

            $name->name = $name->firstname . ' ' . $name->lastname;

            $name->save();

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
