<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Question;
use App\Answer;
use App\TestsResult;
use App\User;


class TestController extends Controller {

	public function index() {
		if(is_null(\Auth::user())) {
    		return view('error');
    	}

    	$tests = Test::all();
    	$user = \Auth::user();
        $tr = TestsResult::orderBy('test_id', 'desc')->where('user_id', $user->id)->first();
    	
        return view('tests')->with('tests', $tests)->with('lastPassed', $tr)->with('user', $user);
    }

    public function test($path) {
    	if(is_null(\Auth::user())) {
    		return view('error');
    	}

        $user = \Auth::user();

    	$test  = Test::all()->where('path', $path)->first();
        if(is_null($test)) {
            return view('error');
        }

    	$lastPassed  = TestsResult::orderBy('test_id', 'desc')->where('user_id', $user->id)->first();

    	if($test->id == 1 || ($lastPassed != null && ($test->id <= $lastPassed->test_id || ($test->id == $lastPassed->test_id + 1 && $lastPassed->mark >= 5)))) {
            $questions = Question::all()->where('test_id', $test->id);
            $questionIds = Question::select('id')->pluck('id');
            $answers = Answer::all()->whereIn('question_id', $questionIds);
    		return view('test')->with('questions', $questions)->with('answers', $answers)->with('test', $test)->with('user', $user);
    	} else {
    		return view('error');
    	}
    }

    public function result($path) {

        if(is_null(\Auth::user())) {
            return view('error');
        }

        $user = \Auth::user();

        $test = Test::all()->where('path', $path)->first();
        if(is_null($test)) {
            return view('error');
        }

        $questions = Question::all()->where('test_id', $test->id);
        $correct = 0;
        foreach ($questions as $q) {
            $correct += $this->isQuestionCorrect($q);
        }
        $percent = round($correct * 100 / $questions->count());
        $mark = round($percent * 9 / 100);

        $tr = TestsResult::all()->where('user_id', \Auth::user()->id)->where('test_id', $test->id)->first();

        if(!isset($tr))
            $tr = new TestsResult();
        
        $tr->user_id = \Auth::user()->id;
        $tr->test_id = $test->id;
        $tr->mark = $mark;

        $tr->save();

        return view('result')->with('percent', $percent)->with('mark', $mark)->with('user', $user);
    }

    public function isQuestionCorrect($q) {
        $answers = Answer::all()->where('question_id', $q->id);
            $corrAnswers = $answers->where('is_correct', 'y')->pluck('id');
            $wrongAnswers = $answers->where('is_correct', '!=', 'y')->pluck('id');
            foreach ($corrAnswers as $c) {
                if (!isset($_POST[$q->id . "_" . $c])) {
                    return 0;
                }
            }
            foreach ($wrongAnswers as $c) {
                if (isset($_POST[$q->id . "_" . $c])) {
                    return 0;
                }
            }
            return 1;
    }
}
