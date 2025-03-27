<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

use Validator;
use DB;
use View;
// use Excel;
use File;
use Hash;
use Cookie;
use Mail;
use Session;
use App\User;
use App\Campus;
use App\College;
use App\QuestionLevel;
use App\Questions;
use App\Groups;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->session()->has('user_id') && session('user_name') == 'admin') {
            $data = array('title' => 'Campuses', 'campuses' => Campus::all(),);
            return view('admin.campus', $data);
        } else {
            return redirect('/admin');
        }
    }


//    Ajax call to get count of questions
    public function getCount(Request $request)
    {
        $id = $request->input('count');
        $get_count = Groups::find($id);
        $get_count = count(unserialize($get_count->pre_questions));

        return $get_count;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $data = array('title' => 'Add campus');
        $colleges = College::all();
        $questions = Questions::orderBy('question_id', 'asc')->groupBy('question_number')->get();
        $sections = DB::table('sections As S')->select('S.id', 'S.section_name')->join('questions As Q', 'Q.section_id', '=', 'S.id')->groupBy('S.id')->get();
        $groups = Groups::all();
        foreach ($sections as $section) {
            $levels[$section->id] = DB::table('questions As Q')->select('Q.level_id', 'L.level', DB::raw('count(Q.question_id) as max_count'))->join('questions_level As L', 'L.id', '=', 'Q.level_id')->where('section_id', $section->id)->groupBy('level_id')->get();
        }
        return view('admin.add_campus', compact('colleges', 'levels', 'sections', 'questions', 'groups'), $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $passwords = DB::table('campus_details')->select('password')->get();
        $count = Campus::all()->count();
        $pass = [];
        if($count > 0){
                for ($i = 0; $i <= $count - 1; $i++) {
                    $pass[] = $passwords[$i]->password;
                }
        }

        if(!empty($pass)){
            if (in_array($request->input('password'), $pass)) {
                return redirect('add-campus')->withErrors('Password Should be unique');
            }
        }

        $insert = array();
        if ($request->hasFile('candidates')) {
            $path = $request->file('candidates')->getRealPath();
            $path = $request->file('candidates');

            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    foreach ($value as $skey => $svalue) {
                        $insert[] = $svalue;
                    }
                }
            }
        }

        if (count(array_unique($insert)) < count($insert)) {
            return redirect('add-campus')->withErrors('Register Number should be unique');
        }
        
        $candidates = serialize($insert);

        $questions = serialize($request->input('question_count'));
        if (!empty($request->predefined_questions)) {
            $question_id = ($request->input('predefined_questions'));
            $question = Groups::find($question_id);
            $questions = $question->pre_questions;
        }

        $data = array('campus_name' => $request->input('campus_name'), 
                    'campus_info' => $request->input('campus_info'),
                    'campus_date' => date("Y-m-d",
                     strtotime($request->input('campus_date'))), 
                    'college_id' => $request->input('select_college'), 
                    'pass_percentage' => $request->input('pass_percentage'), 
                    'total_questions' => $request->input('total_questions'), 
                    'questions' => $questions,
                    'group_id'=>$request->input('predefined_questions'), 
                    'candidates' => $candidates, 
                    'password' => $request->input('password'), 
                    'campus_time' => $request->input('campus_time') . '_' . $request->input('duration'),
                );
      ;
        $insert = Campus::insert($data);
      
        if ($insert) {
            Session::flash('message', 'Campus added successfully');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect('campuses');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $data = array('title' => 'Edit Campus');
        $campus_id = base64_decode($id);
        $data['campus_details'] = Campus::find($campus_id);

        $campus_time = ($data['campus_details']->campus_time != '') ? explode("_", $data['campus_details']->campus_time) : '';
        $data['campus_details']['min_val'] = $campus_time[0];
        $data['campus_details']['time'] = $campus_time[1];
        if (trim($data['campus_details']['time']) == 'Minutes') {
            $data['campus_details']['time_duration'] = 'Hour';
        } else if (trim($data['campus_details']['time']) == 'Hour') {
            $data['campus_details']['time_duration'] = 'Minutes';
        }

        $sections = DB::table('sections As S')->select('S.id', 'S.section_name')->join('questions As Q', 'Q.section_id', '=', 'S.id')->groupBy('S.id')->get();
        
        foreach ($sections as $section) {
            $levels[$section->id] = DB::table('questions As Q')->select('Q.level_id', 'L.level', DB::raw('count(Q.question_id) as max_count'))->join('questions_level As L', 'L.id', '=', 'Q.level_id')->where('section_id', $section->id)->groupBy('level_id')->get();
        }
        
        $colleges = College::all();
        $groups = Groups::all();
        $questions_all = Questions::orderBy('question_id', 'asc')->groupBy('question_number')->get();
        $questions = (unserialize($data['campus_details']->questions));
        $register_numbers = unserialize($data['campus_details']->candidates);
        sort($register_numbers);    
        $count_candidates = count($register_numbers);

        $get_reg_no = DB::table('users')
                    ->select('registration_number')
                    ->where('campus_id',$campus_id)
                    ->orderBy('registration_number', 'asc')
                    ->get();
       
        return view('admin.edit_campus', compact('sections','questions_all','questions', 'colleges','groups', 'levels','register_numbers','count_candidates','get_reg_no'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response>
     */

    public function update(Request $request, $id)
    {
        $campus_id = base64_decode($id);
        $get_candidate = Campus::find($campus_id);
        $insert = unserialize($get_candidate->candidates);

        if ($request->hasFile('candidates')) {
            $path = $request->file('candidates')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    foreach ($value as $skey => $svalue) {
                        $insert[] = $svalue;                        
                    }
                }
            }
        }
        
        $candidates = serialize(array_unique($insert));

        $questions = serialize($request->input('question_count'));
        if (!empty($request->predefined_questions)) {
            $question_id = ($request->input('predefined_questions'));
            $question = Groups::find($question_id);
            $questions = $question->pre_questions;
        }
        $updation = array('campus_name' => $request->input('campus_name'), 
                        'campus_info' => $request->input('campus_info'), 
                        'campus_date' => date("Y-m-d",
                        strtotime($request->input('campus_date'))), 
                        'college_id' => $request->input('college_id'), 
                        'pass_percentage' => $request->input('pass_percentage'), 
                        'total_questions' => $request->input('total_questions'), 
                        'questions' => $questions,'group_id'=>$request->input('predefined_questions'),
                        'candidates' => $candidates, 'password' => $request->input('password'), 
                        'campus_time' => $request->input('campus_time') . '_' . $request->input('duration'));

        $update = Campus::where('campus_id', $campus_id)->update($updation);

        if ($update) {
            Session::flash('message', 'Campus updated successfully');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect('campuses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $campus_id = $request->input('campus');
        $campus = Campus::find(base64_decode($campus_id));
        if ($campus->delete()) {
            $data = 'Campus deleted successfully';
        } else {
            $data = 'Something went wrong!';
        }
        return response()->json($data);
    }

    public function deleteCampusUsers(Request $request)
    {        
        $campus_id = $request->input('campus');
        $campus = base64_decode($campus_id);
         $insert = [];
         $candidates = serialize(array_unique($insert));
        $updation = array('candidates'=>$candidates);
        $update = Campus::where('campus_id', $campus)->update($updation);

        if ($update) {
            $data = 'Campus deleted successfully';
        } else {
            $data = 'Something went wrong!';
        }
        return response()->json($data);
    }

    public function deleteUserDetails(Request $request)
    {      

        $register_number = $request->get('reg_no');
        $campus = base64_decode($request->get('campus'));

        $user_id =  DB::table('users')->select('id')
                    ->where('registration_number', $register_number)
                    ->where('campus_id', $campus)
                    ->get();

        $user_id = $user_id[0]->id;
                
        $user_answsers = DB::table('user_answers')->where('user_id', $user_id)->delete();

        $test_completed = DB::table('test_completion_details')->where('user_id', $user_id)->delete();

        $user_table_delete = User::where('id',$user_id)->delete();

        if( $user_table_delete || $user_answsers || $test_completed){
            $data = 'Candidate removed successfully';
        }else{
            $data = 'Something went wrong!';
        }
        return response()->json($data);
    }

}
