<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $maxLoginAttempts=4;

    protected $lockoutTime=300;


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message=[
            'name.required'=>'لطفا نام خود را وارد نمایید',
            'fname.required'=>'لطفا نام خانوادگی خود را وارد نمایید',
            'email.required'=>'لطفا ایمیل خود را وارد نمایید',
            'email.email'=>'ایمیل وارد شده معتبر نمی باشد',
            'email.unique'=>'ایمیل وارد شده قبلا ثبت شده است',
            'password.required'=>'لطفا کلمه عبور خود را وارد نمایید',
            'password.min'=>'کلمه عبور حداقل باید شامل 6 کارکتر باشد',
            'password_confirmation.required'=>'لطفا تکرار کلمه عبور را وارد نمایید',
            'password_confirmation.same'=>'تکرار کلمه عبور مطابقت ندارد'
        ];
        return Validator::make($data,[
            'name' => 'required|max:255',
            'fname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'password_confirmation'=>'required|same:password'
        ],$message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'fname'=>$data['fname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role'=>'user'
        ]);
    }
    public function adminlogin()
    {
       return View('admin.login');
    }
}
