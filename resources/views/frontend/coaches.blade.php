@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Start main-content -->
<div class="main-content">
  <!-- Section: inner-header -->
  <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="/frontend/_assets/images/breadcrumb-bg.png">
    <div class="container pt-70 pb-20">
      <!-- Section Content -->
      <div class="section-content">
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb text-right text-black mb-0 mt-40">
              <li><a href="{{ lang_url('') }}">@t('Instructor social accounts...')</a></li>
              <li class="active text-gray-silver">@t('For the best direction')</li>
              <li class="active text-gray-silver">@t('Trainers')</li>
            </ol>
            <h2 class="title text-white">@t('Trainers')</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Divider: Contact -->
  <div class="row">
    <div class="col-xs-10 text-right">
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
    </div>
    <!-- /.col-xs-10 -->
  </div>
  <!-- /.row -->
  <section class="divider">
    <div class="container">
      <div class="row multi-row-clearfix">
        <?php if ($allUsers): ?>
        <?php foreach ($allUsers as $key => $coach): ?>
        <div class="col-sm-6 col-md-4 mb-sm-30 sm-text-center mb-30">
          <div class="team maxwidth400">
            <a href="{{ lang_url('coach_profile/'.$coach->users->id) }}">
              <div class="thumb">
                <img class="img-fullwidth" src="\public\storage\{{ $coach->users->avatar }}" alt="{{ $coach->users->name }}">
              </div>
            </a>
            <div class="content p-5 bg-white clearfix text-center">
              <a href="{{ lang_url('coach_profile/'.$coach->users->id) }}">
                <h4 class="name color-dark-green mt-0 mb-5 font-20">{{ $coach->users->name }}  </h4>
              </a>
              <h5 class="color-theme-green">{{ $coach->users->last_name }} </h5>
              <p class="mb-10 color-semi-gray">{{ $coach->users->about }}</p>
              <ul class="styled-icons flat medium list-inline mb-40">
                <?php if ($coach->users->instagram != '' && $coach->users->instagram != NULL): ?>
                  <li><a target="_blank" href="{{ strstr( $coach->users->instagram, 'http' ) ? $coach->users->instagram : 'https://'.$coach->users->instagram }}"><i class="fa fa-instagram"></i></a> </li>
                <?php endif ?>
                <?php if ($coach->users->facebook != '' && $coach->users->facebook != NULL): ?>
                  <li><a target="_blank" href="{{ strstr( $coach->users->facebook, 'http' ) ? $coach->users->facebook : 'https://'.$coach->users->facebook }}"><i class="fa fa-facebook"></i></a> </li>
                <?php endif ?>
                <?php if ($coach->users->twitter != '' && $coach->users->twitter != NULL): ?>
                  <li><a target="_blank" href="{{ strstr( $coach->users->twitter, 'http' ) ? $coach->users->twitter : 'https://'.$coach->users->twitter }}"><i class="fa fa-twitter"></i></a> </li>
                <?php endif ?>
                <?php if ($coach->users->youtube != '' && $coach->users->youtube != NULL): ?>
                  <li><a target="_blank" href="{{ strstr( $coach->users->youtube, 'http' ) ? $coach->users->youtube : 'https://'.$coach->users->youtube }}"><i class="fa fa-youtube"></i></a> </li>
                <?php endif ?>
                
              </ul>
            </div>
          </div>
        </div>
        <?php endforeach ?>
        <?php else: ?>
        <div class="col-sm-6 col-md-4 mb-sm-30 sm-text-center mb-30">
          <div class="team maxwidth400">
            <div class="content p-5 bg-white clearfix text-center">
              <p class="mb-10 color-semi-gray">@t('Coaches not found!')</p>
            </div>
          </div>
        </div>
        <?php endif ?>
        <?php if (Auth::check()): ?>
        <?php $userRole = Auth::user()->role_id; ?>
        <?php if ($userRole != '2' && $userRole != '1'): ?>
        <div class="col-sm-6 col-md-4 mb-sm-30 sm-text-center mb-30">
          <div class="team maxwidth400">
            <a data-toggle="modal" data-target="#join-trainers" class="join-trainers">
              <div class="content border-1px p-60 bg-light clearfix text-center color-semi-gray">
                <i class="fa fa-plus font-60 mb-20" style="color: #E0E0E0"></i>
                <h4 class="mt-0 color-semi-gray mb-5 font-26">@t('Accession')</h4>
                <p class="mb-10 font-22">@t('Join the best trend coaches')</p>
              </div>
            </a>
          </div>
        </div>
        <?php endif ?>
        <?php else: ?>
        <div class="col-sm-6 col-md-4 mb-sm-30 sm-text-center mb-30">
          <div class="team maxwidth400">
            <a data-toggle="modal" data-target="#join-trainers" class="join-trainers">
              <div class="content border-1px p-60 bg-light clearfix text-center color-semi-gray">
                <i class="fa fa-plus font-60 mb-20" style="color: #E0E0E0"></i>
                <h4 class="mt-0 color-semi-gray mb-5 font-26">@t('Accession')</h4>
                <p class="mb-10 font-22">@t('Join the best trend coaches')</p>
              </div>
            </a>
          </div>
        </div>
        <?php endif ?>
      </div>
    </div>
  </section>
</div>
<!-- end main-content -->
<div class="modal fade" id="join-trainers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center color-theme-green font-weight-700 font-26 mt-20 mb-10" id="myModalLabel">@t('joining')</h4>
        <p class="color-dark-green">@t('A new trainee joining the best direction team
           Please fill out the following form:')
        </p>
      </div>
      <div class="modal-body">
        <!-- add new job Form -->
        <form id="add_job" name="add_job" class="form-inline" method="POST" action="{{ lang_url('be_a_coach_submit') }}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputName1">@t('The name')</label>
                  <input id="InputName1" name="name" class="form-control" type="text" placeholder="@t('الأسم')" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputPhone1">@t('Mobile Phone Number')</label>
                  <input id="InputPhone1" name="phone" class="form-control" type="text" placeholder="@t('Mobile Phone Number')" value="{{ Auth::check() ? Auth::user()->phone : '' }}" required>
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputEmail1">@t('Email')</label>
                  <input id="InputEmail1" name="email" class="form-control" type="text" placeholder="@t('Email')" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputExperience1">@t('Years of Experience')</label>
                  <input id="InputExperience1" class="form-control" type="text" placeholder="@t('Years of Experience')" name="experience">
                  <input id="upload-file" class="custom-upload" type="file" name="exp_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputCertificates1">@t('Certificates')</label>
                  <input id="InputCertificates1" class="form-control" type="text" placeholder="@t('Certificates')" name="certificates">
                  <input id="upload-file" class="custom-upload" type="file" name="cert_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputEducation1">@t('Education')</label>
                  <input id="InputEducation1" class="form-control" type="text" placeholder="@t('Education')" name="education">
                  <input id="upload-file" class="custom-upload" type="file" name="edu_attc[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputLicense1">@t('Years of Experience')</label>
                  <input id="InputLicense1" class="form-control" type="text" placeholder="@t('Years of Experience')" name="training_license">
                  <input id="upload-file" class="custom-upload" type="file" name="lic_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="about">@t('I announce your cycle')</label>
                  <textarea id="about" name="about_coach" class="form-control" type="text" placeholder="@t('اعن دورتك ')" required>
                  {{ Auth::check() ? Auth::user()->about : '' }}
                  </textarea>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer text-center mb-30">
        <button type="submit" class="btn btn-dark btn-flat btn-theme-green">@t('Register Join')</button>
      </div>
      </form>
    </div>
  </div>
</div>
@stop
