<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;
use Hash;
use Cookie;
use Mail;
use Session;
use App\Questions;
use App\Sections;
use App\QuestionLevel;
use App\Option;

/**
 * Questions Controller
 */
class QuestionsController extends Controller
{
    public function __construct()
    {
    }

    public function listQuestions(Request $request)
    {
        if ($request->session()->has('user_id') && session('user_name') == 'admin') {
            $data = array('title' => 'Questions');
            $data['questions'] = DB::table('questions as qs')->join('sections as ss', 'ss.id', '=', 'qs.section_id')->orderBy('question_id', 'asc')->get();
            return view('admin.questions', $data);
        } else {
            return redirect('/admin');
        }
    }

    public function create()
    {
        $data = array('title' => 'Create Question', 'sections' => Sections::where('is_active', 'Yes')->get(), 'levels' => QuestionLevel::all());
        $question_data = DB::table('questions')->select('*')->where('question_info', '<>', '')->get();
        return view('admin.add_question', compact('question_data'), $data);
    }

    public function store(Request $request)
    {
//        echo "<pre>";
//        print_r($request->all());
//        exit;
        $last_number = $request->input('sub_question');

        if (empty($request->input('sub_question'))) {
            $last_number = DB::table('questions')->select('question_number')->orderBy('question_id', 'desc')->first();
            if(!empty($last_number)){                  
                $last_number = $last_number->question_number + 1;
            }else{
                $last_number = 0;
            }
        }

        $data = array('section_id' => $request->input('section'), 'level_id' => $request->input('level'), 'question_info' => $request->input('question_info'), 'question_name' => $request->input('question_name'), 'question_number' => $last_number, 'marks' => $request->input('marks'),

        );
        $question = Questions::create($data);
        for ($i = 1; $i <= 4; $i++) {
            $option = new Option();
            $option->question_id = $question->question_id;
            $option->option_value = $request->input('option_' . $i);
            $option->save();
        }

        $right_option = Input::get('right_option');
        $match = ['option_value' => $right_option, 'question_id' => $option->question_id];

        $options = Option::select('option_id')->where($match)->get();
        foreach ($options as $opt => $value) {
            $new = $value->option_id;
        }

        $data = array('right_option_id' => $new);
        $option = Questions::where('question_id', $option->question_id)->update($data);

        if ($option) {
            Session::flash('message', 'Question added successfully');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect('questions');
    }

    public function upload()
    {
        $CKEditor = Input::get('CKEditor');
        $funcNum = Input::get('CKEditorFuncNum');
        $message = $url = '';
        if (Input::hasFile('upload')) {
            $file = Input::file('upload');
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName();
                $file->move(public_path() . '/images/', $filename);
                $url = 'http://202.129.196.132/quiz/public/images/' . $filename;
            } else {
                $message = 'An error occured while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction(' . $funcNum . ', "' . $url . '", "' . $message . '")</script>';
    }

//    public function showParent(Request $request)
//    {
    ////        return $request->input('id');
//        $parent = DB::table('questions')->select('question_info')->where('section_id', '=', $request->input('id'))->get();
//        return $parent;
//    }

    public function edit($id)
    {
        $data = array('title' => 'Edit Question',);
        $question_id = base64_decode($id);
        $data['question_details'] = Questions::where('question_id', $question_id)->first();
        $sections = Sections::all();
        $questionlevels = QuestionLevel::all();
        $options = Option::where('question_id', $question_id)->get();
        // echo "<pre>";
        // echo base64_decode($id);
        // print_r($options);
        // exit;
        return view('admin.edit_question', compact('sections', 'questionlevels', 'options'), $data);
    }

    public function update(Request $request, $id)
    {

//        $rules = array('section_id' => 'required', 'question_name' => 'required', 'marks' => 'required', 'option_1' => 'required', 'option_2' => 'required', 'option_3' => 'required', 'option_4' => 'required', 'right_option_id' => 'required', 'level_id' => 'required',
//
//        );
//        $this->validate($request, $rules);

        $question_id = base64_decode($id);

        for ($i = 1; $i <= 4; $i++) {
            $update_option = array('option_value' => $request->input('option_' . $i));
            $option_update = DB::table('question_options')->where('option_id', $request->input('option_id_' . $i))->update($update_option);
        }

        $right_option = Input::get('right_option_id');
        $match = ['option_value' => $right_option, 'question_id' => $question_id];
        $options = Option::select('option_id')->where($match)->get();
        foreach ($options as $option) {
            $right_option = $option->option_id;
        }

        $update_question = array('question_name' => $request->get('question_name'), 'section_id' => $request->get('section_id'), 'level_id' => $request->get('level_id'), 'question_info' => $request->get('question_info'), 'marks' => $request->get('marks'), 'right_option_id' => $right_option,);
        $update = Questions::where('question_id', $question_id)->update($update_question);

        if ($update || $option_update) {
            Session::flash('message', 'Question updated successfully');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect('questions');
    }

    public function deleteQuestions(Request $request)
    {
        $question_id = $request->input('question');
        $question = Questions::find(base64_decode($question_id));
        $delete_options = Option::where('question_id', '=',base64_decode($question_id))->delete();
        if ($question->delete() && $delete_options) {
            $data = 'Question deleted successfully';
        } else {
            $data = 'Something went wrong!';
        }
        return response()->json($data);
    }
}
