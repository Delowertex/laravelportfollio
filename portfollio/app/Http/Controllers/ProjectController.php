<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function projectIndex(){
        $projects = Project::orderBy('id', 'desc')->get();
        return view('project', ['projects'=>$projects]);
    }
}
