<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:32',
            'email' => 'required|email|max:255|unique:account',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Account
     */
    protected function create(array $data)
    {
        $pwuser = strtoupper($data['name']);
        $pwpw = strtoupper($data['password']);
        $pwstr = $pwuser . ":" . $pwpw;

        $password = strtoupper(sha1($pwstr));
        return Account::create([
            'username' => $data['name'],
            'email' => $data['email'],
            'sha_pass_hash' => $password,
            'last_login' => '1970-12-31 00:00:00'
        ]);
    }
}
