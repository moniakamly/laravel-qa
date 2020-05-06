<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question; 

class FavoriteController extends Controller
{
    public function __construct() {
        // To make sure that the user is signed in to the page 
        $this->middleware('auth'); 
    }

    public function store(Question $question) {

        $question->favorites()->attach(auth()->id()); 

        return back(); 
    }


    public function destroy(Question $question) {

        $question->favorites()->detach(auth()->id()); 

        return back(); 
    }
}
