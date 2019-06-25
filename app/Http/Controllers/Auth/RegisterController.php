<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Personal\Real\RegisterRequest;
use App\Phone;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
     * Where to redirect users after registration.
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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.login');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user =  User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $real = $user->real()->create([
            'last_name'     => $data['last_name'],
            'first_name'    => $data['first_name'],
            'gender'        => $data['gender'],
            'birth'         => $data['birth'],
        ]);


        $mobile = Phone::create([
            'phone'     => $data['mobile']
        ]);

        $mobile->reals()->attach($real->id,['default' => true]);

        return $user;

    }

    /**
     * Handle a registration request for the application.
     *
     * @param RegisterRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

}
