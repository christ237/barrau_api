<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function getArticles(){
        $data = Post::all();
        
        return view('index')->with([
         'users' => $data
        ]);
    }
}
