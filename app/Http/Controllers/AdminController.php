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
 use Crypt;
use App\Campus;
use App\College;
use App\User;

class AdminController extends Controller
{

    public function __construct()
    {

    }

    public function showLoginForm()
    {
        return view('admin.login');
    }
    

    public function login(Request $request)
    {
        // print_r(Hash::make($request->input('login_password')));
        // exit;       
        
        $rules = ['login_username' => 'required', 'login_password' => 'required|min:6'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/admin')->withErrors($validator)->withInput();
        }
        $user = DB::table('admin')->where('name', '=', $request->input('login_username'))->first();        
        if ($user) {
            // echo $user->password.'//'.$request->input('login_password');die;
            if (Hash::check($request->input('login_password'), $user->password)) {                
                session(['user_id' => $user->id, 'user_name' => $user->name]);
                $remember_me = $request->input('rememberme');
                if ($remember_me != '' && $remember_me == 'on') {
                    $year = time() + 31536000;
                    setcookie('rem_username', $user->name, $year);
                    setcookie('rem_password', $request->input('login_password'), $year);
                } elseif ($remember_me == '' || $remember_me == NULL) {
                    $past = time() - 3600;
                    setcookie('rem_username', '', $past);
                    setcookie('rem_password', '', $past);
                }

                return redirect('/dashboard');
            } else {
                return redirect('/admin')->withErrors(['Invalid Username or password combination']);
            }
        } else {
            return redirect('/admin')->withErrors(['Invalid Username or password combination']);
        }
    }
    // public function session(Request $request){
    //   if($request->session()->has('user_id') && session('user_name') == 'admin'){
    //     return redirect('/dashboard');
    //   }
    // }
    public function showCampusReports(Request $request)
    {

        if ($request->session()->has('user_id') && session('user_name') == 'admin') {
            $data['title'] = 'Campus Test Reports';
            $campus = $data['reports'] = DB::table('campus_details As CD')
                                        ->join('college_details As CLD', 'CLD.id', '=', 'CD.college_id')
                                        ->join('users as U', 'U.campus_id', '=', 'CD.campus_id')
                                        ->join('test_completion_details As TCD', 'TCD.user_id', '=', 'U.id')
                                        ->select('CD.*', 'CLD.*', 'TCD.*', DB::raw('count(U.id) AS total_users'))
                                        ->groupBy('CD.campus_id')
                                        ->get();

            $pass = DB::table('test_completion_details As tcd')->select(DB::raw('count(tcd.id) As passcount'), 'cd.campus_id')->join('users As u', 'tcd.user_id', '=', 'u.id')->join('campus_details As cd', 'cd.campus_id', '=', 'u.campus_id')->where('result', '1')->groupBy('cd.campus_id')->get();
    
            $fail = DB::table('test_completion_details As tcd')->select(DB::raw('count(tcd.id) As failcount'), 'cd.campus_id')// echo "<pre>";
                ->join('users As u', 'tcd.user_id', '=', 'u.id')->join('campus_details As cd', 'cd.campus_id', '=', 'u.campus_id')->where('result', '0')->groupBy('cd.campus_id')->get();
       
            $considered = DB::table('test_completion_details As tcd')->select(DB::raw('count(tcd.id) As considered'), 'cd.campus_id')->join('users As u', 'tcd.user_id', '=', 'u.id')->join('campus_details As cd', 'cd.campus_id', '=', 'u.campus_id')->where('result', '2')->groupBy('cd.campus_id')->get();
    
            $dates = DB::table('campus_details')->select(DB::raw('YEAR(campus_date) AS year'))->groupBy('year')->get();
      
            $campus = Campus::all();
            $campus_count = Campus::all()->count();

            $user_count = DB::table('test_completion_details')->select(DB::raw('count(user_id) As user_count'))->get();
   
            $user_count = $user_count[0]->user_count;
            $college = College::all();
            return view('admin.campus_reports', compact('pass', 'fail', 'considered', 'campus', 'college', 'campus_count', 'user_count', 'dates'), $data);
        } else {
            return redirect('/admin');
        }
    }

    public function showUserReports(Request $request, $id)
    {
        $campus_id = base64_decode($id);
        // echo $campus_id;
        // exit;
        // $campus = Campus::find($campus_id);
        if ($request->session()->has('user_id') && session('user_name') == 'admin') {
            $data['title'] = 'User Test Reports';
            $data['reports'] = DB::table('test_completion_details As TCD')->join('users As U', 'U.id', '=', 'TCD.user_id')->join('campus_details As CD', 'CD.campus_id', '=', 'U.campus_id')->where('U.campus_id', $campus_id)->get();
            // echo "<pre>";
            // print_r($data);
            // exit;
            foreach ($data['reports'] as $result) {
                $answers[$result->user_id] = unserialize($result->common_ques_data);
                $setId = $result->user_id;
            }
            // print_r($answers);
            // exit;
            $newAns = $answers[$setId];

            $headingTitle = Array();
            foreach ($newAns as $key => $value) {
                array_push($headingTitle, $key);
            }
            // print_r($headingTitle);
            // exit;

            return view('admin.reports', compact('answers', 'headingTitle'), $data);
        } else {
            return redirect('/admin');
        }

    }

    public function showUserDetailView(Request $request, $user_id = '')
    {
        if ($request->session()->has('user_id') && session('user_name') == 'admin') {
            $data['title'] = 'User View';
            $data['results'] = DB::table('test_completion_details As TCD')->join('users As U', 'U.id', '=', 'TCD.user_id')->where('user_id', $user_id)->first();
            $answer = unserialize($data['results']->common_ques_data);
            // print_r($answer);
            // exit;
            return view('admin.user_detail_view', compact('answer'), $data);
        } else {
            return redirect('/admin');
        }
    }

    public function deleteReport(Request $request)
    {

        $user_id = $request->input('user_id');
        if ($request->session()->has('user_id') && session('user_name') == 'admin' && $user_id != '') {
            if (DB::table('test_completion_details')->where('user_id', $user_id)->delete()) {
                return response()->json('Report deleted Successfully');
            }
        } else {
            return redirect('/admin');
        }
    }

    public function showForgotUserForm()
    {
        $data['title'] = "Forgot Password Form";
        return view('admin.forgot_password_form', $data);
    }

    public function forget_password(Request $request)
    {
        $data['page_title'] = 'Forget Password';
        $data['email_error'] = '';

        if ($request->input('cancel')) {
            return redirect('/admin');
        }
        if ($request->isMethod('post')) {
            $rules = ['email' => 'required|email'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('/forgot-pwd')->withErrors($validator)->withInput();
            }
            $user_email = $request->input('email');
            $email_exists = DB::table('admin')->where('email', $user_email)->exists();
            if ($email_exists) {
                $new_pwd = str_random(8);
                $new_hashed_pwd = Hash::make($new_pwd);
                $data['email'] = $user_email;
                $data['password'] = $new_pwd;
                $data['link'] = url('/admin');
                //echo $user_email;die;
                Mail::send('admin.email', $data, function ($message) use ($data) {
                    $message->subject('New Password Generated');
                    $message->from('officeusetestmail@gmail.com', 'CGVAK Quiz');
                    $message->to($data['email']);
                });
                DB::table('admin')->where('email', $user_email)->update(['password' => $new_hashed_pwd]);
                Session::flash('message', 'Please check your email. We have sent a new password.');
                return redirect('/forgot-pwd');
            } else {
                return redirect('/forgot-pwd')->withErrors(['Email Id does not exists in our records']);
            }

        }

    }

    public function dashboard(Request $request)
    {
        // return view('admin.dashboard');
        if ($request->session()->has('user_id') && session('user_name') == 'admin') {
            $data['title'] = 'Dashboard';
            $data['users'] = User::all()->count();
            $data['campus'] = Campus::all()->count();
            $data['college'] = College::all()->count();
            $user = DB::table('users')->select('campus_details.campus_name', DB::raw('count(users.id) AS total_users'))->join('campus_details', 'users.campus_id', '=', 'campus_details.campus_id')->groupBy('campus_details.campus_id')->get();
            // echo "<pre>";
            // print_r($user);
            // exit;
            return view('admin.dashboard', compact('user'), $data);
        } else {
            return redirect('/admin');
        }
    }

    public function update_result(Request $request)
    {
        $chckId = $request->input('chckId');
        // echo $chckId;
        // exit();
        $result = DB::table('test_completion_details')->where('user_id', $chckId)->update(['result' => '2']);
        if ($result) {
            $data = 'Result updated Successfully';
        } else {
            $data = 'Something went wrong';
        }
        return response()->json($data);
    }

}
