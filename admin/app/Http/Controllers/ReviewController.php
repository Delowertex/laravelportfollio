<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function reviewIndex(){
        return view('review');
    }

    public function getReviewtData(){
        $result = json_encode(Review::all()) ;
        return $result;
    }

    public function getReviewDelete(Request $request){
        $id = $request->input('id');
        $result = Review::where('id', $id)->delete();
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
        
    }

    public function getReviewtDelail(Request $request){
        $id = $request->input('id');
        $reviews = json_encode(Review::where('id', $id)->get());
        return $reviews;
    }

    public function getReviewtUpdate(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $desc = $request->input('desc');
        $img = $request->input('img');
        $result = Review::where('id', $id)->update([
            'name'=>$name,
            'desc'=>$desc,
            'img'=>$img
        ]);
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
    }

    public function reviewsAdd(Request $request){
        $name = $request->input('name');
        $desc = $request->input('desc');
        $img = $request->input('img');
        $result = Review::insert([
            'name'=>$name,
            'desc'=>$desc,
            'img'=>$img,
        ]);
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
    }
}
