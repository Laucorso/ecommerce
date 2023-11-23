<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    //
    public function mountBill(){
        $x = 60;
        return view('bill');
    }
}
