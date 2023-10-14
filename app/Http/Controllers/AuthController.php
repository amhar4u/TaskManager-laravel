<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use Session;

class AuthController extends Controller
{
    public function index(){
        return view('Auth.login');
    }

    public function register(){
        return view('Auth.register');
    }

    public function postRegistration(Request $request){

        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password'=>'required|min:6',
            'confirmPassword' => 'required|same:password'
        ]);
        $data = $request->all();
        $createUser = $this->create($data);
        return redirect('login')->withSuccess('You Are Registered Successfully');

    }

    public function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'confirmPassword' => $data['confirmPassword']
        ]);
    }

    public function postLogin(Request $request){
        $request->validate([
            
            'email'=> 'required|email',
            'password'=>'required'
            
        ]);
        $checkLogin = $request -> only('email','password');
        if(Auth::attempt($checkLogin)){
            return redirect('index')->withSuccess('Login Successfully');
        }
        return redirect('login')->withSuccess('Login Failed. Inavalid Credintials');
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    public function home()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $tasks = Task::where('user_email', $user->email)->get(); // Retrieve tasks associated with the user.
            return view('index', ['tasks' => $tasks]);
        }
        return redirect('login')->with('error', 'Please log in to access the home page.')->withInput();
    }
    
    
    
}
