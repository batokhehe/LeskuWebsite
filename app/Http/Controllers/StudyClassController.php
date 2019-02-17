<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyClass;
use App\Notifications\NotificationHelper; 
use Validator;

class StudyClassController extends Controller
{
    // private $module = '';
    public function __construct()
    {
      $this->notifications_helper = new NotificationHelper();
    }

    Public function index()
    {
      $study_classes = new StudyClass;

      $module = 'payment_verification';

      $data = $study_classes->paymentVerification();
      return view('layouts.admin.pages.payment_verification.index')
              ->with('study_classes', $data)
              ->with('module', $module);
    }

    public function edit($id)
    {
      $study_classes = new StudyClass;

      $header = $study_classes->find($id);
      $details = $study_classes->findDetail($header->id);

      $module = 'payment_verification';

      return view('layouts.admin.pages.payment_verification.edit')
                ->with('header', $header)
                ->with('details', $details)
                ->with('module', $module);
    }

    public function update($id)
    {
      $study_classes = new StudyClass;
      $data = array(
        'status' => '2',
      );
      $result = $study_classes->update($data, $id);

      // if($result){
      //   $study_class_detail = new StudyClassDetail;
      //   $data = $study_class_detail->where('study_class_id', $id);
      //   $this->notifications_helper($user_firebase_id, $title, $multiple_type, $type);
      // }

      $module = 'payment_verification';
      return redirect('payment_verification')
              ->with('success', 'Data Updated')
              ->with('module', $module);
    }
}
