<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TramsController extends Controller
{
    public function termsIndex(){
        return view('terms');
    }
}
