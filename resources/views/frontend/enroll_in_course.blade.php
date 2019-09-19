@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-title">
  <a href="#" class="resp-menu" onclick="openNav()">☰</a>
  <div class="row">
    <div class="col-12">
      <div class="our_logo text-center">
        <a href="/"><img src="/frontend/assets/img/logo21.png" alt="" class="logo_black"></a>
        <h4 class="text-center"><span>@t('Enroll in Course: :coursesNative',['coursesNative' =>  $courseNative->name])</span></h4>
        <a href="{{ Auth::check() ? lang_url('profile') : lang_url('userlogin') }}"><button class="btn btn-success btn-lg">{{ Auth::check() ? Auth::user()->name : t('Login') }}</button></a>
      </div>
    </div>
  </div>
</div>
<div class="all-books checkout">
  <form name="checkoutForm" id="checkoutForm" method="POST" action="{{ lang_url('') }}/enroll_form" class="checkoutForm">
    @csrf
    <input type="hidden" class="user_id" name="user_id" value="{{ Auth::check() ? Auth::user()->id : '' }}" />
    <input type="hidden" name="course_id" value="{{ $courseNative->courses->id }}" />

    <div class="row">
      <div class="col-10 order-md-1">
        <div class="row">
          <div class="col-12 mb-3">
            <label for="first_name">@t('Course Price'): <b>{{ $courseNative->courses->price }}</b></label>
          </div>
        </div>
        <?php if (!Auth::check()): ?>
        
        <div class="row">
          <div class="col-12 mb-3">
            <label for="first_name">@t('First name')</label>
            <input type="text" class="form-control" value="{{ old('first_name') }}" id="first_name" name="first_name" placeholder="@t('First name')" required>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <label for="last_name">@t('Last name')</label>
            <input type="text" class="form-control" value="{{ old('last_name') }}" id="last_name" name="last_name" placeholder="@t('Last name')" required>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <label for="mobile_number">@t('Mobile Number')</label>
            <input type="text" class="form-control" value="{{ old('mobile_number') }}" id="mobile_number" name="mobile_number" placeholder="@t('+123-342')" required>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <label for="email">@t('Email')</label>
            <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="example@example.com" required>
          </div>
        </div>
        <?php endif ?>
        
      <div class="row">
        <div class="col-12 mb-3 text-left">
          <button class="btn submmit" type="submit">@t('Proceed')</button>
        </div>
      </div>
      </div>
    </form>
  </div>
  @stop