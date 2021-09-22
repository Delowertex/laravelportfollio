<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    public function ServiceIndex(){
        return view('others');
    }

    public function getServiceData(){
        $result =  json_encode(Service::all());
        return $result;
    }


    public function getserviceDelete(Request $request){
        $id = $request->input('id');
        $result = Service::where('id', $id)->delete();
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }

    public function getServiceDetails(Request $request){
        $id = $request->input('id');
        $result =  json_encode(Service::where('id', $id)->get());
        return $result;
    }

    public function getserviceUpdate(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $img = $request->input('img');
        $result = Service::where('id', $id)->update([
            'service_name'=> $name,
            'service_desc'=> $desc,
            'service_img'=> $img
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }


    public function getserviceAdded(Request $request){
        $name = $request->input('name');
        $desc = $request->input('desc');
        $img = $request->input('img');
        $result = Service::insert([
            'service_name'=> $name,
            'service_desc'=> $desc,
            'service_img'=> $img
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
