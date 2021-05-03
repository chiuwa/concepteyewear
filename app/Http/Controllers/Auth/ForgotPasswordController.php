<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Redirect;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function broker($name = null)
{
    $name = $name ?: $this->getDefaultDriver();
    return $this->brokers[$name] ?? ($this->brokers[$name] = $this->resolve($name));
}
public function getDefaultDriver()
{
  
    // app['config']['auth.defaults.passwords'] == 'user'
    return app()['config']['auth.defaults.passwords'];
}
protected function resolve($name)
{
    // A
    $config = $this->getConfig($name);

    if (is_null($config)) {
        throw new InvalidArgumentException("Password resetter [{$name}] is not defined.");
    }
    // B

    return new PasswordBroker(
        $this->createTokenRepository($config),
        app()['auth']->createUserProvider($config['provider'] ?? null)
    );
}

protected function getConfig($name)
{
    return app()['config']["auth.passwords.{$name}"];
}

    public function sendResetLinkEmail(Request $request)
    {
        
    //驗證輸入的引數
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
        ? $this->sendResetLinkResponse($request, $response)
        : $this->sendResetLinkFailedResponse($request, $response);
    }


    public function sendResetLink(array $credentials)
{
    # A
    $user = $this->getUser($credentials);
    if (is_null($user)) {
        return static::INVALID_USER;
    }
    # B
    $user->sendPasswordResetNotification(
        $this->tokens->create($user)
    );

    return static::RESET_LINK_SENT;
}

protected function sendResetLinkResponse(Request $request, $response)
{
     return Redirect::intended('home')->withErrors(['fail' => 'Check Reset Password Email']);
    //return back()->with('status', trans($response));
}

protected function createTokenRepository(array $config)
    {
        $key = app()['config']['app.key'];

        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

        $connection = $config['connection'] ?? null;

        // 讀取複寫的 DatabaseTokenRepository
        return new DatabaseTokenRepository(
            app()['db']->connection($connection),
            app()['hash'],
            $config['table'],
            $key,
            $config['expire']
        );
   
    }
}
