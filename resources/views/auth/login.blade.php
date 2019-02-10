@extends('layouts.web.master.master_2')
@section('content')
<h3 class="tittle-agileits-w3layouts" style="text-align: center;margin-top: 20px;">Login</span></h3>
    <div class="w3ls-login box box-big" style="margin-bottom: 50px">
        <!-- form starts here -->
        <form action="{{ route('login') }}" method="post">
          @csrf
            <div class="agile-field-txt">
                <label>email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Your Email" required="" />
                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
            </div>
            <div class="agile-field-txt">
                <label>password</label>
                <input id="password" type="password" name="password" placeholder="Enter Password" required="" />
                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                <div class="agile_label">
                    <input id="check3" name="check3" type="checkbox" value="show password" onclick="myFunction()">
                    <label class="check" for="check3">Show password</label>
                </div>

                @if (Route::has('password.request'))
                <div class="agile-right">
                    <a href="{{ route('password.request') }}">forgot password?</a>
                </div>
                @endif
            </div>
            <div class="w3ls-bot">
                <div class="switch-agileits">
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                        keep me signed in
                    </label>
                </div>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
@endsection
