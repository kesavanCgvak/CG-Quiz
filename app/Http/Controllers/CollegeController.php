<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use View;
use Hash;
use Cookie;
use Mail;
use Session;
use App\College;

class CollegeController extends Controller
{

    public function index(Request $request) {
        if($request->session()->has('user_id') && session('user_name') == 'admin'){
            $data = array(
                'title' => 'Colleges',
                'colleges' => College::all()
            );
            $contact_email = [];
            foreach ($data['colleges'] as $key => $value) {
                if(!empty($value->contact_email)){
                    $contact_email[$value->id] = unserialize($value->contact_email);
                }
              
            }

            $phone_number = [];
            foreach ($data['colleges'] as $key => $value) {
              $phone_number[$value->id] = unserialize($value->phone_number);
            }
            // echo "<pre>";
            // print_r($contact_email);
            // exit;
            return view('admin.college',compact('contact_email','phone_number'),$data);
        }
        else{
            return redirect('/admin');
        }
    }

    public function create() {
        $data = array(
            'title' => 'Add College'
        );
        return view('admin.add_college',$data);
    }

    public function store(Request $request) {

        $data = array(
            'college_name' => $request->input('college_name'),
            'college_address' => $request->input('college_address'),
            'placement_officer_name'=>$request->input('placement_officer_name'),
            'contact_email' => serialize($request->input('contact_email')),
            'phone_number' => serialize($request->input('phone_number')),
            'is_active' => $request->input('status')
        );
        // print_r($data);
        // exit;
        $insert = College::insert($data);
        if($insert) {
    			Session::flash('message', 'College added successfully');
    			Session::flash('alert-class', 'alert-success');
		    }
        else {
    			Session::flash('message', 'Something went wrong!');
    			Session::flash('alert-class', 'alert-danger');
        }
        return redirect('colleges');
    }


    public function edit($id) {
        $data = array(
            'title' => 'Edit College'
        );
        $college_id = base64_decode($id);

        $data['college_details'] = College::find($college_id);
        $contact_email = unserialize($data['college_details']->contact_email);
        $phone_number = unserialize($data['college_details']->phone_number);
        return view('admin.edit_college',compact('contact_email','phone_number'),$data);
    }

    public function update(Request $request, $id) {

        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $college_id = base64_decode($id);
        $update_values = array(
          'college_name' => $request->input('college_name'),
          'college_address' => $request->input('college_address'),
          'placement_officer_name'=> $request->input('placement_officer_name'),
          'contact_email'=> serialize($request->input('contact_email')),
          'phone_number'=>  serialize($request->input('phone_number')),
          'is_active' => $request->input('is_active')
        );
        $update = College::where('id', $college_id)->update($update_values);

        if($update) {
            Session::flash('message', 'College updated successfully');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect('colleges');
    }

    public function delete(Request $request) {
        $college_id = $request->input('college');
        $college = College::find(base64_decode($college_id));
        if($college->delete()) {
            $data = 'College deleted successfully';
        } else {
            $data = 'Something went wrong!';
        }
        return response()->json($data);
    }

}
