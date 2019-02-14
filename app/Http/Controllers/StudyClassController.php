<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyClass;
use Validator;

class StudyClassController extends Controller
{
    // private $module = '';

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
      $data = $study_classes->update($data, $id);

      $module = 'payment_verification';
      return redirect('payment_verification')
              ->with('success', 'Data Updated')
              ->with('module', $module);
    }
}
