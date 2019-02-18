<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Subject;
use App\StudyLevel;
use App\TeacherStudyLevel;
use App\TeacherSubject;
use App\Exports\TeacherScheduleExport;
use App\Imports\TeacherScheduleImport;
use Validator;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

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
    $study_levels = new StudyLevel;

    $id = Auth::user()->id;
    $teacher_mdl = new Teacher;
    $teacher_subject_mdl = new TeacherSubject;
    $teacher_study_level_mdl = new TeacherStudyLevel;
    $teacher = $teacher_mdl->where('user_id', $id)->first();
    $teacher_subjects = $teacher_subject_mdl->where('teacher_id', $teacher->id)->get();
    $teacher_study_levels = $teacher_study_level_mdl->where('teacher_id', $teacher->id)->get();
    // $data = $teachers->where('user_id', $id)->first();
    $data = $teachers->findData($id);
    return view('layouts.web.pages.profile.edit')
            ->with('teacher', $data)
            ->with('subjects', $subjects)
            ->with('teacher_subjects', $teacher_subjects)
            ->with('study_levels', $study_levels)
            ->with('teacher_study_levels', $teacher_study_levels)
            ->with('module', $this->module);
  }

  public function update(Request $request)
  {
    $teacher_mdl = new Teacher;
    $teacher_study_level_mdl = new TeacherStudyLevel;
    $teacher_subject_mdl = new TeacherSubject;
    $id = Auth::user()->id;
    $teacher = $teacher_mdl->where('user_id', $id)->first();

    if($teacher->image != ''){
      $form['image'] = 'required';
    }
    if($teacher->cv_file != ''){
      $form['cv_file'] = 'required';
    }
    if($teacher->id_card != ''){
      $form['id_card'] = 'required';
    }
    if($teacher->certificate != ''){
      $form['certificate'] = 'required';
    }
    $form = array(
      'name' => 'required',
      'address' => 'required',
      'email' => 'required',
      'phone_number' => 'required',
      'graduated' => 'required',
    );
    $validator = Validator::make($request->all(), $form);

    if ($validator->fails()) {
        return redirect($this->module . '/edit')
                    ->withErrors($validator)
                    ->withInput();
    }

          $image       = $request->file('image');
          if($image){
            $imagename   = $image->getClientOriginalName();
            $request->file('image')->move("img/teacher_profile", $imagename);
          }

          $id_card       = $request->file('id_card');
          if($id_card){
            $id_cardname   = $id_card->getClientOriginalName();
            $request->file('id_card')->move("doc/id", $id_cardname);
          }
          
          $cv_file       = $request->file('cv_file');
          if($cv_file){
            $cv_filename   = $cv_file->getClientOriginalName();
            $request->file('cv_file')->move("doc/cv", $cv_filename);
          }

          $certificate       = $request->file('certificate');
          if($certificate){
            $certificatename   = $certificate->getClientOriginalName();
            $request->file('certificate')->move("doc/certificate", $certificatename);
          }

    $data = array(
      'name' => $request->post('name'),
      'date_of_birth' => $request->post('date_of_birth'),
      'address' => $request->post('address'),
      'email' => $request->post('email'),
      'phone_number' => $request->post('phone_number'),
      'graduated' => $request->post('graduated'),
      'major' => $request->post('major'),
      'user_id' => $id
    );

    if($image){
      $data['image'] = $imagename;
    }
    if($cv_file){
      $data['cv_file'] = $cv_filename;
    }
    if($id_card ){
      $data['id_card'] = $id_cardname;
    }
    if($certificate){
      $data['certificate'] = $certificatename;
    }

    $result = $teacher_mdl->updateData($data, $id);

    if($result){
      foreach ($request->post('studylevel') as $key => $value) {
        $teacherstudylevel[] = array(
          'teacher_id' => $teacher->id, 
          'study_level_id' => $value,
        ); 
      }
      $teacher_study_level_mdl->where('teacher_id', $teacher->id)->delete();
      $teacher_study_level_mdl->insert($teacherstudylevel);

      foreach ($request->post('subject') as $key => $value) {
        $teachersubject[] = array(
          'teacher_id' => $teacher->id, 
          'subject_id' => $value,
        ); 
      }
      $teacher_subject_mdl->where('teacher_id', $teacher->id)->delete();
      $teacher_subject_mdl->insert($teachersubject);
    }

    return redirect('/profile')
            ->with('success', 'Data Updated')
            ->with('module', $this->module);
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

  public function importFile(Request $request){
    if($request->hasFile('import_schedule')){
      $path = $request->file('import_schedule')->getRealPath();
      Excel::import(new TeacherScheduleImport, $path);
      return redirect('profile')
            ->with('success', 'Data Deleted')
            ->with('module', $this->module);
    }   
  } 

  public function exportFile($type){
    // $products = Product::get()->toArray();
    return Excel::download(new TeacherScheduleExport, 'schedule_template.xlsx');
  }
}
