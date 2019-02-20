<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyClass;
use App\Student;
use App\StudyClassDetail;
use App\Teacher;
use App\TeacherSchedule;
use App\User;
use App\Notifications\NotificationHelper; 
use Validator;

class StudyClassController extends Controller
{
    // private $module = '';
    public function __construct()
    {
      $this->student_mdl = new Student;
      $this->study_class_mdl = new StudyClass;
      $this->study_class_detail_mdl = new StudyClassDetail;
      $this->teacher_mdl = new Teacher;
      $this->teacher_schedule_mdl = new TeacherSchedule;
      $this->notifications_helper = new NotificationHelper();
      $this->user_mdl = new User;
    }

    public function index()
    {
      $data = $this->study_class_mdl->payment_verification();

      $module = 'payment_verification';
      return view('layouts.admin.pages.payment_verification.index')
              ->with('study_classes', $data)
              ->with('module', $module);
    }

    public function index_change_teacher()
    {
      $data = $this->study_class_mdl->change_teacher();

      $module = 'change_teacher';
      return view('layouts.admin.pages.change_teacher.index')
              ->with('study_classes', $data)
              ->with('module', $module);
    }

    public function index_reschedule()
    {
      $data = $this->study_class_mdl->reschedule();

      $module = 'reschedule';
      return view('layouts.admin.pages.reschedule.index')
              ->with('study_classes', $data)
              ->with('module', $module);
    }

    public function edit($id)
    {
      $header = $this->study_class_mdl->find($id);
      $details = $this->study_class_mdl->find_detail($header->id);

      $module = 'payment_verification';
      return view('layouts.admin.pages.payment_verification.edit')
                ->with('header', $header)
                ->with('details', $details)
                ->with('module', $module);
    }

    public function change_teacher_edit($id)
    {
      $header = $this->study_class_mdl->find_change_teacher($id);
      $details = $this->teacher_mdl->find_detail_change_teacher($header->study_start_at);

      foreach ($details as $key => $value) {
         $details[$key]['age'] = date_diff(date_create($value->date_of_birth), date_create('now'))->y;
      }

      $module = 'change_teacher';
      return view('layouts.admin.pages.change_teacher.edit')
                ->with('header', $header)
                ->with('details', $details)
                ->with('module', $module);
    }

    public function reschedule_edit($id)
    {
      $header = $this->study_class_mdl->find_reschedule($id);
      $details = $this->teacher_schedule_mdl->find_detail_reschedule($header->teacher_id);

      foreach ($details as $key => $value) {
         $details[$key]['age'] = date_diff(date_create($value->date_of_birth), date_create('now'))->y;
      }

      $module = 'reschedule';
      return view('layouts.admin.pages.reschedule.edit')
                ->with('header', $header)
                ->with('details', $details)
                ->with('module', $module);
    }

    public function update($id)
    {
      $study_class = $this->study_class_mdl->where('id', $id)->first();

      $data = array(
        'status' => '2',
      );
      $result = $this->study_class_mdl->update($data, $id);

      if($result){
        $student = $this->student_mdl->where('user_id', $study_class->user_id)->first();
        $data_student = array(
                        'balance' => $student->balance + $study_class->ordered_assembly * 100
                      );
        $result_student = $this->student_mdl->where('user_id', $study_class->user_id)->update($data_student);
        $user_student = $this->user_mdl->where('id', $study_class->user_id)->first();

        $study_class_details = $this->study_class_detail_mdl->where('study_class_id', $id)->get();
        foreach ($study_class_details as $key => $value) {
          $teacher = $this->teacher_mdl->where('id', $value->teacher_id)->first();
          $user = $this->user_mdl->where('id', $teacher->user_id)->first();
          $teachers[] = $user->app_firebase_id;
        }

        $this->notifications_helper->send_to_specific_user($teachers, 'Ada pesanan', 1, 1);

        $this->notifications_helper->send_to_specific_user($user_student->app_firebase_id, 'Pemesanan telah diverifikasi', 0, 0);
      }

      $module = 'payment_verification';
      return redirect('payment_verification')
              ->with('success', 'Data Updated')
              ->with('module', $module);
    }

    public function change_teacher_update(Request $request, $id)
    {
      $study_class_detail = $this->study_class_detail_mdl->where('id', $id)->first();

      $teacher_schedule_data = array(
        'status' => '3',
      );      
      $teacher_schedule = $this->teacher_schedule_mdl->where('teacher_id', $study_class_detail->teacher_id)->where('schedule_date', $study_class_detail->study_start_at)->update($teacher_schedule_data);

      // echo $request->teacher;

      $study_class_detail_data = array(
        'teacher_id' => $request->teacher,
        'status' => '0'
      );
      $result = $this->study_class_detail_mdl->where('id', $study_class_detail->id)->update($study_class_detail_data);

      $teacher_schedule_data = array(
        'status' => '1',
        'study_class_detail_id' => $study_class_detail->id,
      );
      $teacher_schedule = $this->teacher_schedule_mdl->where('teacher_id', $request->teacher)->where('schedule_date', $study_class_detail->study_start_at)->update($teacher_schedule_data);

      $module = 'change_teacher';
      return redirect('change_teacher')
              ->with('success', 'Data Updated')
              ->with('module', $module);
    }
}
