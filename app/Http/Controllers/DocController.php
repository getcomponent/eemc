<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doc;

class DocController extends Controller
{
    public function piy()
    {
    	$docs = Doc::all();
        return view('piy')->with('docs', $docs);
    }

	
}
