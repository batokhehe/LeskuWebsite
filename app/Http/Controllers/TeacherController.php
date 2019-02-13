<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Subject;
use App\StudyLevel;
use Validator;
use Auth;

class TeacherController extends Controller
{
  private $module = 'profile';

  public function index()
  {
    $teachers = new Teacher;
    $subject = new Subject;
    // $studylevel = new StudyLevel;

    $id = Auth::user()->id;
    // $data = $teachers->where('user_id', $id)->first();
    $data = $teachers->findData($id);
    return view('layouts.web.pages.profile.index')
            ->with('teacher', $data)
            ->with('subject', $subject->all())
            // ->with('studylevel', $studylevel->all())
            ->with('module', $this->module);
  }

  public function create()
  {
    return view('layouts.web.pages.profile.create');
  }

  public function store(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'address' => 'required',
      'email' => 'required',
      'phone_number' => 'required',
      'graduated' => 'required',
      'subject' => 'required',
      'image' => 'required',
      'cv_file' => 'required',
      'certificate' => 'required'
    ]);

    if ($validator->fails()) {
        return redirect('profile/create')
                    ->withErrors($validator)
                    ->withInput();
    }

    $teachers = new Teacher([
      'name' => $request->post('name'),
      'address' => $request->post('address'),
      'email' => $request->post('email'),
      'phone_number' => $request->post('phone_number'),
      'graduated' => $request->post('graduated'),
      'image' => $request->post('image'),
      'cv_file' => $request->post('cv_file'),
      'certificate' => $request->post('certificate'),
      'user_id' => '1'
    ]);
    if($teachers->save()){
      return redirect('/profile')->with('success', 'Data Added');
    } else {
      return redirect('/register')->with('danger', 'Data Failed to Add');
    }
  }
  public function show()
  {

  }

  public function edit()
  {
    $teachers = new Teacher;
    $subjects = new Subject;
    // $study_levels = new StudyLevel;

    $id = Auth::user()->id;
    // $data = $teachers->where('user_id', $id)->first();
    $data = $teachers->findData($id);
    return view('layouts.web.pages.profile.edit')
            ->with('teacher', $data)
            ->with('subjects', $subjects)
            // ->with('study_levels', $study_levels)
            ->with('module', $this->module);
  }

  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'address' => 'required',
      'email' => 'required',
      'phone_number' => 'required',
      'graduated' => 'required',
      'image' => 'required',
      'id_card' => 'required',
      'cv_file' => 'required',
      'certificate' => 'required'
    ]);

    if ($validator->fails()) {
        return redirect($this->module . '/edit')
                    ->withErrors($validator)
                    ->withInput();
    }

    $teachers = new Teacher;
    $id = Auth::user()->id;

          $image       = $request->file('image');
          $imagename   = $image->getClientOriginalName();
          $request->file('image')->move("img/teacher_profile", $imagename);

          $id_card       = $request->file('id_card');
          $id_cardname   = $id_card->getClientOriginalName();
          $request->file('id_card')->move("documents/id", $id_cardname);

          $cv_file       = $request->file('cv_file');
          $cv_filename   = $cv_file->getClientOriginalName();
          $request->file('cv_file')->move("documents/cv", $cv_filename);

          $certificate       = $request->file('certificate');
          $certificatename   = $certificate->getClientOriginalName();
          $request->file('certificate')->move("documents/certificate", $certificatename);

    $data = array(
      'name' => $request->post('name'),
      'address' => $request->post('address'),
      'email' => $request->post('email'),
      'phone_number' => $request->post('phone_number'),
      'graduated' => $request->post('graduated'),
      'cv_file' => $cv_filename,
      'certificate' => $certificatename,
      'image' => $imagename,
      'id_card' => $id_cardname,
      'user_id' => $id
    );

    $data = $teachers->updateData($data, $id);

    return redirect('/profile')
            ->with('success', 'Data Updated')
            ->with('module', $this->module);;
  }

  public function delete($id)
  {
    $teachers = new Teacher;

    $data = array(
      'deleted_at' => now(),
    );

    $result = $teachers->softDelete($data, $id);

    if($result){
      return redirect('profile')
              ->with('success', 'Data Deleted')
              ->with('module', $this->module);
    }
  }
}
