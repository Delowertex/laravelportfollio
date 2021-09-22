<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function visitIndex(){

        // $visitors = Visitor::orderby('id', 'DESC')->take(5)->get();
        $visitors = Visitor::orderby('id', 'DESC')->get();
        //$visitors = Visitor::all();
        return view('visitor', ['visitors'=>$visitors]);
    }
}
