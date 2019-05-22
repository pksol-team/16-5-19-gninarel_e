@extends('frontend.template.layout_auth')
@section('title') <?= $title; ?> @stop
@section('content')

<div class="form-box">
   <form name="loginform" id="loginform" method="POST" action="{{ lang_url('forgot_send_email') }}" class="loginform">
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
      <p class="login-submit">
         <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Send Password Reset Link"><br>
      </p>
      <p>Login instead?<a class="fusion-modal-text-link forgot" href="{{ lang_url('userlogin') }}">Sign In</a></p>
   </form>
</div>

@stop