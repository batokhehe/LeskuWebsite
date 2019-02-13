<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyClass;
use Validator;

class Study_ClassController extends Controller
{
    private $module = 'StudyClass';

    Public function index()
    {
      $study_classes = new StudyClass;

      $data = $study_classes->paymetVerification();
      return view('layouts.admin.pages.payment_verification.index')
              ->with('study_classes', $data)
              ->with('module', $this->module);
    }
}
