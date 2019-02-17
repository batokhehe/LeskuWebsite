<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyClass;
use App\Student;
use App\StudyClassDetail;
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
        $dataStudent = array(
                        'balance' => $study_class->ordered_assembly * 100
                      );
        $resultStudent = $this->student_mdl->where('user_id', $study_class->user_id)->update($dataStudent);
        $user = $this->user_mdl->where('user_id', $study_class->user_id)->first();

        // $study_class_detail = new StudyClassDetail;
        // $data = $study_class_detail->where('study_class_id', $id);
        $this->notifications_helper->send_to_specific_user($user->firebase_app_id, 'Pemesanan telah diverfikasi', 0, 0);
      }

      $module = 'payment_verification';
      return redirect('payment_verification')
              ->with('success', 'Data Updated')
              ->with('module', $module);
    }
}
