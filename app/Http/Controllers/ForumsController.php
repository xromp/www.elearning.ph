<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumsController extends Controller
{
    public function Index()
    {
    	// echo "forum index";
    	return view('forum.index');
    }
}
