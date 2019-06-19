@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo_trans.png" alt="Logo" class="logo_black"></a>
            <h1 class="text-center"><span>Coach Request Form</span></h1>
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
     <div class="col-md-3 user_prof_listing">
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
     <div class="col-md-9 mt-3 mb-3">
       <div class="tab-content">
          <section class="coach-form">
            @if($requestStatus)
            <div class="alert alert-red">
               <ul class="list-unstyled mb-0">
                  <li class="text-white">Your have already send coach request! Your request is ({{ ucwords($requestStatus) }})</li>
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

            @if(session()->has('error'))
            <div class="alert alert-red">
               <ul class="list-unstyled mb-0">
                  <li class="text-white">{!! session()->get('error') !!}</li>
               </ul>
            </div>
            @endif
            <form method="POST" action="{{ lang_url('be_a_coach_submit') }}" enctype="multipart/form-data">
              @csrf
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="InputName1">Name</label>
                      <input type="text" class="form-control" name="name" id="InputName1" placeholder="Enter your name" value="{{ Auth::user()->name }}" required>
                    </div><!-- End Form Group -->
                  </div><!-- End Col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="InputPhone1">Mobile Number</label>
                      <input type="text" class="form-control" name="phone" id="InputPhone1" placeholder="Enter your phone mumber" value="{{ Auth::user()->phone }}" required>
                    </div><!-- End Form Group -->
                  </div><!-- End Col -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="InputEmail1">Email</label>
                      <input type="email" class="form-control" name="email" id="InputEmail1" placeholder="Enter your email" value="{{ Auth::user()->email }}" required>
                    </div><!-- End Form Group -->
                  </div><!-- End Col -->
                  <div class="col-md-12">
                    <label for="InputExperience1">Experience</label>
                    <div class="row">
                       <div class="form-group col-md-8">
                        <textarea name="experience" class="form-control" id="InputExperience1" rows="1" placeholder="Your Experience"></textarea>
                      </div><!-- End Form Group -->
                      <div class="form-group col-md-4">
                        <div class="file-upload experience-file">
                          <div class="file-select">
                            <div class="file-select-button" id="ExperienceName">Choose File</div>
                            <div class="file-select-name" id="noFileExperience">No file chosen...</div>
                            <input type="file" name="exp_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" class="chooseFileLicense" multiple>
                          </div>
                        </div>
                        <small class="pull-left">Some Documents Attach about your Experience (Maximum upload size: 10 MB.)</small>
                      </div><!-- End Form Group -->
                    </div><!-- End Col -->
                   </div>

                   <div class="col-md-12">
                    <label for="InputCertificates1">Certificates</label>
                    <div class="row">
                       <div class="form-group col-md-8">
                        <textarea name="certificates" class="form-control" id="InputCertificates1" rows="1" placeholder="Your Certificates"></textarea>
                      </div><!-- End Form Group -->
                      <div class="form-group col-md-4">
                        <div class="file-upload certificates-file">
                          <div class="file-select">
                            <div class="file-select-button" id="CertificatesName">Choose File</div>
                            <div class="file-select-name" id="noFileCertificates">No file chosen...</div>
                            <input type="file" name="cert_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" class="chooseFileLicense" multiple>
                          </div>
                        </div>
                         <small class="pull-left">Some Documents Attach about your Certificates (Maximum upload size: 10 MB.)</small>
                      </div><!-- End Form Group -->
                    </div><!-- End Col -->
                   </div>

                   <div class="col-md-12">
                    <label for="InputEducation1">Education</label>
                    <div class="row">
                       <div class="form-group col-md-8">
                        <textarea name="education" class="form-control" id="InputEducation1" rows="1" placeholder="Your Education"></textarea>
                      </div><!-- End Form Group -->
                      <div class="form-group col-md-4">
                        <div class="file-upload education-file">
                          <div class="file-select">
                            <div class="file-select-button" id="EducationName">Choose File</div>
                            <div class="file-select-name" id="noFileEducation">No file chosen...</div>
                            <input type="file" name="edu_attc[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" class="chooseFileLicense" multiple>
                          </div>
                        </div>
                        <small class="pull-left">Some Documents Attach about your Education (Maximum upload size: 10 MB.)</small>
                      </div><!-- End Form Group -->
                    </div><!-- End Col -->
                   </div>

                   <div class="col-md-12">
                    <label for="InputLicense1">Training License</label>
                    <div class="row">
                       <div class="form-group col-md-8">
                        <textarea name="training_license" class="form-control" id="InputLicense1" rows="1" placeholder="Your Training License"></textarea>
                      </div><!-- End Form Group -->
                      <div class="form-group col-md-4">
                        <div class="file-upload license-file">
                          <div class="file-select">
                            <div class="file-select-button" id="LisenseName">Choose File</div>
                            <div class="file-select-name" id="noFileLicense">No file chosen...</div>
                            <input type="file" name="lic_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" class="chooseFileLicense" multiple>
                          </div>
                        </div>
                        <small class="pull-left">Some Documents Attach about your Training License (Maximum upload size: 10 MB.)</small>
                      </div><!-- End Form Group -->
                    </div><!-- End Col -->
                   </div>

                   <div class="col-md-12">
                     <div class="form-group">
                      <label for="InputName1">About Your Course</label>
                      <textarea name="about_coach" class="form-control" id="InputCertificates1" rows="3" placeholder="About Your Courses">{{ Auth::user()->about }}</textarea>
                    </div><!-- End Form Group -->
                   </div>

                   <div class="col-md-12">
                     <button class="btn btn-success" type="submit">Submit</button>
                   </div>

                </div><!-- End Row -->
              </div><!-- End Container -->
            </form>
          </section><!-- End Section -->
       </div>
     </div>
  </div>
</div>
@stop