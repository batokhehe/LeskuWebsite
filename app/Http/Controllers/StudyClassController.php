<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyClass;
use App\Student;
use App\StudyClassDetail;
use App\Teacher;
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
      $this->notifications_helper = new NotificationHelper();
      $this->user_mdl = new User;
    }

    public function index()
    {
      $data = $this->study_class_mdl->paymentVerification();

      $module = 'payment_verification';
      return view('layouts.admin.pages.payment_verification.index')
              ->with('study_classes', $data)
              ->with('module', $module);
    }

    public function edit($id)
    {
      $header = $this->study_class_mdl->find($id);
      $details = $this->study_class_mdl->findDetail($header->id);

      $module = 'payment_verification';
      return view('layouts.admin.pages.payment_verification.edit')
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
        $data_student = array(
                        'balance' => $study_class->ordered_assembly * 100
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
}
