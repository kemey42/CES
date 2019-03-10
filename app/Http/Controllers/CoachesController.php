<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoachesController extends Controller
{
    public function index(){
        return view('coach.main');
    }

    public function student($id, $name){
        return 'Student ID is '.$id.' and Student Name is '.$name;
    }
}
