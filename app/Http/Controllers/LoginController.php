<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use App\AskingQuery;
use App\User;
use DB;
use Redirect;
use Auth;
use View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Input;
class LoginController extends Controller {

    public function show()
    {
    return View::make('admin.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|email',
            'password' => 'bail|required',
        ]);

        if ($validator->passes()) {
            $attempt = Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ]);

            if ($attempt) {
				
				$find_user= User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
                ->where('users.email', '=', $request->email)
                ->select('users.*','roles.name as roles')
                ->first();
				
                return redirect()->back()->with('success', 'Login success');   
            }

           return redirect()->back()->withErrors(['fail' => 'Username or password is wrong']);
        }

        //fail
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            //;
        }
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|email',
            'password' => 'bail|required',
         
        ]);

        if ($validator->passes()) {
            $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
             'avatar' => 'users/default.png',
             'created_at' => date("Y-m-d H:i:s"),
             'updated_at' => date("Y-m-d H:i:s"),
             'mobile' => $request->input('mobile'),

        ]);
       
            $attempt = Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ]);

            if ($attempt) {
                
                $find_user= User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
                ->where('users.email', '=', $request->email)
                ->select('users.*','roles.name as roles')
                ->first();
                
                return redirect()->back()->with('success', 'Login success');   
            }

     return back()->with(["status" => "success", "message" => "User Created!"]);


        }else{

           
            return Redirect::to('home')
                ->withErrors($validator)
                ->withInput();
            //;
        

            return Redirect::to('login')
                ->withErrors(['home' => 'Email or password is wrong']);
        }

       
    }


    public function logout()
    {
	Auth::logout();
    return Redirect::to('home');
    }

}
