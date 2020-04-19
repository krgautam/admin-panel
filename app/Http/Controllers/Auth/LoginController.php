<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginApi(Request $request)
{
    $this->validateLogin($request);

    if ($this->attemptLogin($request)) {
        $user = $this->guard()->user();
        if(empty($user->api_token)){
        $user->generateToken();
        }
        return response()->json([
            'data' => $user->toArray(),
        ]);
    }

    return $this->sendFailedLoginResponse($request);
}
public function logoutApi(Request $request)
{
    $user = Auth::guard('api')->user();

    if ($user) {
        $user->api_token = null;
        $user->save();
    }

    return response()->json(['data' => 'User logged out.'], 200);
}
protected function credentials(Request $request)
{
    if(is_numeric($request->get('email'))){
        return ['mobile'=>$request->get('email'),'password'=>$request->get('password')];
    }
    return $request->only($this->username(), 'password');
}
}
