<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use DB;
use Session;
use App\Campus;
use App\College;
use App\QuestionLevel;
use App\Questions;
use App\Sections;
use App\Groups;

class preQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo "<pre>";
        if ($request->session()->has('user_id') && session('user_name') == 'admin') {
            $data['title'] = 'predefined-questions';
            $data['pre_questions'] = DB::table('predefined_questions')->select('*')->get();           
            $sections = Sections::all();
             // Initialize $ques_sections to avoid "Undefined variable" error
            $ques_sections = [];
            if(!empty($data['pre_questions'])){
                foreach($data['pre_questions'] as $questions){
                    foreach ($sections as $section) {
                        // echo $questions->pre_questions."<br>";
                        $ques_sections[$questions->id][$section->id]= DB::table('questions')
                                    ->select(DB::raw("count(section_id) As '$section->section_name'"))
                                    ->where('section_id',$section->id)
                                    ->whereIn('question_id', unserialize($questions->pre_questions))
                                    ->groupBy('section_id')
                                    ->get();
                    }
                }                         
            }
            return view('admin.predefined-questions',compact('ques_sections','sections'), $data);
        } else {
            return redirect('/admin');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'predefined-questions';

        $sections = Sections::all();
        foreach ($sections as $section) {
            $questions[$section->id] = Questions::where('section_id', $section->id)->groupBy('question_number')->get();
        }
//        echo "<pre>";
//        print_r($questions);
//        exit;
        return view('admin.add-predefined', compact('questions', 'sections'), $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        echo "<pre>";
//        print_r($request->all());
//        exit;
        $questions = serialize($request->input('predefined_questions'));
        $input_data = array('group_name' => $request['group_name'], 'pre_questions' => $questions);

        $insert = DB::table('predefined_questions')->insert($input_data);

        if ($insert) {
            Session::flash('message', 'Group added successfully');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect('predefined-questions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'edit-groupquestions';
        $group_id = base64_decode($id);
        $get_group = Groups::find($group_id);
        $sections = Sections::all();
        foreach ($sections as $section) {
            $questions[$section->id] = Questions::where('section_id', $section->id)->groupBy('question_number')->get();
        }
        $get_questions = unserialize($get_group->pre_questions);
//        print_r(count($get_questions));
//        exit;
        return view('admin.edit-predefined', compact('sections', 'questions', 'get_questions', 'get_group'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group_id = base64_decode($id);
        $pre_questions = serialize($request->input('predefined_questions'));
        $data = array('group_name' => $request->input('group_name'), 'pre_questions' => $pre_questions);
        $updation = Groups::where('id', '=', $group_id)->update($data);
        if ($updation) {
            Session::flash('message', 'Group updated successfully');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect('predefined-questions');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $question_id = $request->input('preQuestion');
        $group_questions = DB::table('predefined_questions')->where('id', '=', base64_decode($question_id))->delete();
        if ($group_questions) {
            $data = 'Group deleted successfully';
        } else {
            $data = 'Something went wrong!';
        }
        return response()->json($data);
    }

}
