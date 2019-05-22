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
               <p class="special-heading-description">{{ $UserTbl->name }}</p>
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
   <div class="col-md-4 podcasting-img-desc">
      <div class="text-center">
         <div class="podcastimg">
            <img src="\public\storage\{{ $UserTbl->avatar }}" class="avatar" alt="User Image" height="230">
         </div>
      </div>
      <div class="share-this row">
         <div class="col-5">
            <h4 class="tagline">Social Media</h4>
         </div>
         <div class="col-7">
            <div class="social_icon_list">
               <ul>
                  <li>
                     <a href="#">
                      <i data-toggle="tooltip" data-placement="top" title="Facebook" class="fa fa-facebook"></i>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                      <i data-toggle="tooltip" data-placement="top" title="Twitter" class="fa fa-twitter"></i>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                      <i data-toggle="tooltip" data-placement="top" title="Youtube" class="fa fa-youtube-play"></i>
                     </a>
                  </li>
                  <li>
                     <a href="#">
                      <i data-toggle="tooltip" data-placement="top" title="Mail" class="fa fa-envelope-o"></i>
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-8">
      <div class="rating-Episodes-view">
         <ul class="nav nav-tabs mb-2">
            <li class="active"><a data-toggle="tab" href="#home" class="active">Home</a></li>
            <li class=""><a data-toggle="tab" href="#update" class="">Update</a></li>
         </ul>
         <div class="tab-content">
            <div class="tab-pane active show" id="home">
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
              <div class="person-about">
                 <h4><i class="fa fa-user" aria-hidden="true"></i>About Me</h4>
                 <p>{{ $UserTbl->about }}</p>
              </div>
              <div class="person-detail">
                 <h4><i class="fa fa-info" aria-hidden="true"></i>Personal Details</h4>
                 <p><span>Full Name </span>:<span>{{ $UserTbl->name }}</span></p>
                 <p><span>Phone</span>:<span>{{ $UserTbl->mobile }}</span></p>
                 <p><span>Email</span>:<span>{{ $UserTbl->email }}</span></p>
                 <p><span>Location</span>:<span>{{ $UserTbl->address }}</span></p>
              </div>
            </div>
            <div class="tab-pane" id="update">
               <br>
               <form class="form profile-form" action="{{ lang_url('update_my_data') }}" method="post" id="updateprofileForm" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-6 pl-0 pr-0">
                           <label for="first_name">
                              <h4>First name</h4>
                           </label>
                           <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" value="{{ $UserTbl->name }}" title="enter your first name" required>
                        </div>
                        <div class="col-md-6">
                           <label for="last_name">
                              <h4>Last name</h4>
                           </label>
                           <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name" required>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-6 pl-0 pr-0">
                           <label for="mobile">
                              <h4>Phone</h4>
                           </label>
                           <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter phone" value="{{ $UserTbl->mobile }}" title="enter your phone number">
                        </div>
                        <div class="col-md-6">
                           <label for="email">
                              <h4>Email</h4>
                           </label>
                           <input type="email" class="form-control" name="email" id="email" placeholder="your@email.com" value="{{ $UserTbl->email }}" title="enter your email" disabled readonly required>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                  </div>
                  <div class="form-group">
                  </div>
                  <div class="form-group">
                     <div class="col-xs-6">
                        <label for="address">
                           <h4>Location</h4>
                        </label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="somewhere" value="{{ $UserTbl->address }}" title="enter your address">
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-6">
                        <label for="password">
                           <h4>Password</h4>
                        </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-6">
                        <label for="password2">
                           <h4>Verify</h4>
                        </label>
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm password" title="enter your password again">
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-xs-6">
                        <label for="profile_picture">
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
</div>
@stop