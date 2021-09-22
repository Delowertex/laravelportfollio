<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function courseIndex(){
        $courses = Course::orderBy('id', 'desc')->get();
        return view('course', ['courses'=>$courses]);
    }
}
