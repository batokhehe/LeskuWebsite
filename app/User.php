<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'group_id','type', 'password' ,'status', 'app_img', 'app_firebase_id', 'app_token', 'activation_code', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function update_token($data, $id){
        $user = User::where('id', $id)->update($data);

        return $user;
    }
    public function getAll()
    {
      $users = User::whereNull('deleted_at')->get();
      return $users;
    }

    public function getAllTeacher()
    {
      $users = User::whereNull('deleted_at')->where('type','1')->get();
      return $users;
    }

  public function find($id)
  {
    $users = User::where('id', $id)->first();
    return $users;
  }

  public function update($data = array(), $id = NULL)
  {
    $users = User::where('id', $id)->update($data);
    return $users;
  }

  public function softDelete($data = array(), $id = NULL)
  {
    $users = User::where('id', $id)->update($data);
    return $users;
  }
}
