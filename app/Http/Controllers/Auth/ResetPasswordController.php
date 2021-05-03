<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Illuminate\Auth\Events\PasswordReset;
use App\User;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null){
        
        $email = $request->email;

        if (!$token)
          return Redirect::intended('home')->withErrors(['fail' => 'With out Reset Token']);

      if (!$email)
          return Redirect::intended('home')->withErrors(['fail' => 'With out Reset Email']);

      $reset = DB::table('password_resets')->where('email',  $email)->first();

      if (!$reset)
         return Redirect::intended('home')->withErrors(['fail' => 'With out Reset Data']);

     $expiry  = Carbon::now()->subMinutes( 60 );

     if ($reset->created_at <= $expiry) {
         return Redirect::intended('home')->withErrors(['fail' => 'Expired Reset Data']);
     }

     if(Hash::check($token, $reset->token) != 1){
        return Redirect::intended('home')->withErrors(['fail' => 'Invalid Reset Token']);
    }
    
    return view('auth.passwords_reset')->with(
     ['token' => $token, 'email' => $request->email]
 ); 
}

public function ResetPassword(Request $request){

    $email = $request->email;
    $token = $request->token;
    if (!$token)
      return Redirect::back()->withErrors(['fail' => 'With out Reset Token']);

  if (!$email)
      return Redirect::back()->withErrors(['fail' => 'With out Reset Email']);

  $reset = DB::table('password_resets')->where('email',  $email)->first();

  if (!$reset)
     return Redirect::back()->withErrors(['fail' => 'With out Reset Data']);

 $expiry  = Carbon::now()->subMinutes( 60 );

 if ($reset->created_at <= $expiry) {
     return Redirect::back()->withErrors(['fail' => 'Expired Reset Data']);
 }

 if(Hash::check($token, $reset->token) != 1){
    return Redirect::back()->withErrors(['fail' => 'Invalid Reset Token']);
}
$user= User::where('users.email', '=', $request->email)
->first();
$user->password = bcrypt($request->get('new_password'));
$user->save();
return Redirect::intended('home')->with('success', 'Reset success');   
}
}
