<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function serviceIndex(){
        // $services = Service::all();
        // return view('service', ['services'=>$services]);
        return view('service');
    }

    public function getservicedata(){
        $services = json_encode(Service::all());
        return $services;
    }

    public function getServiceDatails(Request $request){
        $id = $request->input('id');
        $services = json_encode(Service::where('id', $id)->get());
        return $services;
    }

    public function serviceDelete(Request $request){
        $id = $request->input('id');
        $result = Service::where('id', $id)->delete();
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
        
    }

    public function serviceUpdate(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $img = $request->input('img');
        $result = Service::where('id', $id)->update([
            'service_name'=>$name,
            'service_desc'=>$desc,
            'service_img'=>$img
        ]);
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
    }

    public function serviceAdd(Request $request){
        $name = $request->input('name');
        $desc = $request->input('desc');
        $img = $request->input('img');
        $result = Service::insert([
            'service_name'=>$name,
            'service_desc'=>$desc,
            'service_img'=>$img
        ]);
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
    }
}
