<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class HomeController extends Controller
{

    public function index()
    {
        $letter=array(
       countLetter('استعلام'),
           countLetter('پیشنهاد'),
           countLetter('صادره'),
           countLetter('وارده'),
        );


        return view('dashboard.home',compact('letter'));
        }

}
