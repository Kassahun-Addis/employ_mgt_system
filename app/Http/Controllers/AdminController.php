<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{

    //show all//
    public function index(){
        return view('index');
    }

    //home page//
    public function home(){
        return view('index3');
        }


        //about page//
    public function about(){
        return view('about');

        }


        //contact page//
    public function contact(){
        return view('contact');

        }


        //project page//
    public function project(){
        return view('project');

        }


       //service page//
        public function service(){
            return view('service');

        }


        //blog page//
        public function blog(){
                return view('blog');

                }


                //login login page//
    public function login(){
        return view('login');

        }



        // register page//
    public function registers(){
        return view('register');

        }


    // Submit Login page//
    public function submit_login(Request $request){
          $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        $checkAdmin=Admin::where(['username'=>$request->username,'password'=>$request->password])->count();
        if($checkAdmin>0){
            $request->session()->put('username', $request->username);
            return redirect('admin');
        }
        else{
            return redirect('/')->with('msg','Invalid username/password!!');
        }
    }



    ///register///
    public function postRegisters(Request $request)
    {
        $request->validate([

                'username'=>'required',
                'password'=>'required'
        ]);
        $user = new Admin;
        $user->username =$request->username;
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect('/')->with('msg', 'Registration successful. Please login to continue.');
    }

}
