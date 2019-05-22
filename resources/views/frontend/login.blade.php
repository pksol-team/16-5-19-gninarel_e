@extends('frontend.template.layout_auth')
@section('title') <?= $title; ?> @stop
@section('content')

<div class="form-box">
   <p>Members Log In</p>
   <form name="loginform" id="loginform" method="POST" action="{{ lang_url('login_check') }}" class="loginform">
      @csrf
      @if(session()->has('error'))
      <div class="alert alert-red">
         <ul class="list-unstyled mb-0">
            <li class="text-white">{!! session()->get('error') !!}</li>
         </ul>
      </div>
      @endif
      @if(session()->has('message'))
      <div class="alert alert-green">
         <ul class="list-unstyled mb-0">
            <li class="text-white">{!! session()->get('message') !!}</li>
         </ul>
      </div>
      @endif
      <p class="login-username">
         <label for="email">Email:</label><br>
         <input type="email" name="email" id="user_login" class="input" value="{{ old('email') }}" size="100" required>
      </p>
      <p class="login-password">
         <label for="password">Password:</label><br>
         <input type="password" name="password" id="user_pass" class="input" value="{{ old('password') }}" size="20" required>
      </p>
      <p class="login-submit">
         <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Log In"><br>
      </p>
      <p><a class="fusion-modal-text-link forgot" href="{{ lang_url('forgot_password') }}">Forgot Password?</a></p>
      <hr class="sep-shadow">
      <div class="fusion-text dont-account">
         <p class="text-center">Don’t have an active membership..?</p>
         <p class="text-center"><span><a href="{{ lang_url('register') }}">Learn more and sign up here</a></span></p>
      </div>
   </form>
</div>

@stop