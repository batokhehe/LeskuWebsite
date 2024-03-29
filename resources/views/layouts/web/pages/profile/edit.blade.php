@extends('layouts.web.master.master_2')
@section('content')
<div class="container">
        <div class="row" style="margin-bottom: 40px;">
            <div class="col-md-4">
                <div class="profile-card-4 z-depth-3" style="border-top-left-radius: 20px;border-top-right-radius: 20px;">
                    <div class="card">
                        <div class="card-body text-center bg-primary rounded-top">
                            <div class="user-box">
                                <img src="http://bootdey.com/img/Content/avatar/avatar7.png" alt="user avatar">
                            </div>
                            <h5 class="mb-1 text-white">{{ Auth::user()->username }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group shadow-none">
                                <li class="list-group-item">
                                    <div class="list-icon">
                                        <i class="fa fa-phone-square"></i>
                                    </div>
                                    <div class="list-details">
                                        <span>{{ $teacher->phone_number }}</span>
                                        <small>Mobile Number</small>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="list-icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="list-details">
                                        <span>{{ $teacher->email }}</span>
                                        <small>Email Address</small>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="list-icon">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <div class="list-details">
                                        <span>{{ $teacher->graduated }}</span>
                                        <small>Study</small>
                                    </div>
                                </li>
                            </ul>
                            <div class="row text-center mt-4">
                                <div class="col-md-4">
                                    <h4 class="mb-1 line-height-5">25</h4>
                                    <small class="mb-0 font-weight-bold">Projects</small>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="mb-1 line-height-5">20</h4>
                                    <small class="mb-0 font-weight-bold">Accept</small>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="mb-1 line-height-5">5</h4>
                                    <small class="mb-0 font-weight-bold">Reject</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card z-depth-3" style="border-top-left-radius: 20px;border-top-right-radius: 20px;">
                    <div class="card-body">
                        <ul class="nav nav-pills nav-pills-primary nav-justified">
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link active show"><i
                                        class="icon-note"></i> <span class="hidden-xs">Edit</span></a>
                            </li>
                        </ul>
                        <div class="tab-content p-1">
                            <div class="tab-pane active show" id="edit">
                                <form action="{{ url('/' . $module . '/update') }}" method="post" enctype="multipart/form-data">
                                  {{csrf_field()}}
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Change Photo</label>
                                        <div class="col-lg-9">
                                            <!-- <input class="form-control" type="file" name="image" value="{{ $teacher->image }}"> -->
                                            <input type="file" id="inputimage" name="image" class="validate"/ >
                                            <img src="{{ url('img/teacher_profile/'.$teacher->image) }}" id="showimage">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Full Name</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="name" value="{{ $teacher->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Date of Birth</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" id="datepicker" type="text" name="date_of_birth" value="{{ $teacher->date_of_birth }}" data-date-format='yyyy-mm-dd'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="email" name="email" value="{{ $teacher->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Phone Number</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text"  name="phone_number" value="{{ $teacher->phone_number }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Study</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="graduated">
                                                <option value="" disabled="">Select Study</option>
                                                <option value="D3" <?php echo $teacher->graduated == 'D3' ? 'selected' : '' ?>>D3</option>
                                                <option value="S1" <?php echo $teacher->graduated == 'S1' ? 'selected' : '' ?>>S1</option>
                                                <option value="S2" <?php echo $teacher->graduated == 'S2' ? 'selected' : '' ?>>S2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Major</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="major" value="{{ $teacher->major }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Study Level</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="studylevel[]" id="studylevel" multiple="multiple">
                                              @foreach($study_levels->all() as $study_level)
                                                <option value="{{ $study_level->id }}"
                                                @foreach($teacher_study_levels as $teacher_study_level)
                                                        @if ($study_level->id == $teacher_study_level->study_level_id)
                                                        selected=""
                                                        @endif
                                                @endforeach
                                                    >{{ $study_level->name . ' ' . $study_level->description }}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Subjects</label>
                                        <div class="col-lg-9">
                                            <select class="form-control select2" name="subject[]" id="subject" multiple="multiple">
                                            @foreach($subjects->all() as $subject)
                                                <option value="{{ $subject->id }}"
                                                @foreach($teacher_subjects as $teacher_subject)
                                                        @if ($subject->id == $teacher_subject->subject_id)
                                                        selected=""
                                                        @endif
                                                @endforeach
                                                    >{{ $subject->name }}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="address" value="{{ $teacher->address }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">ID Card</label>
                                        <div class="col-lg-9">
                                            <!-- <input class="form-control" type="file" name="id_card" value="{{ $teacher->id_card }}"> -->
                                            <input type="file" id="inputid" name="id_card" class="validate" accept=".jpeg, .jpg, .png" />
                                            <img src="{{ url('doc/id/'.$teacher->id_card) }}" id="showid">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Curriculum Vitae</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" id="inputcv" type="file" name="cv_file" value="{{ $teacher->cv_file }}" accept=".jpeg, .jpg, .png, .pdf">
                                            <img id="cv_blank" src="{{ url('doc/blank_pdf.png') }}" width="100px"
                                            <?php echo $teacher->cv_file != '' ? 'style="display: none;"' : '' ?>
                                             />
                                            <iframe src="{{ url('doc/cv/' . $teacher->cv_file) }} ?>" frameborder="0" style="width:100%;min-height:320px;
                                            <?php echo $teacher->cv_file != '' ? '' : 'display: none;' ?>"
                                            id="showcv"></iframe>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Ijazah & Transkrip Nilai</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" id="inputcertificate" type="file" name="certificate" value="{{ $teacher->certificate }}" accept=".jpeg, .jpg, .png, .pdf">
                                            <img id="certificate_blank" src="{{ url('doc/blank_pdf.png') }}" width="100px"
                                            <?php echo $teacher->certificate != '' ? 'style="display: none;"' : '' ?>
                                             />
                                            <iframe src="{{ url('doc/certificate/' . $teacher->certificate) }}" frameborder="0" style="width:100%;min-height:320px;
                                            <?php echo $teacher->certificate != '' ? '' : 'display: none;' ?>"
                                            id="showcertificate"></iframe>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <a href="/profile" type="button" class="btn btn-danger">Cancel</a>
                                            <input type="submit" class="btn btn-primary" value="Save Changes">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
@endsection
