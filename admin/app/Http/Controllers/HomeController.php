<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Project;
use App\Models\Review;
use App\Models\Service;
use App\Models\Visitor;


class HomeController extends Controller
{
    public function homeIndex(){
        $contact = Contact::count();
        $course = Course::count();
        $project = Project::count();
        $review = Review::count();
        $service = Service::count();
        $visitor = Visitor::count();
        return view('home', ['contact'=>$contact, 'course'=>$course, 'project'=>$project, 'review'=>$review, 'service'=>$service, 'visitor'=>$visitor]);
    }
}
