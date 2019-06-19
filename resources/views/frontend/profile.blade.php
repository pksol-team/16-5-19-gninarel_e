@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo_trans.png" alt="Logo" class="logo_black"></a>
            <h1 class="text-center"><span>Profile</span></h1>
            <div class="elegant-special-heading-wrapper profile-wrapper">
               <p class="special-heading-description">{{ $UserTbl->name }} {{ $UserTbl->last_name }}</p>
              @if(Auth::user()->type != 'coach')
                <div class="text-center">
                  <a href="{{ lang_url('be_a_coach') }}"><button class="btn btn-primary">Apply to be a coach</button></a>
                </div>
              @endif
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-9">
      </div>
   </div>
</div>
<div class="podcast-detail">
<div class="row">
   <div class="col-md-4 podcasting-img-desc user_prof_listing">
      <div class="">
        <ul class="list-unstyled mt-3">
          <li class="active"><a class="d-block" href="{{ lang_url('profile') }}"><i class="fa fa-user-o mr-1 ml-1"></i> Profile</a></li>
          <li class=""><a class="d-block" href="{{ lang_url('all_purchases') }}"><i class="fa fa-shopping-cart mr-1 ml-1"></i> Purchases</a></li>
          <li class=""><a class="d-block" href="{{ lang_url('all_subscriptions') }}"><i class="fa fa-check mr-1 ml-1"></i> Subscription</a></li>
          <li class=""><a class="d-block" href="{{ lang_url('schools') }}"><i class="fa fa-graduation-cap mr-1 ml-1"></i> Electronic School</a></li>
          <li class=""><a class="d-block" href="{{ lang_url('training_activities') }}"><i class="fa fa-tasks mr-1 ml-1"></i> Training Activities</a></li>
          <li class=""><a class="d-block" href="{{ lang_url('communication') }}"><i class="fa fa-address-book-o mr-1 ml-1"></i> Communication</a></li>
          <li class=""><a class="d-block" href="{{ lang_url('logout_frontend') }}"><i class="fa fa-sign-out mr-1 ml-1"></i> Logout</a></li>
        </ul>
      </div>
   </div>
   <div class="col-md-8">
      <div class="">
         <div class="tab-content">
              <br>
             <form class="form profile-form" action="{{ lang_url('update_my_data') }}" method="post" id="updateprofileForm" enctype="multipart/form-data">
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
                <div class="form-group text-center mb-3">
                  <img width="25%" src="\public\storage\{{ $UserTbl->avatar }}" class="avatar rounded-circle border" alt="User Image" height="180">
                </div>
                <div class="form-group">
                   <div class="row">
                      <div class="col-11">
                         <label class="text-dark font-123" for="first_name">
                            <h4>First name</h4>
                         </label>
                         <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="{{ $UserTbl->name }}" title="enter your first name" required>
                      </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                      <div class="col-11">
                         <label class="text-dark font-123" for="last_name">
                            <h4>Last name</h4>
                         </label>
                         <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="{{ $UserTbl->last_name }}"  title="enter your last name" required>
                      </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                      <div class="col-11">
                         <label class="text-dark" for="email">
                            <h4>Email</h4>
                         </label>
                         <input type="email" class="form-control" name="email" id="email" placeholder="your@email.com" value="{{ $UserTbl->email }}" title="enter your email" disabled readonly required>
                      </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="col-11">
                      <label class="text-dark font-123" for="password">
                         <h4>Password</h4>
                         <span><small>Leave Password field blank if you don't want to change it</small></span>
                      </label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" title="enter your password.">
                   </div>
                </div>
                <div class="form-group">
                   <div class="row">
                      <div class="col-11">
                         <label class="text-dark font-123" for="phone">
                            <h4>Phone</h4>
                         </label>
                         <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" value="{{ $UserTbl->phone }}" title="enter your phone number">
                      </div>
                   </div>
                </div>
                <div class="form-group">
                   <div class="col-11">
                      <label class="text-dark font-123" for="gender">
                         <h4>Gender</h4>
                      </label>
                      <select class="form-control" name="gender" id="gender">
                        <option {{ $UserTbl->gender == 'male' ? 'selected': NULL }} value="male">Male</option>
                        <option {{ $UserTbl->gender == 'female' ? 'selected': NULL }} value="female">Female</option>
                      </select>
                   </div>
                </div>
                <div class="form-group">
                   <div class="col-11">
                      <label class="text-dark font-123" for="dob">
                         <h4>Date of Birth</h4>
                      </label>
                      <input type="text" class="form-control" name="dob" id="dob" placeholder="Enter Date of Birth" value="{{ $UserTbl->birth_date }}" title="Date of Birth">
                   </div>
                </div>
                <div class="form-group">
                   <div class="col-11">
                      <label class="text-dark font-123" for="location">
                         <h4>Location</h4>
                      </label>
                      <input type="text" class="form-control" name="location" id="location" placeholder="Your Location" value="{{ $UserTbl->location }}" title="enter your location">
                   </div>
                </div>
                <div class="form-group">
                   <div class="col-11">
                      <label class="text-dark font-123" for="profile_picture">
                         <h4>Upload a photo</h4>
                      </label>
                      <input type="file" class="text-center center-block file-upload form-control" name="profile_picture" type="file" accept=".jpg,.jpeg,.png,.gif">
                   </div>
                </div>
                <div class="form-group">
                   <div class="col-xs-12">
                      <br>
                      <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                      <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                   </div>
                </div>
             </form>
         </div>
      </div>
   </div>
</div>
@stop