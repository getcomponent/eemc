<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doc;

class DocController extends Controller {

	public function getDocs($sectionId) {
    	$docs = Doc::all()->where('section_id', $sectionId);
        return view('docs')->with('docs', $docs);
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
