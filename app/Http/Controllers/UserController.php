<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    private $module = 'user';

    public function index()
    {
      $users = new User;

      $data = $users->getAllTeacher();
      return view('layouts.admin.pages.user.index')
                ->with('users', $data)
                ->with('module', $this->module);
    }

    public function create()
    {
      return view('layouts.admin.pages.user.create');
    }

    public function store(Request $request)
    {

      $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'username' => 'required',
        'email' => 'required|unique:users',
      ]);

      if ($validator->fails()) {
          return redirect('user/create')
                      ->withErrors($validator)
                      ->withInput();
      }

      $users = new User([
        'first_name' => $request->post('first_name'),
        'last_name' => $request->post('last_name'),
        'username' => $request->post('username'),
        'email' => $request->post('email'),
        'password' => Hash::make('password'),
        'group_id' => '1',
        'status' => '0',
        'type' => '1'
      ]);
      if($users->save()){
        return redirect('user')->with('success', 'Data Added');
      } else {
        return redirect('user/create')->with('danger', 'Data Failed to Add');
      }

      // return redirect()->route('layouts.admin.pages.user.index')->with('success', 'Data Added');
    }

    public function show()
    {

    }

    public function edit($id)
    {
      $users = new User;

      $data = $users->find($id);

      return view('layouts.admin.pages.user.edit')
                ->with('user', $data)
                ->with('module', $this->module);
    }

    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'username' => 'required',
        'status' => 'active',
        // 'email' => 'required|unique:users',
      ]);

      if ($validator->fails()) {
          return redirect($this->module . '/edit/' . $id)
                      ->withErrors($validator)
                      ->withInput();
      }

      $users = new User;
      $data = array(
        'first_name' => $request->post('first_name'),
        'last_name' => $request->post('last_name'),
        'username' => $request->post('username'),
        'email' => $request->post('email'),
        'status' => '1',
      );

      $data = $users->update($data, $id);

      return redirect('user')
              ->with('success', 'Data Updated')
              ->with('module', $this->module);;
    }

    public function delete($id)
    {
      $users = new Users;

      $data = array(
        'deleted_at' => now(),
      );

      $result = $users->softDelete($data, $id);

      if($result){
        return redirect('user')
                ->with('success', 'Data Deleted')
                ->with('module', $this->module);
      }
    }
}
