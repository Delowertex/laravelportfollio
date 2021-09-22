<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Service;
use App\Models\Course;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Review;


class HomeController extends Controller{
    public function homeIndex(){
        $userIp = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate = date("y-m-d h:i:sa");
        Visitor::insert(['ip_address'=>$userIp, 'visit_time'=>$timeDate]);
        $services = Service::all();
        $courses = Course::orderBy('id', 'desc')->limit(6)->get();
        $projects = Project::orderBy('id', 'desc')->limit(6)->get();
        $reviews = Review::all();

        return view('home', ['services'=>$services, 'courses'=>$courses, 'projects'=>$projects, 'reviews'=>$reviews], );
    }

    public function contactSend(Request $request){
        $name = $request->input('name');
        $mobile = $request->input('mobile');
        $email = $request->input('email');
        $msg = $request->input('msg');
        $result = Contact::insert([
            'contact_name'=>$name,
            'contact_mobile'=>$mobile,
            'contact_email'=>$email,
            'contact_msg'=>$msg
        ]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }

}
