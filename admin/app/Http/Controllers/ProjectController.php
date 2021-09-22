<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function projectIndex(){
        return view('project');
    }

    public function getProjectData(){
        $result = json_encode(Project::all()) ;
        return $result;
    }

    public function getProjectDelete(Request $request){
        $id = $request->input('id');
        $result = Project::where('id', $id)->delete();
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
        
    }

    public function getProjectDelail(Request $request){
        $id = $request->input('id');
        $project = json_encode(Project::where('id', $id)->get());
        return $project;
    }

    public function getprojectUpdate(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $result = Project::where('id', $id)->update([
            'project_name'=>$name,
            'project_desc'=>$desc
        ]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }

    public function productsAdded(Request $request){
        $name = $request->input('name');
        $desc = $request->input('desc');

        $result = Project::insert([
            'project_name'=>$name,
            'project_desc'=>$desc
        ]);
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
    }
}
