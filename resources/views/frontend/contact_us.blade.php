@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-title">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" alt="" class="logo_black"></a>
            <h1 class="text-center"><span>Contact Us</span></h1>
         </div>
      </div>
   </div>
</div>
<div class="contact-detail">
   <div class="row">
      <div class="col-md-6">
         <form action="{{ lang_url('contact_us_email') }}" method="post">
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
               <div class="form-group col-md-6 col-lg-6">
                  <label for="first_name">First Name <span>*</span></label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
               </div>
               <div class="form-group col-md-6 col-lg-6">
                  <label for="last_name">Last Name <span>*</span></label>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
               </div>
               <div class="form-group col-lg-12 col-md-12">
                  <label for="email">Mobile Number <span>*</span></label>
                  <input type="text" class="form-control" id="mobile_Number" name="mobile_Number" placeholder="Enter mobile number" required>
               </div>
               <div class="form-group col-lg-12 col-md-12">
                  <label for="subject">Subject <span>*</span></label>
                  <select class="form-control" name="subject" id="subject">
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
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
               </div>

               <div class="form-group col-lg-12 col-md-12">
                  <label for="message">Message <span>*</span></label>
                  <textarea class="form-control" rows="5" id="message" name="message" required></textarea>
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </form>
      </div>
      <div class="col-md-6">
         <h2><span>Connect</span></h2>
         <div class="social_icon_list">
            <ul>
               <li><a href="#"><i data-toggle="tooltip" data-placement="top" title="Facebook" class="fa fa-facebook"></i></a></li>
               <li><a href="#"><i data-toggle="tooltip" data-placement="top" title="Twitter" class="fa fa-twitter"></i></a></li>
               <li><a href="#"><i data-toggle="tooltip" data-placement="top" title="Youtube" class="fa fa-youtube-play"></i></a></li>
               <li><a href="#"><i data-toggle="tooltip" data-placement="top" title="Mail" class="fa fa-envelope-o"></i></a></li>
            </ul>
         </div>
         <br>
         <h2><span>Address</span></h2>
         <div class="user-text">
            <!-- <h3>
               <span>ExampleTrading LLC</span>
               </h3> -->
            <h3>
               <a href="mailto:Info@abc.com"><i class="fa fa-envelope-o"></i>  support@bettertrend.net</a> 
            </h3>
            <h3>
               <a href="#"><i class="fa fa-map-marker"></i>  ABC Rd, KS 66062</a>
            </h3>
         </div>
      </div>
   </div>
</div>
@stop