<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function courseIndex(){
        return view('course');
    }

    public function getCourseData(){
        $courses = json_encode(Course::orderBy('id', 'desc')->get());
        return $courses;
    }

    public function getCourseDatails(Request $request){
        $id = $request->input('id');
        $courses = json_encode(Course::where('id', $id)->get());
        return $courses;
    }

    public function courseDelete(Request $request){
        $id = $request->input('id');
        $result = Course::where('id', $id)->delete();
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
    }

    public function courseUpdate(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $fee = $request->input('fee');
        $enroll = $request->input('enroll');
        $tclass = $request->input('cclass');
        $clink = $request->input('link');
        $img = $request->input('img');
        $result = Course::where('id', $id)->update([
            'course_name'=>$name,
            'course_des'=>$desc,
            'course_fee'=>$fee,
            'course_totalenroll'=>$enroll,
            'course_totalclass'=>$tclass,
            'course_link'=>$clink,
            'course_img'=>$img,
        ]);
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
    }

    public function courseAdd(Request $request){
        $name = $request->input('name');
        $desc = $request->input('desc');
        $fee = $request->input('fee');
        $enroll = $request->input('enroll');
        $tclass = $request->input('tclass');
        $clink = $request->input('clink');
        $img = $request->input('img');
        $result = Course::insert([
            'course_name'=>$name,
            'course_des'=>$desc,
            'course_fee'=>$fee,
            'course_totalenroll'=>$enroll,
            'course_totalclass'=>$tclass,
            'course_link'=>$clink,
            'course_img'=>$img,
        ]);
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
    }
}
