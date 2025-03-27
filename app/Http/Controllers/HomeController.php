<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Crypt;
use App\User;
use App\Campus;
use App\Questions;
use App\Sections;
use App\Option;
use App\Answers;
use Validator;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Home';
        return view('home', $data);
    }

    public function newTest(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->forget('user_name');
        return redirect('/');
    }

    public function starttest()
    {
        $data['title'] = 'quiz';
        return view('aptitude_test.aptitudetest', $data);
    }

    public function entertest(Request $request)
    {

        if ($request->session()->has('user_id') && session('user_id') != 'admin') {
            $campus_id = session('campus_id');
            $password = $request->input('test_password');
            $campus = DB::table('campus_details')->select('campus_id')->where('password', '=', $password)->get();
            $campus_id =  $campus[0]->campus_id;
            $campus_id_exists = base64_encode($campus_id);
            $data['title'] = "Old User Test";
            $data['campus_id'] = $campus_id_exists;
            return view('aptitude_test.olduser', $data);
        }

        $rules = array('password' => 'required');
        Validator::make($request->all(), $rules);
        $password = $request->input('test_password');
        $campus = DB::table('campus_details')->select('campus_id')->where('password', '=', $password)->get();
        if (empty($campus)) {
            return redirect('/')->withErrors('Please Enter Correct Password')->withInput();
        } else {
            $test = $campus[0]->campus_id;
            return redirect('test/' . base64_encode($test));
        }
    }

    public function testInfo($id)
    {
        $campid = base64_decode($id);
        $campus = new Campus;
        $campus_id = $campus->campus_id;
        $campus = Campus::find($campid);
        $data = array();
        $data['title'] = 'Test Details';
        $data['sections'] = DB::table('sections')->get();

        return view('aptitude_test.testinfo' . $campus_id, compact('campus'), $data);
    }

    public function testInstructions(Request $request, $id)
    {
        $campid = base64_decode($id);
        $campus = new Campus;
        $campus_id = $campus->campus_id;
        $campus = Campus::find($campid);
        $data['College'] = $campus->College->college_name;
        if ($campus) {
            $campusdate = strtotime($campus->campus_date);
            $today = strtotime(date("Y-m-d"));
            if ($campusdate == $today) {
                $data = array();
                $data['title'] = 'General instructions';
                $data['College'] = $campus->College->college_name;
                return view('aptitude_test.general_instructions' . $campus_id, compact('campus'), $data);
            } elseif ($campusdate > $today) {
                $error = "Campus Yet to be started";
                $data['title'] = 'For your Information';
                return view('aptitude_test.dateerror', compact('error'), $data);
            } elseif ($campusdate < $today) {
                $error = "The link has expired or is no longer available.";
                $data['title'] = 'For your Information';
                return view('aptitude_test.dateerror', compact('error'), $data);
            } else {
                $error = "Invalid Url";
                $data['title'] = 'Invalid Url';
                return view('aptitude_test.dateerror', compact('error'), $data);
            }
        } else {
            $error = "Invalid Url";
            $data['title'] = 'Invalid Url';
            return view('aptitude_test.dateerror', compact('error'), $data);
        }
    }

    public function userDetailsForm($id)
    {
        $campid = base64_decode($id);
        $campus = new Campus;
        $campus_id = $campus->campus_id;
        $campus = Campus::find($campid);
        $data['College'] = $campus->College->college_name;
        if (session()->has('user_id')  && session('user_id') == 'admin') {
            return redirect('/apt-form/' . base64_encode($campus->campus_id));
        }
        $data['title'] = 'Fill Details';
        return view('aptitude_test.userdetails_form' . $campus_id, compact('campus'), $data);
    }

    public function storeUserDetails(Request $request, $id)
    {
        $campid = base64_decode($id);
        $campus = new Campus;
        $campus_id = $campus->campus_id;
        $campus = Campus::find($campid);
        session(['campus_id' => $campid]);

        $user_verify = DB::table('users')
                ->select('id', 'name', 'campus_id')
                ->where('campus_id', $campid)
                ->where('registration_number', $request->input('registration_number'))
                ->get();

        if($user_verify){
            foreach($user_verify as $user_value){
                $user_details = $user_value;   
            }
            $test_attended = DB::table('test_completion_details')
                                ->where('user_id',$user_details->id)
                                ->exists();
            if($test_attended){
                return redirect('/user-details/' . base64_encode($campus->campus_id))->withErrors('You Have Already Attended the Test!')->withInput();
            }              
            session(['user_id' => $user_details->id, 'user_name' => $user_details->name]);
            return redirect('/apt-form/' . base64_encode($user_details->campus_id));
        }else{ 
            $user_find = DB::table('users')
                ->where('campus_id', $campid)
                ->where('registration_number', $request->input('registration_number'))
                ->exists();
            if ($user_find) {
                return redirect('/user-details/' . base64_encode($campus->campus_id))->withErrors('Register number already taken!')->withInput();
            }

            $data['College'] = $campus->College->college_name;

            $sections = DB::table('sections As S')->select('S.id', 'S.section_name')->join('questions As Q', 'Q.section_id', '=', 'S.id')->groupBy('S.id')->get();
            foreach ($sections as $section) {
                $levels[$section->id] = DB::table('questions As Q')
                    ->select('Q.level_id', 'L.level', DB::raw('count(Q.question_id) as max_count'))
                    ->join('questions_level As L', 'L.id', '=', 'Q.level_id')
                    ->where('section_id', $section->id)
                    ->groupBy('level_id')
                    ->get();
            }

            $questions = unserialize($campus->questions);
            if (isset($questions[4]) && is_array($questions[4]) && count($questions[4]) == 3) {
                foreach ($sections as $section) {
                    foreach ($levels[$section->id] as $level) {
                        $question[] = Questions::where('level_id', $level->level_id)->select('question_number')->where('section_id', $section->id)->orderBy(DB::raw('RAND()'))->take($questions[$section->id][$level->level_id])->get();
                    }
                }

                foreach ($question as $ques) {
                    foreach ($ques as $key => $value) {
                        $order[] = ($value->question_number);
                    }
                }
                $data_ques = Questions::select('*')->whereIn('question_number', array_unique($order))->get();
            } else {
                $question_number = DB::table('questions')
                    ->select('question_number')
                    ->whereIn('question_id', $questions)
                    ->get();

                foreach ($question_number as $num) {
                    $number[] = $num->question_number;
                    $data_ques = Questions::select('*')->whereIn('question_number', $number)->get();
                }
            }

            $rules = array('name' => 'required', 'email' => 'required|email', 'registration_number' => 'required');
            $messages = array(
                'name.required' => 'The Name field is required', 
                'email.required' => 'The Email field is required', 
                'email.email' => 'The Email must be a valid email address', 
                'registration_number.required' => 'The Reg No field is required', 
                // 'registration_number.numeric' => 'The Reg No should be a number'

            );
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect('/user-details/' . base64_encode($campus->campus_id))->withErrors($validator)->withInput();
            }

            $user = User::select('email')->where('campus_id', $request->input('campus_id'))->get();
            foreach ($user as $use) {
                $mail[] = $use->email;
            }
            $candidates = unserialize($campus->candidates);
            if (empty($mail) || !in_array($request->input('email'), $mail)) {
                if (in_array($request->input('registration_number'), $candidates)) {
                    $user = new User;
                    $user->campus_id = $request->input('campus_id');
                    $user->name = $request->input('name');
                    $user->email = $request->input('email');
                    $user->registration_number = $request->input('registration_number');
                    $user->save();
                    session(['user_id' => $user->id, 'user_name' => $user->name]);

                    $uid = session('user_id');

                    foreach ($data_ques as $question_values) {
                        //                    print_r($question_values->question_id);
                        $id = $question_values->question_id;
                        $data = array('user_id' => $uid, 'question_id' => $id);
                        $test = DB::table('user_answers')->insert($data);
                    }
                    return redirect('/apt-form/' . base64_encode($user->campus_id));
                } else {
                    return redirect('/user-details/' . base64_encode($campus->campus_id))->withErrors('Enter correct register number')->withInput();
                }
            } else {
                //echo 'Already email entered!';
                return redirect('/user-details/' . base64_encode($campus->campus_id))->withErrors('Already email entered!')->withInput();
                // exit;
            }
        }
    }

    public function aptitudeForm(Request $request, $id)
    {
        $campus_id = base64_decode($id);
        $campus = Campus::find($campus_id);
        $data['College'] = $campus->College->college_name;
        $sections = DB::table('sections As S')->select('S.id', 'S.section_name')->join('questions As Q', 'Q.section_id', '=', 'S.id')->groupBy('S.id')->get();
        $levelid = $campus->question_level_id;
        $count = $campus->question_count;

        if ($request->session()->has('user_id')) {
            $user = User::where('id', '=', session('user_id'))->exists();
            if (!$user) {
                return redirect('/test/' . base64_encode($campus->campus_id));
            }
            //echo "<pre>";
            $data = array();
            $uid = session('user_id');

            foreach ($sections as $key => $value) {
                $testquestions[$value->id] = DB::table('questions As Q')
                    ->select('Q.question_id', 'Q.question_name', 'Q.question_info', 'Q.question_number', 'S.id As section_id', 'S.section_name')
                    ->distinct()
                    ->join('user_answers As UA', 'Q.question_id', '=', 'UA.question_id')
                    ->join('sections As S', 'Q.section_id', '=', 'S.id')
                    ->where('UA.user_id', $uid)
                    ->where('Q.section_id', $value->id)
                    ->orderBy(DB::raw('RAND(Q.question_number)'))
                    ->get();
            }
            $ji = 0;
            $questions = array();

            foreach ($testquestions as $key => $tq) {
                foreach ($tq as $q) {
                    $q_data = $q;
                    $q_data->options = DB::table('question_options')->where('question_id', $q->question_id)->get();
                    $questions[$key][$q->question_number][] = $q_data;
                    $ji++;
                }
            }

            $campus_time = ($campus->campus_time != '') ? explode("_", $campus->campus_time) : '';
            $campus['time'] = $campus_time[1];
            if ($campus['time'] == 'Minutes') {
                $campus['min_val'] = $campus_time[0] * 60;
            } elseif ($campus['time'] == 'Hour') {
                floor($campus_time[0] / 3600);
                $campus['min_val'] = $campus_time[0] * 3600;
            }
            $data['title'] = 'Quiz Form';
            $data['questions'] = $questions;
            $data['College'] = $campus->College->college_name;
            return view('aptitude_test.aptitude_form', compact( 'campus', 'sections', 'ji'), $data);
        } else {
            return redirect('/test/' . base64_encode($campus->campus_id));
        }
    }

    public function saveUserAnswers(Request $request, $id)
    {
        $campus_id = base64_decode($id);
        $campus = Campus::find($campus_id);
        $levelid = unserialize($campus->question_level_id);
        $pass_percentage = $campus->pass_percentage;
        $uid = session('user_id');
        $questions = Questions::all();

        foreach ($questions as $question_section) {
            $sections[] = $question_section->Section->id;
        }
        $sections = array_unique($sections);
        $user_id = session('user_id');
        if (empty($user_id)) {
            return redirect('/test/' . $id);
        }

        /**If the user resubmits the form after completing the test redirect him to already submitted page */
        $user_check = DB::table('test_completion_details')->where('user_id', $user_id)->exists();
        if ($user_check) {
            return redirect('/already-submitted');
        }

        $answers = array();
        $i = 1;
        foreach ($request->except('_token') as $question_id => $select_option_id) {
            $answers[$i]['user_id'] = session('user_id');
            $answers[$i]['question_id'] = $question_id;
            $answers[$i]['selected_option_id'] = $select_option_id;
            $i++;
        }

        foreach ($answers as $answer) {
            $update = DB::table('user_answers')->where('user_id', $answer['user_id'])->where('question_id', $answer['question_id'])->update(array('selected_option_id' => $answer['selected_option_id']));
        }

        $total_questions = DB::table('user_answers As U')->select(DB::raw("count(U.question_id) as no_of_questions"))->join("questions As Q", "U.question_id", "=", "Q.question_id") // ->where('Q.level_id',$value)
            ->where('U.user_id', $uid)->groupBy('Q.section_id')->get();


        $data['results'] = DB::table('sections As S')->select('S.section_name', DB::raw("count(UA.question_id) as correct_answers"), DB::raw("sum(Q.marks) as sum_of_marks"))->leftjoin('questions As Q', 'Q.section_id', '=', 'S.id')->leftjoin('user_answers As UA', 'UA.selected_option_id', '=', 'Q.right_option_id')->where('UA.user_id', $user_id)->groupBy('Q.section_id')->get();

        $section_arr = array();
        foreach ($data['results'] as $dataKey => $dataVal) {
            $section_arr[$dataVal->section_name] = number_format(($dataVal->correct_answers / $total_questions[$dataKey]->no_of_questions) * 100, 2);
            //echo $dataKey.'---'.'---'.$dataVal->section_name;
            //  $count++;
        }
        $a = 0;

        // Array to get sections
        foreach ($sections as $section) {
            $sections_names[] = Sections::find($section);
            // $section_name[] =$section_name->section_name;
        }
        foreach ($sections_names as $section_names) {
            $section_name[] = $section_names->section_name;
        }

        // To change all array values into Zero
        $section_name = (array_flip($section_name));
        foreach ($section_name as $key => &$value) {
            $value = 0;
        }

        // Array got from the results
        foreach ($section_arr as $key => $value) {
            $a += $section_arr[$key];
        }
        foreach ($section_name as $key => $value) {
            foreach ($section_arr as $skey => $svalue) {
                if ($key == $skey) {
                    $value == $svalue;
                }
            }
        }

        // Merging two arrays to get result
        $result_array = array_replace($section_name, $section_arr);

        // to get sections from questions table
        foreach ($questions as $question) {
            $section_count[] = $question->Section->id;
        }

        $section_count = array_unique($section_count);
        $section_count = count($section_count) * 100;
        $is_test_completed = 'Yes';
        $test_completed_date = date('Y-m-d H:i:s');
        $total_per = number_format((($a) / $section_count) * 100, 2);
        // echo $total_per;
        // exit;
        $common_ques_data = (is_array($result_array) && count($result_array) > 0) ? serialize($result_array) : serialize($section_name);


        // Result Calculation
        if ($total_per >= $pass_percentage) {
            $result = 1;
        } else {
            $result = 0;
        }

        $detail_arr = array('user_id' => $user_id, 'is_test_completed' => $is_test_completed, 'test_completed_date' => $test_completed_date, 'common_ques_data' => $common_ques_data, 'total_per' => $total_per, 'result' => $result);
        // echo '<pre>';print_r($detail_arr);
        // exit;
        $request->session()->forget('user_id');
        $request->session()->forget('user_name');
        DB::table('test_completion_details')->insert($detail_arr);
        return redirect('/results/' . base64_encode($campus->campus_id));
    }

    public function results(Request $request, $id)
    {
        $campus_id = base64_decode($id);
        $campus = Campus::find($campus_id);
        $levelid = $campus->question_level_id;

        // if ($request->session()->has('user_id') && session('user_name') != 'admin') {
        //     $user_id = session('user_id');
        //     $test_completion_check = DB::table('test_completion_details')->where('user_id', $user_id)->exists();
        //     /** If the user logged in and not completed  the test then redirect to form */
        //     if (!$test_completion_check) {
        //         return redirect('/apt-form/' . base64_encode($campus->campus_id));
        //     }

        // $data = array();
        $data['title'] = 'Test Completed';
        // $data['College'] = $campus->College->college_name;
        return view('aptitude_test.results', $data);
        // } else {
        // return redirect('/');
        // }
    }

    public function alreadySubmitted()
    {
        if (session('user_id')) {
            $data['title'] = "Already Test Attended";
            return view('aptitude_test.already_submitted', $data);
        }
        return redirect('/');
    }

    public function logout(Request $request)
    {
        if (session('user_name') == 'admin') {
            $redirect_path = '/admin';
            $request->session()->forget('user_id');
            $request->session()->forget('user_name');
            return redirect($redirect_path);
        } else {
            $data['title'] = "logout";
            // $redirect_path = '/';
            //echo"<div class='alert alert-success'>logged out successfully</div>";
            $request->session()->forget('user_id');
            $request->session()->forget('user_name'); ?>
            <script>
                localStorage.removeItem('elasped_time');
            </script>?>
<?php
            return view('aptitude_test.logout', $data);
        }
    }
}
