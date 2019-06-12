@extends('frontend.template.layout_auth')
@section('title') <?= $title; ?> @stop
@section('content')

<div class="form-box">
   <p>Members Register</p>
   <form name="regform" id="regform" action="{{ lang_url('register_check') }}" method="post">
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
      <p class="username">
         <label for="name">Name:</label><br>
         <input type="text" name="name" class="input" value="{{ old('name') }}" size="20" required>
      </p>
      <p class="email">
         <label for="email">Email:</label><br>
         <input type="email" name="email" id="email" class="input" value="{{ old('email') }}" required>
      </p>
      <p class="phone">
         <label for="phone">Phone Number:</label><br>
         <input type="text" name="phone" id="phone" class="input" value="{{ old('phone') }}" size="20" required>
      </p>
      <p class="password">
         <label for="password">Password:</label><br>
         <input type="password" name="password" id="password" class="input" value="{{ old('password') }}" size="20" required>
      </p>
      <p class="login-submit">
         <input type="submit" id="register-submit" class="button button-primary" value="Register"><br>
      </p>
      <hr class="sep-shadow">
      <div class="fusion-text dont-account">
         <p class="text-center"><span>Already registered? <a href="{{ lang_url('userlogin') }}">Log In</a></span></p>
      </div>
   </form>
</div>

@stop