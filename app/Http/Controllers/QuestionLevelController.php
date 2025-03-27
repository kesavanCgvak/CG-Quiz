<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Hash;
use Cookie;
use Mail;
use Session;
use App\QuestionLevel;
use App\Questions;
use Carbon\Carbon;

class QuestionLevelController extends Controller
{
	
	function __construct(Request $request)
	{
		if($request->session()->has('user_id') && session('user_name') != 'admin'){
			return redirect('/admin');
		}
	}

	public function index(Request $request) 
	{
		if($request->session()->has('user_id') && session('user_name') == 'admin')
        {
        $data = array(
            'title' => 'Question Level'
        );
        $data['levels'] = QuestionLevel::all();

        return view('admin.question_level', $data);
    	}
    	else{
    		return redirect('/admin');
    	}
	}
    public function create() {
		$data = array(
			'title' => 'Create Level'
		);
		return view('admin.add_level', $data);
	}

	public function store(Request $request) {
		$rules = array(
			'level' => 'required'
		);
		$this->validate($request, $rules);

		$insert = QuestionLevel::create($request->all());
		if($insert) {
			Session::flash('message', 'Question Level added successfully');
			Session::flash('alert-class', 'alert-success');
		} else {
			Session::flash('message', 'Something went wrong!');
			Session::flash('alert-class', 'alert-danger');
		}
		
		return redirect('level');
	}

	public function edit($id) {
		$data = array(
			'title' => 'Edit Level'
		);
		$level_id = base64_decode($id);
		$data['level_details'] = QuestionLevel::find($level_id);
		return view('admin.edit_level', $data);
	}

	public function update(Request $request, $id) {
		$rules = array(
			'level' => 'required'
		);
		$this->validate($request, $rules);
		$level_id = base64_decode($id);
		$update = QuestionLevel::where('id', $level_id)->update(
			array_merge($request->except(['_token']), ['updated_at' => Carbon::now()])
		);
		if($update) {
			Session::flash('message', 'Question Level updated successfully');
			Session::flash('alert-class', 'alert-success');
		} else {
			Session::flash('message', 'Something went wrong!');
			Session::flash('alert-class', 'alert-danger');
		}

		return redirect('level');
	}

	public function delete(Request $request) {
		$level_id = $request->input('level');
		$level = QuestionLevel::find(base64_decode($level_id));
		if($level->delete()) {
			$data = 'Level deleted successfully';
		} else {
			$data = 'Something went wrong!';
		}
		return response()->json($data);
	}
}