<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Spatie\Permission\Models\Role;

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
    protected $redirectTo = '/user';
    protected $default_password;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
        $this->middleware('permission:add user');
        $this->default_password = '12345678';
    }

    /**
     * Show the application registration form (akmal overwrite existing function).
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $password = $this->default_password;
        if (!Auth::user()->hasRole('admin')){
            $rolelist = Role::where('id', '101')->pluck('name','id')->toArray();
            //return dd($rolelist);
        } else {
            //return 0;
            $rolelist = Role::all()->pluck('name','id')->toArray();
        }
        
        return view('auth.register', compact('rolelist','password'));
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
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'digits_between:10,13'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user-role' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $password = $this->default_password;
        
        $user = User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'password' => Hash::make($password),
        ]);

        $user->assignRole($data['user-role']);

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath())->with('success','New user registered');
    }
}
