<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class BlogController extends Controller {

    public function index(){
        $blogs = Blog::All();
        return view('blog.index', ['blogs' => $blogs]);
    }
}
