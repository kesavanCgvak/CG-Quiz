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
        return view('home',$data);
    }

    public function testInfo($id)
    {   
        $campid = base64_decode($id);   
        $campus = new Campus;
        $campus_id = $campus->campus_id;
        $campus = Campus::find($campid);
        $data = array();
        $data['title'] = 'Test Details';
        $data['sections']= DB::table('sections')->get();
       
        return view('aptitude_test.testinfo'.$campus_id,compact('campus'), $data);
    }

    public function testInstructions(Request $request,$id)
    {
        $campid = base64_decode($id);  
        $campus = new Campus;
        $campus_id = $campus->campus_id;
        $campus = Campus::find($campid);
        if($campus) {
            $campusdate = strtotime($campus->campus_date);
            $today = strtotime(date("Y-m-d"));
            if($campusdate == $today) {
                $data = array();
                $data['title'] = 'General instructions';  
                return view('aptitude_test.general_instructions'.$campus_id,compact('campus'), $data);  
            } elseif($campusdate > $today) {
                $error = "Campus Yet to be started";
                $data['title'] = 'For your Information';
                return view('aptitude_test.dateerror',compact('error'), $data);
            } elseif($campusdate < $today) {
                $error = "Campus Expired";
                $data['title'] = 'For your Information';
                return view('aptitude_test.dateerror',compact('error'), $data);
            } else {
                $error = "Invalid Url";
                $data['title'] = 'Invalid Url';
                return view('aptitude_test.dateerror',compact('error'), $data);
            }
        } else {
            $error = "Invalid Url";
            $data['title'] = 'Invalid Url';
            return view('aptitude_test.dateerror',compact('error'), $data);
        }
    }

    public function userDetailsForm($id) 
    {

        $campid = base64_decode($id);  
        $campus = new Campus;
        $campus_id = $campus->campus_id;
        $campus = Campus::find($campid);

        if(session()->has('user_id')){
            return redirect('/apt-form/'.base64_encode($campus->campus_id));
        }
        $data['title'] = 'Fill Details';  
        return view('aptitude_test.userdetails_form'.$campus_id,compact('campus'),$data);
    }

    public function storeUserDetails(Request $request,$id)     
    {
        $campid = base64_decode($id);  
        $campus = new Campus;
        $campus_id = $campus->campus_id;
        $campus = Campus::find($campid);
        $sections =  Sections::all();
        $levelid = unserialize($campus->question_level_id);
        $sectioncount = $sections->count();
        // echo $sectionid;
        // exit;
        // print_r($levelid);
        // exit;
        // $levelcount = var_dump(count($levelid));
        $levelcount = count(array_keys($levelid));
       // echo $levelcount;
       // exit;
        $count = $campus->question_count;
        $questioncount = floor($count/$sectioncount);
        $qcount = floor($questioncount/$levelcount);
        $remsection = $count%$sectioncount;
        $remlevel = $count%$levelcount;
        // $questioncount = $questioncount+$remainder;
        // echo $questioncount;
        // echo $qcount;
        // echo "<pre>";
        // print_r(count($questions));
        // echo count(array_keys($questions));
        // exit;

        $rules=array(
            'name' => 'required',
            'email' => 'required|email',
            'registration_number' => 'required|numeric'
        );
        $messages = array(
            'name.required' => 'The Name field is required',
            'email.required' => 'The Email field is required',
            'email.email' => 'The Email must be a valid email address',
            'registration_number.required' => 'The Reg No field is required',
            'registration_number.numeric' => 'The Reg No should be a number'
            
        );
        $validator = Validator::make($request->all(),$rules, $messages);

        if ($validator->fails()) {
        return redirect('/user-details/'.base64_encode($campus->campus_id))
                    ->withErrors($validator)
                    ->withInput();
        }

        $user = User::select('email')->where('campus_id',$request->input('campus_id'))
                ->get();
                foreach($user as $use){
                    $mail[] = $use->email;
                }
                // echo "<pre>";
                // print_r($user);
                // print_r($mail)
                // exit;
        
        if( empty($mail) || !in_array($request->input('email'),$mail)  ){
        
        $user = new User;
        $user->campus_id =  $request->input('campus_id');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->registration_number = $request->input('registration_number');
        $user->save();
        session(['user_id' => $user->id, 'user_name'=> $user->name]);
        // $questions = Questions::where('level_id',$levelid)->orderBy(DB::raw('RAND()'))->take($count)->get();
        $j = 0;
        foreach ($sections as $section) {
            
            if($j == count($sections)-1){
                $i = 0;
                foreach ($levelid as $level) {
                    if($i == count($levelid) - 1){
                    $questions[] = Questions::where('level_id',$level)
                                    ->where('section_id',$section->id)
                                    ->orderBy(DB::raw('RAND()'))
                                    ->take($qcount+$remsection)
                                    ->get();
                    }
                    else{
                    $questions[] = Questions::where('level_id',$level)
                                    ->where('section_id',$section->id)
                                    ->orderBy(DB::raw('RAND()'))
                                    ->take($qcount)
                                    ->get();
                    }
                    $i++;
                }
            }
            else{
               foreach ($levelid as $level) {
                    $questions[] = Questions::where('level_id',$level)
                                    ->where('section_id',$section->id)
                                    ->orderBy(DB::raw('RAND()'))
                                    ->take($qcount)
                                    ->get();                
                }  
            }           
            
            $j++;
        }
        // echo "<pre>";   
        // print_r($questions);
        // print_r($questions[$i]->question_id);
        // print_r($questions->section_id);
        // exit;

        $uid =  session('user_id');
            
        // $questions = array();
        $j = 0;
            foreach ($questions as $question) {
            //     $id = $question[$j]->question_id;  
            //     $data = array('user_id'=>$uid,'question_id'=>$id);
            //     $test = DB::table('user_answers')->insert($data);
            foreach($question as $key => $value){
                // echo "<pre>";
                // print_r($value);
                $id = $value->question_id;  
                $data = array('user_id'=>$uid,'question_id'=>$id);
                $test = DB::table('user_answers')->insert($data);
               // $answer = new Answers;
               // $answer->question_id=$question[$j]['question_id'];
               // $answer->user_id=$uid;
               // $answer->save();
             // $j++;
            }

            }

            // echo "<pre>";
            // print_r($);
            // exit;
        return redirect('/apt-form/'.base64_encode($user->campus_id));
        }
        else{
        
            //echo 'Already email entered!';
            return redirect('/user-details/'.base64_encode($campus->campus_id))
                    ->withErrors('Already email entered!')
                    ->withInput();
                   // exit;
        }
    }

    public function aptitudeForm(Request $request,$id)
    {
        $campus_id = base64_decode($id);
        $campus = Campus::find($campus_id);
        $sections = Sections::all();
        $levelid = $campus->question_level_id;
        $count = $campus->question_count;

        if ($request->session()->has('user_id')) {
            $user = User::where('id', '=', session('user_id'))->exists();
            if(!$user){
               return redirect('/home/'.base64_encode($campus->campus_id));
            }
            //echo "<pre>"; 
            $data = array();
            // $questions = DB::table('questions')
            //              ->where('level_id',$levelid)
            //              ->get();
            $uid =  session('user_id');

            // $j = 0;
            // foreach ($questions as $question) {
            //     $id = $question->question_id;  
            //     $data = array('user_id'=>$uid,'question_id'=>$id);
            //     $test = DB::table('user_answers')->insert($data);
            // $j++;

            // }
            

            $testquestions= DB::table('questions As Q')
                ->select('Q.question_id','Q.question_name','Q.question_info','S.section_name')
                ->join('user_answers As UA', 'Q.question_id', '=', 'UA.question_id')
                ->join('sections As S', 'Q.section_id', '=', 'S.id')
                // ->where('Q.level_id',$levelid)
                ->where('UA.user_id', $uid)
                // ->groupBy('Q.section_id')
                ->get();
                // echo "<pre>";
                // print_r($testquestions);
                // exit;
             $i = 0;            
            foreach($testquestions as $testquestion){
                $_qid = $testquestion->question_id;            
                $options = DB::table('question_options')->where('question_id',$_qid)->get();
                $testquestions[$i]->options = $options;
                 $i++;
                // print_r($_qid);
            }

                // exit;

            $campus_time = ($campus->campus_time !='')?explode("_",$campus->campus_time):''; 
            $campus['time']    = $campus_time[1]; 
            if($campus['time']  == 'Minutes'){
                $campus['min_val'] = $campus_time[0] * 60; 
            }else if($campus['time'] == 'Hour'){
                floor($campus_time[0] / 3600);
                $campus['min_val']  = $campus_time[0] * 3600;
            }
            // echo '<pre>'; print_r($campus);exit();
            $data['title'] = 'Aptitude Form';
            $data['questions'] = $testquestions;
            return view('aptitude_test.aptitude_form', compact('options','campus','sections'),$data);
        }
        else{
            return redirect('/home/'.base64_encode($campus->campus_id));
        }
    }
    public function saveUserAnswers(Request $request,$id)
    {
        //echo 'save answers';
        $campus_id = base64_decode($id);
        $campus = Campus::find($campus_id);
        $levelid = unserialize($campus->question_level_id); 
        $uid =  session('user_id');   
        // print_r($levelid);   
        // exit;
        $user_id = session('user_id');
        if(empty($user_id)){
            return redirect('/home');
        }
        /**If the user resubmits the form after completing the test redirect him to already submitted page */
        $user_check =DB::table('test_completion_details')->where('user_id', $user_id)->exists();
        if($user_check){
            return redirect('/already-submitted');
        } 

        $answers = array();
        $i=1;
        foreach ($request->except('_token') as $question_id => $select_option_id) {
                $answers[$i]['user_id'] = session('user_id');
                $answers[$i]['question_id'] = $question_id;
                $answers[$i]['selected_option_id'] = $select_option_id;          
                $i++;
        }
        // echo '<pre>';
        // print_r($answers[1]['selected_option_id']); 
        // exit();

        foreach ($answers as $answer) {
            $update = DB::table('user_answers')
                    ->where('user_id',$answer['user_id'])
                    ->where('question_id',$answer['question_id'])
                    ->update(array('selected_option_id'=>$answer['selected_option_id']));
        }
       
        // exit;
        // DB::table('user_answers')->insert($answers);
        foreach ($levelid as $key => $value) {
            // $total_questions = DB::table('questions As Q')
            // ->select(DB::raw("count(Q.question_id) as no_of_questions"))
            // ->where('level_id',$value)   
            // ->groupBy('Q.section_id')
            // ->get();
            $total_questions = DB::table('user_answers As U')
            ->select(DB::raw("count(U.question_id) as no_of_questions"))
            ->join("questions As Q","U.question_id","=","Q.question_id")
            ->where('Q.level_id',$value)
            ->where('U.user_id',$uid)   
            ->groupBy('Q.section_id')
            ->get();
        }
         //     echo '<pre>';
         // print_r($total_questions);
         // exit();
        
        foreach ($levelid as $key => $value) {
        $data['results'] = DB::table('questions As Q')
                ->select('Q.section_id', 'S.section_name',DB::raw("count(Q.question_id) as correct_answers"),DB::raw("sum(Q.marks) as sum_of_marks"))
                ->join('user_answers As UA', 'Q.right_option_id', '=', 'UA.selected_option_id')
                ->join('sections As S', 'Q.section_id', '=', 'S.id')
                ->where('Q.level_id',$value)
                ->where('UA.user_id', $user_id)
                ->groupBy('Q.section_id')
                ->get();
      }
      // print_r($data);
      // exit;
        
        $quantitative_per = 0;
        $verbal_per = 0;
        $logical_per = 0;
        $section_arr = array();
       // $count = 0;
       foreach($data['results'] as $dataKey=>$dataVal){
           $section_arr[$dataVal->section_name] = number_format(($dataVal->correct_answers / $total_questions[$dataKey]->no_of_questions)*100,2);
          // echo $dataKey.'---'.'---'.$dataVal->section_name;
         //  $count++;
       }
       $a = 0;
       foreach ($section_arr as $key => $value) {
           $a += $section_arr[$key];
       }
       // echo $a;

       // echo '<pre>';print_r($section_arr);exit;
       
        $is_test_completed = 'Yes';
        $test_completed_date = date('Y-m-d H:i:s');
       
        //$common_ques_data_arr = array('quantitative_per'=>$quantitative_per,'verbal_per'=>$verbal_per,'logical_per'=>$logical_per);
        $total_per = number_format((( $a ) / 300 )*100,2);
        $common_ques_data = (is_array($section_arr) && count($section_arr)>=0)?serialize($section_arr):'0';
         // echo "<pre> jh";
         // print_r($common_ques_data); 
         // exit;
        $detail_arr = array(
            'user_id' => $user_id,
            'is_test_completed' => $is_test_completed,
            'test_completed_date' => $test_completed_date,
            'common_ques_data'=>$common_ques_data,
            // 'quantitative_per' => $quantitative_per,
            // 'verbal_per' => $verbal_per,
            // 'logical_per' => $logical_per,
            //  'quantitative_per' => '',
            // 'verbal_per' => '',
            // 'logical_per' => '',
            'total_per' => $total_per
        );
       // echo '<pre>';print_r($detail_arr);
     // exit;   
        DB::table('test_completion_details')->insert($detail_arr);
        return redirect('/results/'.base64_encode($campus->campus_id));
    }
      /*
        insert into `test_completion_details` (`user_id`, `is_test_completed`, 
        `test_completed_date`, `common_ques_data`, `quantitative_per`, `verbal_per`, `logical_per`, `total_per`) 
        values ('128', 'Yes', '2018-12-13 16:03:46', 
        'a:3:{s:16:"quantitative_per";s:6:"100.00";s:10:"verbal_per";s:6:"400.00";s:11:"logical_per";s:6:"300.00";}', 
        '', '', '', '266.67')
       */
    public function results(Request $request,$id)
    {
        $campus_id = base64_decode($id);
        $campus = Campus::find($campus_id);
        $levelid = $campus->question_level_id;
       
        if ($request->session()->has('user_id') && session('user_name')!='admin') {
            $user_id = session('user_id');
            $test_completion_check = DB::table('test_completion_details')->where('user_id', $user_id)->exists();
            /** If the user logged in and not completed  the test then redirect to form */
            if(!$test_completion_check){
                return redirect('/apt-form/'.base64_encode($campus->campus_id));
            }
        
        $data = array();
        $data['title'] = 'Test Completed';
        //$total_questions = DB::table('questions As Q')
        // ->select(DB::raw("count(Q.question_id) as no_of_questions"))
        // ->where('Q.level_id',$levelid)
        // ->groupBy('Q.section_id')
        // ->get();
        
        // $data['results'] = DB::table('questions As Q')
        //         ->select('Q.section_id', 'S.section_name',DB::raw("count(Q.question_id) as correct_answers"),DB::raw("sum(Q.marks) as sum_of_marks"))
        //         ->join('user_answers As UA', 'Q.right_option_id', '=', 'UA.selected_option_id')
        //         ->join('sections As S', 'Q.section_id', '=', 'S.id')
        //         ->where('UA.user_id', $user_id)
        //         ->groupBy('Q.section_id')
        //         ->get();
                // $total_per  = 0;
                // $count  = 0;
                // foreach($data['results'] as $dataKey=>$dataVal){
                    
                //     $data['results'][$dataKey]->total_questions = $total_questions[$dataKey]->no_of_questions;
                //     $total_per     += ($dataVal->correct_answers != '' || $dataVal->correct_answers != '0')?number_format(($dataVal->correct_answers/$dataVal->total_questions)*100,2):0;
                //     $count++;
                // }
            // echo  $total_per;
            // $data['percent'] = ($total_per != 0 || $total_per != '') ?number_format(($total_per ) / $count):0;
           //echo '<pre>'; print_r($data);echo '</pre>';exit;
            // $data['results'][0]->total_questions = $total_questions[0]->no_of_questions;
            // $data['results'][1]->total_questions = $total_questions[1]->no_of_questions;
            // $data['results'][2]->total_questions = $total_questions[2]->no_of_questions;
        //echo '<pre>'; print_r($data);echo '</pre>';exit;
        return view('aptitude_test.results', $data);
        }else{
            return redirect('/');
        }
    }

    public function alreadySubmitted()
    {
        if(session('user_id')){
            $data['title'] = "Already Test Attended";
            return view('aptitude_test.already_submitted', $data);
        }
        return redirect('/');
       
    }

    public function logout(Request $request)
    {

        if(session('user_name') == 'admin'){
            $redirect_path = '/admin';
            $request->session()->forget('user_id');
        $request->session()->forget('user_name');
        return redirect($redirect_path);
        }
        else{
            // $redirect_path = '/';
            echo"<div class='alert alert-success'>logged out successfully</div>";
        $request->session()->forget('user_id');
        $request->session()->forget('user_name');
        // return redirect($redirect_path);
    }
    }

  
}
