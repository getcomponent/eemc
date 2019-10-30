<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Doc;
use App\Section;
use App\TestsResult;
use App\Test;
use App\Question;
use App\Answer;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
        if(!$this->is_admin()) {
            return view('error');
        }
        $user = \Auth::user();
        return view('admin')->with('user', $user);
    }

    public function users() {
        if(!$this->is_admin()) {
            return view('error');
        }

        $users = User::all();
        $user = \Auth::user();

        return view('admin_users')->with('users', $users)->with('user', $user);
    }

    public function theory() {
        if(!$this->is_admin()) {
            return view('error');
        }

        $docs = Doc::all();
        $sections = Section::all();
        $user = \Auth::user();
        return view('admin_theory')->with('docs', $docs)->with('sections', $sections)->with('user', $user);
    }

    public function tests() {
        if(!$this->is_admin()) {
            return view('error');
        }

        $tests = Test::withCount('questions')->get();
        $user = \Auth::user();
        return view('admin_tests')->with('tests', $tests)->with('user', $user);
    }

    public function deleteUser($id) {
        if(!$this->is_admin()) {
            abort(500);
        }

        $user = User::all()->where('id', $id)->first();

        $tr = DB::table('tests_results')->where('user_id', $user->id)->delete();

        $user->delete();
        return "";
    }

    public function deleteTest($id) {
        if(!$this->is_admin()) {
            abort(500);
        }

        $test = Test::all()->where('id', $id)->first();

        $questions = DB::table('questions')->where('test_id', $test->id);
        $ids = $questions->pluck('id')->toArray();
        $answers = DB::table('answers')->whereIn('question_id', $ids)->delete();
        $questions->delete();

        $test->delete();
        return "";
    }

    public function viewTests($id) {
        if(!$this->is_admin()) {
            abort(500);
        }
        $results = TestsResult::all()->where('user_id', $id);
        return response()->json($results);
    }

    public function addUser() {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $group = $_POST['group'];
        $email = $_POST['email'];

        if(!$this->is_admin() || !$this->is_valid([$name, $password, $group, $email])) {
            abort(500);
        }

        try {
            $user = new User();
            $user->name = $name;
            $user->password = Hash::make($password);
            $user->group = $group;
            $user->email = $email;
            $user->save();
        } catch (\Throwable $e) {
            abort(500);
        }

        return "";
    }

    public function addTest() {
        if(!$this->is_admin()) {
            abort(500);
        }

        if (\Request::isMethod('get')) {
            $user = \Auth::user();
            return view('admin_add_test')->with('user', $user);

        } else if (\Request::isMethod('post')) {

            $testName = $_POST['test_name'];

            $questions = array();
            $qa = array();

            foreach ($_POST['question_text'] as $key => $q) {
                $question = new Question();
                $question->text = $q;
                $question->image = "";

                $answers = array();
                $correct = false;
                $checks = array();

                foreach ($_POST['answer_text'][$key] as $pew => $a) {
                    $answer = new Answer();
                    $answer->text = $a;
                    $answer->is_correct = $_POST['check'][$key][$pew] == 'on' ? 'y' : 'n';    

                    array_push($answers, $answer);
                }

                if (isset($question->text) && count($answers) >= 2 && $correct) {
                    array_push($questions, $question);
                    $qa[$question->text] = $answers;
                }
            }

            if (count($questions) < 2) {
                abort(500);
            }

            try {

                DB::beginTransaction();


                $test = new Test();
                $test->name = $testName;
                $test->path = $this->slugify($this->transliterate($testName));
                $test->image = "";
                $test->save();

                foreach ($questions as $question) {
                    $question->test_id = $test->id;
                    $question->save();
                    $answers = $qa[$question->text];
                    foreach ($answers as $answer) {
                        $answer->question_id = $question->id;
                        $answer->save();
                    }
                }


                DB::commit();

            } catch (\PDOException $e) {
                DB::rollBack();
                var_dump($e->getMessage());
                return;
            }

            return "OK";

        } else {
            abort(500);
        }
    }

    public function deleteDoc($id) {
        if(!$this->is_admin()) {
            abort(500);
        }

        try {
            Doc::all()->where('id', $id)->first()->delete();
        } catch (\Throwable $e) {
            abort(500);
        }

        return "";
    }

    public function changeDoc($id) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $section = $_POST['section'];

        $doc = $_FILES['doc'];
        $image = $_FILES['image'];

        $doc_name = $this->upload_file('doc');
        $image_name = $this->upload_file('image');
        
        $d = Doc::all()->where('id', $id)->first();

        if (isset($name)) {
            $d->name = $name;
        }
        if (isset($description)) {
            $d->description = $description;
        }
        if (!is_null($doc_name)) {
            $d->path = $this->transliterate($_FILES['doc']['name']);
        }
        if (!is_null($image_name)) {
            $d->image = $this->transliterate($_FILES['image']['name']);
        }
        if (isset($section)) {
            $d->section_id = $section;    
        }

        $d->save();

        return "";
    }

    public function changeUser($id) {
        $name = $_POST['name'];
        $group = $_POST['group'];
        $status = $_POST['status'];

        $u = User::all()->where('id', $id)->first();

        if (isset($name)) {
            $u->name = $name;
        }
        if (isset($group)) {
            $u->group = $group;
        }
        if (isset($status)) {
            $u->status = $status;
        }
        
        $u->save();

        return "";
    }

    public function openDoc($id) {
        if(!$this->is_admin()) {
            abort(500);
        }

        try {
            Doc::all()->where('id', $id)->first();
        } catch (\Throwable $e) {
            abort(500);
        }

        return "";
    }

    public function openUser($id) {
        if(!$this->is_admin()) {
            abort(500);
        }

        try {
            User::all()->where('id', $id)->first();
        } catch (\Throwable $e) {
            abort(500);
        }

        return "";
    }

    public function addDoc() {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $section = $_POST['section'];

        $doc = $_FILES['doc'];
        $image = $_FILES['image'];

        if(!$this->is_admin() || !$this->is_valid([$name, $section, $description, $doc, $image])) {
            abort(500);
        }

        $doc_name = $this->upload_file('doc');
        $image_name = $this->upload_file('image');

        if (!$this->is_valid([$doc_name, $image_name])) {
            abort(500);
        }
        
        $d = new Doc();
        $d->name = $name;
        $d->description = $description;
        $d->path = $doc_name;
        $d->image = $image_name;
        $d->section_id = $section;
        $d->save();

        return "";
    }

    private function upload_file($name) {
        $uploaddir = '/app/public/';
        $filename = $this->transliterate($_FILES[$name]['name']);
        $uploadfile = $uploaddir . $filename;

        if ($filename == null) {
            return null;
        }

        if (move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)) {
            return $filename;
        }

        return null;
    }

    private function is_admin() {
        $admin = \Auth::user();
        return isset($admin) && $admin->status == 'admin';
    }

    private function is_valid($arr) {
        foreach ($arr as $s) {
            if (is_null($s) || empty($s)) {
                return false;
            }
        }
        return true;
    }

    private function transliterate($textcyr) {
        $cyr = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
        ];
        $lat = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
            'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
            'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya'
        ];
        return str_replace($cyr, $lat, $textcyr);
    }

    public function slugify($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
}
}
