<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhotoTable;

class PhotoController extends Controller
{
    public function photoIndex(){
        return view('gallery');
    }

    public function PhotoJson(){
        return PhotoTable::take(4)->get();
    }

    public function PhotoJsonbyid(Request $request){
        $firstId = $request->id;
        $secondId = $firstId+3;
        return PhotoTable::where('id', '>', $firstId)->where('id', '<=', $secondId)->get();
    }

    public function uploadPhoto(Request $request){
        $photopath = $request->file('photo')->store('public');

        $photoname = (explode('/', $photopath))[1];
        $host = $_SERVER['HTTP_HOST'];
        $location = "http://".$host."/storage/".$photoname;

        $result = PhotoTable::insert(['location'=>$location]);
        return $result;
    }
}
