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
use App\mail\NewMenber;
use App\mail\NewMenberToAdmin;
use Illuminate\Support\Facades\Mail;
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
             'mobile' => 'bail|required',

        ]);



        if ($validator->passes()) {

            $old_user= User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.email', '=', $request->email)
            ->select('users.*','roles.name as roles')
            ->first();

            if(isset($old_user->id)){
              return redirect()->back()->withErrors(['fail' => 'Email already exists']);
              exit();
          }else{

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



            $data['name'] =$find_user->name;
            $data['email'] =$find_user->email;
            $data['id'] =$find_user->id;
            $data['created_at'] =$find_user->created_at;
            $data['mobile'] =$find_user->mobile;

            Mail::to($find_user->email)->queue(new NewMenber($data));
            Mail::to('info@cms.com.hk')->queue(new NewMenberToAdmin($data));
/*
            \Mail::send('emails.visitor_email', $offer = ['name' => $find_user->name, 'email' => $find_user->email], function ($message) use ($offer) {
                $message->to($offer['email'])->subject('Hi '.$offer['name'].' The Eyes Crafters Welcome You !');
            });

            \Mail::send('emails.to_admin_new_email', $admin_offer = ['name' => $find_user->name, 'email' => $find_user->email,'id'=>$find_user->id,'created_at'=>$find_user->created_at,'mobile'=>$find_user->mobile], function ($message) use ($admin_offer) {
                $message->to('info@cms.com.hk')->subject('New Member '.$admin_offer['name'].'('.$admin_offer['email'].')  Registration');
            });
*/
            return redirect()->back()->with('success', 'Login success');   
        }

        return back()->with(["status" => "success", "message" => "User Created!"]);
}

    }else{
        return Redirect::to('home')
        ->withErrors($validator)
        ->withInput();

    }


}


public function logout()
{
 Auth::logout();
 return Redirect::to('home');
}

}
