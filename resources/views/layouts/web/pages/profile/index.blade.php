@extends('layouts.web.master.master_2')
@section('content')
<div class="container">
        <div class="row" style="margin-bottom: 40px;">
          @if(count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
          @endif
          @if(\Session::has('success'))
          <div class="alert alert-success">
            <p>Akun Anda Akan Segera Diaktifkan</p>
          </div>
          @endif
            <div class="col-md-4">

                <div class="profile-card-4 z-depth-3" style="border-top-left-radius: 20px;border-top-right-radius: 20px;">
                    <div class="card">
                        <div class="card-body text-center bg-primary rounded-top">
                            <div class="user-box">
                              <img src="{{ url('image/'.$teacher->image) }}" id="showimage">
                            </div>
                            <h5 class="mb-1 text-white">{{ Auth::user()->username }}</h5>
                            <h6 class="text-light" style="margin-bottom: 40px;">Universitas Indonesia - Pendidikan Biologi</h6>
                            <a href="{{ url('/' . $module . '/edit') }}" type="button" class="btn-sm btn-success"> Edit </a>
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
                        <!-- <div class="card-footer text-center">
                            <a href="javascript:void()" class="btn-social btn-facebook waves-effect waves-light m-1"><i
                                    class="fa fa-facebook"></i></a>
                            <a href="javascript:void()" class="btn-social btn-google-plus waves-effect waves-light m-1"><i
                                    class="fa fa-google-plus"></i></a>
                            <a href="javascript:void()" class="list-inline-item btn-social btn-behance waves-effect waves-light"><i
                                    class="fa fa-behance"></i></a>
                            <a href="javascript:void()" class="list-inline-item btn-social btn-dribbble waves-effect waves-light"><i
                                    class="fa fa-dribbble"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card z-depth-3" style="border-top-left-radius: 20px;border-top-right-radius: 20px;">
                    <div class="card-body">
                        <ul class="nav nav-pills nav-pills-primary nav-justified">
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active show"><i
                                        class="fa fa-user"></i> <span class="hidden-xs">Profile</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i
                                        class="fa fa-envelope"></i> <span class="hidden-xs">Document</span></a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i
                                        class="icon-note"></i> <span class="hidden-xs">Edit</span></a>
                            </li> -->
                        </ul>
                        <div class="tab-content p-3">
                            <div class="tab-pane active show" id="profile">
                                <h3 style="padding: 20px; text-align:center;">Hello {{ Auth::user()->username }}</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <h5 style="padding: 10px;">About</h5>
                                        <p style="padding: 10px;text-align: justify;">
                                            Saya Nella mempunyai kondisi kesehatan yang baik, loyalitas tinggi,
                                            jujur, cepat memahami bidang baru yang sedang
                                            dipelajari/dikerjakan serta, serta memiliki motivasi tinggi
                                        </p> -->
                                        <strong style="padding: 10px;">Address</strong>
                                        <p style="padding: 10px;text-align: justify;">
                                            {{ $teacher->address }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Subjects</strong>
                                        <div>
                                            <a href="javascript:void();" class="badge badge-dark badge-pill">MATEMATIKA
                                                SMA</a>
                                            <a href="javascript:void();" class="badge badge-dark badge-pill">EKONOMI
                                                SMA</a>
                                            <a href="javascript:void();" class="badge badge-dark badge-pill">IPA SMP</a>
                                            <a href="javascript:void();" class="badge badge-dark badge-pill">MATEMATIKA
                                                SMP</a>
                                            <a href="javascript:void();" class="badge badge-dark badge-pill">GEOGRAFI
                                                SMP</a>
                                            <a href="javascript:void();" class="badge badge-dark badge-pill">SOSIOLOGI
                                                SMA</a>
                                            <a href="javascript:void();" class="badge badge-dark badge-pill">AGAMA
                                                ISLAM SMA</a>
                                            <a href="javascript:void();" class="badge badge-dark badge-pill">PENULISAN
                                                KARYA ILMIAH SMA</a>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                      <strong>Performance</strong>
                                      <p>Projects</p>
                                      <div class="progress">
                                          <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"
                                              style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25
                                          </div>
                                      </div>
                                      <p>Accept</p>
                                      <div class="progress">
                                          <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                              style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">20
                                          </div>
                                      </div>
                                      <p>Reject</p>
                                      <div class="progress">
                                          <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                              style="width: 5%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">5
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                        <strong class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span>
                                            Recent Activity</strong>
                                        <table class="table table-hover table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Skell</strong> deleted his post Look at Why this is..
                                                        in
                                                        <strong>`Discussions`</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--/row-->
                            </div>
                            <div class="tab-pane" id="messages">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        <strong>Kartu Tanda Penduduk</strong>
                                        <hr>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <!-- <input type="file" class="custom-file-input" id="inputGroupFile01"> -->
                                                <img src="{{ url('id_card/'.$teacher->id_card) }}" id="showid">
                                            </div>
                                        </div>
                                        <strong>Curriculum vitae</strong>
                                        <hr>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                              <!-- <input class="form-control" id="inputcv" type="file" name="cv_file" value="{{ $teacher->cv_file }}"> -->
                                              <iframe src="{{ url('cv/'.$teacher->cv_file) }}" id="showcv" style="width:640px;min-height:640px;"></iframe>
                                            </div>
                                        </div>
                                        <strong>Ijazah & Transkrip Nilai</strong>
                                        <hr>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <iframe src="{{ url('cv/'.$teacher->cv_file) }}" frameborder="0" id="showcertificate" style="width:640px;min-height:640px;"></iframe>
                                            </div>
                                        </div>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="edit">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">First name</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="Mark">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="Jhonsan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="email" value="mark@example.com">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Change profile</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="file">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Study</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="url" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="" placeholder="Street">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" value="" placeholder="City">
                                        </div>
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" value="" placeholder="State">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="jhonsanmark">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" value="11111122333">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="password" value="11111122333">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="reset" class="btn btn-secondary" value="Cancel">
                                            <input type="button" class="btn btn-primary" value="Save Changes">
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
