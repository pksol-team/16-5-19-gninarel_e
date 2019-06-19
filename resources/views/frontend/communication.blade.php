@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-9">
         <div class="elegant-special-heading-wrapper">
            <h1 class="special-heading-title">Training Activities</h1>
         </div>
      </div>
   </div>
</div>
<div class="podcast-detail pt-5 pb-5">
   <div class="row">
      <div class="col-4 podcasting-img-desc user_prof_listing">
         <div class="">
           <ul class="list-unstyled mt-3">
             <li class=""><a class="d-block" href="{{ lang_url('profile') }}"><i class="fa fa-user-o mr-1 ml-1"></i> Profile</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('all_purchases') }}"><i class="fa fa-shopping-cart mr-1 ml-1"></i> Purchases</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('all_subscriptions') }}"><i class="fa fa-check mr-1 ml-1"></i> Subscription</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('schools') }}"><i class="fa fa-graduation-cap mr-1 ml-1"></i> Electronic School</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('training_activities') }}"><i class="fa fa-tasks mr-1 ml-1"></i> Training Activities</a></li>
             <li class="active"><a class="d-block" href="{{ lang_url('communication') }}"><i class="fa fa-address-book-o mr-1 ml-1"></i> Communication</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('logout_frontend') }}"><i class="fa fa-sign-out mr-1 ml-1"></i> Logout</a></li>
           </ul>
         </div>
      </div>
      <div class="col-8">
        <div class="tab-content">
         <form action="{{ lang_url('communication_contact_us_email') }}" method="post">
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
            <div class="row contact-form">
               <!-- <div class="form-group col-md-6 col-lg-6">
                  <label for="first_name">First Name <span>*</span></label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="{{ Auth::user()->name }}" required>
               </div>
               <div class="form-group col-md-6 col-lg-6">
                  <label for="last_name">Last Name <span>*</span></label>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{ Auth::user()->last_name }}" required>
               </div> -->
               <!-- <div class="form-group col-lg-12 col-md-12">
                  <label for="email">Mobile Number <span>*</span></label>
                  <input type="text" class="form-control" id="mobile_Number" value="{{ Auth::user()->phone }}" name="mobile_Number" placeholder="Enter mobile number" required>
               </div> -->
               <div class="form-group col-lg-12 col-md-12">
                  <label for="subject">Subject <span>*</span></label>
                  <select class="form-control" name="subject" id="subject" required>
                    <option value="" hidden>Subject</option>
                    <option value="Technical support">Technical support</option>
                    <option value="Sales">Sales</option>
                    <option value="Complaint">Complaint</option>
                    <option value="Suggestions">Suggestions</option>
                    <option value="Special">Special</option>
                    <option value="request">request</option>
                    <option value="others">others</option>
                  </select>
               </div>
               <div class="form-group col-lg-12 col-md-12">
                  <label for="email">Email address <span>*</span></label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ Auth::user()->email }}" required>
               </div>

               <div class="form-group col-lg-12 col-md-12">
                  <label for="message">Message <span>*</span></label>
                  <textarea class="form-control" rows="5" id="message" name="message" required></textarea>
               </div>
               <button type="submit" class="btn btn-success">Submit</button>
            </div>
         </form>
        </div>
      </div>
   </div>
</div>
@stop