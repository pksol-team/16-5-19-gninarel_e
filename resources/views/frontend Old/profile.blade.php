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
                    <li class="active text-gray-silver">الملف الشخصي</li>
                </ol>
                <h2 class="title text-white">الملف الشخصي</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
      
    
    <section class="divider bg-white">
      <div class="container pt-150">
            <div class="row">
              <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="vertical-tab">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" ><img src="/frontend/_assets/images/icon-1.png" class="img-responsive" alt="icon-1"/> الملف الشخصي </a></li>
                    <li><a href="{{ lang_url('all_purchases') }}" ><img src="/frontend/_assets/images/icon-2.png" class="img-responsive" alt="icon-2"/> مشترياتي</a></li>
                    <li><a href="{{ lang_url('all_subscriptions') }}" ><img src="/frontend/_assets/images/icon-3.png" class="img-responsive" alt="icon-3"/> باقاتي</a></li>
                    <li><a href="{{ lang_url('schools') }}" ><img src="/frontend/_assets/images/icon-4.png" class="img-responsive" alt="icon-4"/> المدرسة  الالكترونية</a></li>
                    <li><a href="{{ lang_url('training_activities') }}" ><img src="/frontend/_assets/images/icon-5.png" class="img-responsive" alt="icon-5"/> الانشطة التدريبة</a></li>
                    <li><a href="{{ lang_url('communication') }}" ><img src="/frontend/_assets/images/icon-6.png" class="img-responsive" alt="icon-6"/> التواصل </a></li>
                    <li><a href="{{ lang_url('logout_frontend') }}"><img src="/frontend/_assets/images/icon-7.png" class="img-responsive" alt="icon-7"/> خروج</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab1">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <!-- profile Form -->
                            <form id="profile_form" name="profile_form" class="form-inline" action="{{ lang_url('update_my_data') }}" enctype="multipart/form-data" method="post">
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
                          <div class="row">
                              <div class="col-md-10 col-sm-12 col-md-offset-1">
                                    <div class="col-sm-12 p-0">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" name="profile_picture" accept=".jpg,.jpeg,.png,.gif" />
                                                <label for="imageUpload"></label>
                                            </div>
                                            <div class="avatar-preview">
                                              <img width="25%" src="\public\storage\{{ $UserTbl->avatar }}" class="avatar rounded-circle border" alt="User Image" height="180">
                                                <!-- <div id="imagePreview" style="background-image: url(storage\{{ $UserTbl->avatar }})">
                                                </div>
 -->                                            </div>
                                            <h4 class="text-center">تغير الصورة</h4>
                                        </div>
                                    </div> 
                                    <div class="col-sm-12 p-0">
                                      <div class="form-group mb-30">
                                        <label for="first_name">الاسم الاول  </label>
                                        <input class="form-control" type="text" placeholder="خالاسم الاول  " aria-required="true" name="first_name" id="first_name" value="{{ $UserTbl->name }}"  required>
                                      </div>
                                      <div class="form-group mb-30">
                                        <label for="last_name">الكنية </label>
                                        <input class="form-control" type="text" placeholder="خالكنية " aria-required="true" name="last_name" id="last_name" value="{{ $UserTbl->last_name }}" required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12 p-0">
                                      <div class="form-group mb-30">
                                        <label for="email">البريد الألكتروني</label>
                                        <input placeholder="البريد الألكتروني" required="" aria-required="true" type="email" class="form-control" name="email" id="email" value="{{ $UserTbl->email }}" disabled readonly required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12 p-0">
                                      <div class="form-group mb-30">
                                        <label for="password"> الرقم السري</label>
                                        <input id="password" name="password" class="form-control" type="password" placeholder=" الرقم السري">
                                      </div>
                                    </div>
                                    <div class="col-sm-12 p-0">
                                      <div class="form-group mb-30">
                                        <label for="phone">رقم الجوال</label>
                                        <input class="form-control" type="text" placeholder="رقم الجوال" name="phone" id="phone" value="{{ $UserTbl->phone }}" >
                                      </div>
                                    </div>
                                    <div class="col-sm-12 p-0">
                                      <div class="form-group mb-30">
                                        <label for="gender">الجنس </label>
                                        <select class="form-control" name="gender" id="gender"> 
                                            <option {{ $UserTbl->gender == 'male' ? 'selected': NULL }} value="male">ذكر</option> 
                                            <option {{ $UserTbl->gender == 'female' ? 'selected': NULL }} value="female">أنثي</option> 
                                          </select>
                                      </div>
                                    </div>
                                    <?php if ($UserTbl->role_id == 1 || $UserTbl->role_id == 2): ?>

                                    <div class="col-sm-12 p-0">
                                      <div class="form-group mb-30">
                                        <label for="facebook">رفيس بوك</label>
                                        <input class="form-control" type="url" placeholder="فيس بوك" required="" aria-required="true" name="facebook" id="facebook" value="{{ $UserTbl->facebook }}" >
                                      </div>
                                    </div>
                                    <div class="col-sm-12 p-0">
                                      <div class="form-group mb-30">
                                        <label for="twitter">تغريد</label>
                                        <input class="form-control" type="url" placeholder="تغريد" aria-required="true" name="twitter" id="twitter" value="{{ $UserTbl->twitter }}" >
                                      </div>
                                    </div>
                                    <div class="col-sm-12 p-0">
                                      <div class="form-group mb-30">
                                        <label for="youtube">موقع</label>
                                        <input class="form-control" type="url" placeholder="موقع" aria-required="true" name="youtube" id="youtube" value="{{ $UserTbl->youtube }}" >
                                      </div>
                                    </div>
                                    <div class="col-sm-12 p-0">
                                      <div class="form-group mb-30">
                                        <label for="instagram">الانستقرام</label>
                                        <input class="form-control" type="url" placeholder="الانستقرام" aria-required="true" name="instagram" id="instagram" value="{{ $UserTbl->instagram }}" >
                                      </div>
                                    </div>
                                    <?php endif ?>

                                    <div class="col-sm-12 p-0">
                                      <div class="form-group mb-30">
                                        <label for="dob">تاريخ الولادة</label>
                                        <input placeholder=" تاريخ الولادة " type="text" class="form-control" name="dob" id="dob" value="{{ substr($UserTbl->birth_date, 0, 10) }}">
                                      </div>
                                    </div>
                                    <div class="col-sm-12 p-0">
                                      <div class="form-group mb-30">
                                        <label for="location">موقعك </label>
                                        <input placeholder="موقعك   "  type="text" class="form-control" name="location" id="location" value="{{ $UserTbl->location }}">
                                      </div>
                                    </div>
                                    <div class="form-group form-group-center text-center mb-30 mt-20">
                                        <button type="submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">حفظ</button>
                                    </div>
                              </div>
                          </div>
                        </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>          
            </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
@push('scripts')
<script>
  jQuery(document).ready(function($) {
    $('#dob').datetimepicker({
      format: 'YYYY-MM-DD'
    }).on('keypress paste', function (e) {
      e.preventDefault();
      return false;
    });
  });
</script>
@endpush

@stop