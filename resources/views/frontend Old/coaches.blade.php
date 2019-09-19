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
              <li><a href="{{ lang_url('') }}">الصفحة الرئيسية</a></li>
              <li class="active text-gray-silver">عن الأتجاه الأفضل</li>
              <li class="active text-gray-silver">المدربين</li>
            </ol>
            <h2 class="title text-white">المدربين</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Divider: Contact -->
  <div class="row">
    <div class="col-xs-10 text-right">
      <?php /*
      @if($requestStatus)
      <div class="alert alert-red">
        <ul class="list-unstyled mb-0">
          <li class="text-white">Your have already send coach request! Your request is ({{ ucwords($requestStatus) }})</li>
        </ul>
      </div>
      @endif
      */ ?>
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
              <p class="mb-10 color-semi-gray">Coaches not found!</p>
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
                <h4 class="mt-0 color-semi-gray mb-5 font-26">إنظمام</h4>
                <p class="mb-10 font-22">انظم لمدربين الاتجاه الأفضل</p>
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
                <h4 class="mt-0 color-semi-gray mb-5 font-26">إنظمام</h4>
                <p class="mb-10 font-22">انظم لمدربين الاتجاه الأفضل</p>
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
        <h4 class="modal-title text-center color-theme-green font-weight-700 font-26 mt-20 mb-10" id="myModalLabel">انضمام</h4>
        <p class="color-dark-green">نموذج انضمام متدرب جديد لفريق عمل الاتجاه الأفضل 
          فضلاً قم بتعبة النموذج التالي :
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
                  <label for="InputName1">الأسم</label>
                  <input id="InputName1" name="name" class="form-control" type="text" placeholder="الأسم" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputPhone1">رقم الهاتف المحمول  </label>
                  <input id="InputPhone1" name="phone" class="form-control" type="text" placeholder="رقم الهاتف المحمول" value="{{ Auth::check() ? Auth::user()->phone : '' }}" required>
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputEmail1">رالبريد الإلكتروني</label>
                  <input id="InputEmail1" name="email" class="form-control" type="text" placeholder="البريد الإلكتروني " value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputExperience1">سنوات الخبرة</label>
                  <input id="InputExperience1" class="form-control" type="text" placeholder="سنوات الخبرة" name="experience">
                  <input id="upload-file" class="custom-upload" type="file" name="exp_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputCertificates1">سشهادات</label>
                  <input id="InputCertificates1" class="form-control" type="text" placeholder="سشهادات" name="certificates">
                  <input id="upload-file" class="custom-upload" type="file" name="cert_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputEducation1">سالتعليم </label>
                  <input id="InputEducation1" class="form-control" type="text" placeholder="سالتعليم " name="education">
                  <input id="upload-file" class="custom-upload" type="file" name="edu_attc[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputLicense1">سنوات الخبرة</label>
                  <input id="InputLicense1" class="form-control" type="text" placeholder="سنوات الخبرة" name="training_license">
                  <input id="upload-file" class="custom-upload" type="file" name="lic_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="about">اعن دورتك  </label>
                  <textarea id="about" name="about_coach" class="form-control" type="text" placeholder="اعن دورتك " required>
                  {{ Auth::check() ? Auth::user()->about : '' }}
                  </textarea>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer text-center mb-30">
        <button type="submit" class="btn btn-dark btn-flat btn-theme-green">تسجيل إنضمام</button>
      </div>
      </form>
    </div>
  </div>
</div>
@stop