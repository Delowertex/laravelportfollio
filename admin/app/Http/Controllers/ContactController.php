<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contactIndex(){
        return view('contact');
    }

    public function getContactData(){
        $result = json_encode(Contact::all()) ;
        return $result;
    }

    public function getContactDelete(Request $request){
        $id = $request->input('id');
        $result = Contact::where('id', $id)->delete();
        if($result==true){
            return 1;
        }else {
            return 0; 
        }
        
    }
}
