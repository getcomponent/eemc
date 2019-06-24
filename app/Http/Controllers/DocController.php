<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doc;
use App\Section;

class DocController extends Controller {

	public function getDocs($sectionId) {
        if(is_null(\Auth::user())) {
            return view('error');
        }
        $user = \Auth::user();
    	$docs = Doc::all()->where('section_id', $sectionId);
        $section = Section::all()->where('id', $sectionId)->first();
        return view('docs')->with('docs', $docs)->with('section', $section)->with('user', $user);
    }

    public function theory() {
    	return $this->getDocs(1);
    }

    public function practice() {
    	return $this->getDocs(2);
    }

    public function supporting() {
    	return $this->getDocs(3);
    }
}
