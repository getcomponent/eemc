<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller {
    
	public function index() {
    	$tests = Test::all();
    	$user = \Auth::user();
    	$lastPassed = $user->last_passed;
    	
        return view('tests')->with('tests', $tests)->with('lastPassed', $lastPassed);
    }
}
