<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\company;
use Illuminate\Http\Request;

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
        // $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', 'string', 'in:staff,audit,manager,md'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'company' => ['required', 'exists:company,id'],
            'company_approver' => ['required', 'array'],
            'company_approver.*' => ['exists:company,id'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $price = 0;
        if (in_array($data['role'], ['audit', 'manager', 'md'])) {
            $price = 5000;
        }

        return User::create([
            'name' => $data['name'],
            'full_name' => $data['full_name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'password_plain' => $data['password'],
            'role' => $data['role'],
            'price' => $price,
            'email' => $data['email'],
            'company' => $data['company'],
            'company_approver' => implode(',', $data['company_approver']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return redirect()->back()->with('success', 'สร้างบัญชีเรียบร้อยแล้ว');
    }

    public function showRegistrationForm()
    {
        $companies = company::all();
        return view('auth.register', compact('companies'));
    }
}
