<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
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
    protected $redirectTo = '/profile/edit';

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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
      $users = User::create([
          'first_name' => $data['first_name'],
          'last_name' => $data['last_name'],
          'username' => $data['username'],
          'email' => $data['email'],
          'password' => Hash::make($data['password']),
          'group_id' => '1',
          'type' => '1',
          'status' => '1',
      ]);

      $user_id = $users->id;

      if($users && $user_id){
        $teacher = new Teacher([
          'name' => $data['first_name'] . ' ' . $data['last_name'],
          'address' => ' ',
          'email' => $data['email'],
          'phone_number' => ' ',
          'graduated' => ' ',
          'image' => ' ',
          'cv_file' => ' ',
          'certificate' => ' ',
          'id_card' => ' ',
          'user_id' => $user_id
        ]);
        $teacher->save();
      }

      return $users;
    }

    
}
