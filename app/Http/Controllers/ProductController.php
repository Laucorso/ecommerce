<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function show($id = null){
        if(!$id){
            return view('products');
        }else{
            return view('products')->with('id', $id);
        }
    }
}
