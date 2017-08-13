<?php

namespace App\Http\Controllers;

use App\ClientModel;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;


class TestController extends Controller
{
    public function index()
    {
        $users = User::all();

//        foreach ($users as $user) {
//
//            $name = Test::find($user->id);
//
//            $phone = $name->phone ;
//
//        }

//        foreach ($users as $user){
//
//            $usert = ClientModel::find($user->id);
//            $phone = $usert->phone;
//            $phone = str_replace('-','', $phone);
//            $phone = str_replace(')','', $phone);
//            $phone = str_replace('(','', $phone);
//            $phone = str_replace(' ','', $phone);
//            $phone = str_replace('+','', $phone);
//            $phone = mb_substr( $phone, 1);
//            $usert->phone = $phone;
//            $usert -> save();
//
//        }

        return view('test')->with(['users' => $users]);
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
