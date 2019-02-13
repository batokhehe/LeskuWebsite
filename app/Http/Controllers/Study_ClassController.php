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
      // $study_class = new StudyClass;
      //
      // $data = $study_class->getAll();
      return view('layouts.admin.pages.transaction.index');
              // ->with('study_classes', $table2)
              // ->with('module', $this->module);
    }
}
