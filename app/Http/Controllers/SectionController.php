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
use App\Sections;

/**
 * Section Controller
 */
class SectionController extends Controller
{

	function __construct(Request $request)
	{
		if($request->session()->has('user_id') && session('user_name') != 'admin'){
			return redirect('/admin');
		}
	}

	public function index(Request $request) {
        if($request->session()->has('user_id') && session('user_name') == 'admin'){
			$data = array(
				'title' => 'Sections'
			);
			$data['sections'] = DB::table('sections')->get();
        	return view('admin.sections', $data);
    	}
    	else{
    		return redirect('/admin');
    	}

	}

	public function create() {
		$data = array(
			'title' => 'Create Section'
		);
		return view('admin.add_section', $data);
	}

	public function store(Request $request) {
		$rules = array(
			// 'section' => 'required|max:10',
			'section_name' => 'required|unique:sections',
			// 'pass_percentage' => 'required|numeric',
			// 'sort_order' => 'required|numeric',
			'is_active' => 'required'
		);
		$this->validate($request, $rules);

		$insert = Sections::create($request->all());
		if($insert) {
			Session::flash('message', 'Section added successfully');
			Session::flash('alert-class', 'alert-success');
		} else {
			Session::flash('message', 'Something went wrong!');
			Session::flash('alert-class', 'alert-danger');
		}

		return redirect('sections');
	}

	public function edit($id) {
		$data = array(
			'title' => 'Edit Section'
		);
		$section_id = base64_decode($id);
		// $section_details = Sections::where('id', $section_id)->first();
		$data['section_details'] = Sections::find($section_id);
		return view('admin.edit_section', $data);
	}

	public function update(Request $request, $id) {
		$rules = array(
			// 'section' => 'required|max:10',
			'section_name' => 'required',
			// 'pass_percentage' => 'required|numeric',
			// 'sort_order' => 'required|numeric',
			'is_active' => 'required'
		);
		$this->validate($request, $rules);

		$section_id = base64_decode($id);
		$update = Sections::where('id', $section_id)->update($request->except(['_token']));
		if($update) {
			Session::flash('message', 'Section updated successfully');
			Session::flash('alert-class', 'alert-success');
		} else {
			Session::flash('message', 'Something went wrong!');
			Session::flash('alert-class', 'alert-danger');
		}

		return redirect('sections');
	}

	public function delete(Request $request) {
		$section_id = $request->input('section');
		$section = Sections::find(base64_decode($section_id));
		if($section->delete()) {
			$data = 'Section deleted successfully';
		} else {
			$data = 'Something went wrong!';
		}
		return response()->json($data);
	}
}
