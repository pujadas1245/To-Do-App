<?php

namespace App\Http\Controllers;

use App\task,
    App\User,
    Validator,
    Mail,
    Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Response;

class TaskController extends Controller {

    public function __construct() {
        $this->middleware('preventBackHistory');
        $this->middleware('auth', ['except' => ['create', 'allow', 'check', 'send', 'latest']]);
    }

//to sign up    
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'username' => 'required|max:255|unique:users',
                    'password' => 'required|min:6|unique:users',
                    'password_confirmation' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return Response::json(['success' => false, 'message' => implode('<br>', $validator->errors()->all())]);
        }
        $data = User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'username' => $request['username'],
                    'password' => bcrypt($request['password']),
                    'password_confirmation' => bcrypt($request['password'])
        ]);
        if ($data) {
            return Response::json(['success' => true, 'message' => 'Done.']);
        } else {
            return Response::json(['success' => false, 'message' => 'something  went wrong.']);
        }
    }

//to log-in
    public function check(Request $request) {
        $username = $request->username;
        $password = $request->password;
        $remember_token = $request->remember_token;
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $checking = Auth::attempt(['email' => $username, 'password' => $password], $remember_token);
        } else {
            $checking = Auth::attempt(['username' => $username, 'password' => $password], $remember_token);
        }

        if ($checking) {
            Session::put('is_first', true);
            return Response::json(['success' => true]);
        } else {
            return Response::json(['success' => false, 'message' => 'Please, check your credentials.']);
        }
    }

//after login, show welcome msg    
    public function index() {
        $data = array();
        if (!empty(Session::get('is_first'))) {

            $data['msg'] = "Welcome User!";
        }
        return view('welcome', $data);
    }

//to logout    
    public function logout(Request $request) {
        if (Auth::check()) {
            Auth::logout();
            Session::flush();
            Session::put('log_out', true);
            return Response::json(['success' => true, 'message' => 'You have been logged out']);
        } else {
            return Response::json(['success' => false, 'message' => 'Sorry!You are not logged in.']);
        }
    }

//after logout, show logged out msg  
    public function modify() {
        $data1 = array();
        if (!empty(Session::get('log_out'))) {
            $data1['msg'] = "You have been logged out!";
        }
        return view('/about', $data1);
    }

//to show about page    
    public function allow() {
        return view('/about');
    }

//to show welcome page    
    public function visible(Request $request) {
        return view('/welcome');
    }

//to add data    
    public function store(Request $request) {
        $task = $request->note;
        $objTask = new task();
        $objTask->note = $task;
        $objTask->save();
        return Response::json(['success' => true]);
    }

//to show data    
    public function show(Request $request) {
        $id = $request->id;
        $task = task::find($id);
        return response()->json($task);
    }

    public function edit($id) {
        
    }

//to update data   
    public function upToDate(Request $request, $id) {
        if (isset($request->note) && !empty($request->note)) {
            $task = $request->note;
            $edit = task::find($id);
            $edit->note = $task;
            $edit->save();
        } elseif (isset($request->status) && !empty($request->status)) {
            $task = $request->status;
            if ($task == 'To Do') {
                $task = 1;
            } else if ($task == 'In Progress') {
                $task = 2;
            } else if ($task == 'Done') {
                $task = 3;
            } else {
                
            }
            $edit = task::find($id);
            $edit->status = $task;
            $edit->save();
        } else {
            
        }
        return Response::json(['success' => true]);
    }

//to get data  && search   
    public function Listing(Request $request) {
        $totalDataLimit = isset($request->totalDataLimit) && !empty($request->totalDataLimit) ?
                $request->totalDataLimit : 5;
        if (isset($request->search) && !empty($request->search)) {
            $searchField = $request->search;
            $tasks = DB::table('tasks')->where('note', $searchField)->paginate($totalDataLimit);
        } else if (isset($request->status) && !empty($request->status)) {
            $statusField = $request->status;
            $tasks = DB::table('tasks')->where('status', $statusField)->paginate($totalDataLimit);
        } else {
            $tasks = DB::table('tasks')->paginate($totalDataLimit);
        }
        return response()->json($tasks);
    }

//to delete data    
    public function destroy($id) {
        $task = task::find($id);
        $task->delete();
        return Response::json(['success' => true]);
    }

//to delete selected data    
    public function deleteAll(Request $request, $id) {
        $id = $request->id;
        DB::table("tasks")->whereIn('id', explode(",", $id))->delete();
        return response()->json(['success' => "Tasks Deleted successfully."]);
    }

//to send mail
    public function send(Request $request) {
        $title = 'password reset';
        $content = 'we got a request to reset your password';
        $email = $request->email;
        $mail = Mail::send('/forgotten_password', ['title' => $title, 'content' => $content], function ($message) {
                    $message->from('me@gmail.com', 'Puja Das');

                    $message->to('puja.das@cispl.biz');
                });
        return Response::json(['success' => true, 'message' => 'Request completed']);
    }

//to update password    
    public function latest(Request $request) {
        $username = $request->username;
        $password = Hash::make($request->password);
        $confirmPassword = Hash::make($request->confirmPassword);
        $newPassword = DB::table("users")->where('username', $username)->update(['password' => $password, 'password_confirmation' => $confirmPassword]);
        return Response::json(['success' => true]);
    }

}
