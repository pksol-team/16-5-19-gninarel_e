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

                    <li class="active text-gray-silver">تسجيل جديد</li>

                </ol>

                <h2 class="title text-white">تسجيل جديد</h2>

            </div>

          </div>

        </div>

      </div>

    </section>

      

    <!-- Divider: about -->

    <section class="divider">

      <div class="container">

        <div class="row pt-30 rtl">

            <div class="col-md-8 col-md-offset-2">

                <!-- login Form -->

                <div class="form-container">

                    <form id="register" class="form-inline" method="post" name="regform" action="{{ lang_url('register_check') }}">
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

                          <div class="col-md-12 col-sm-12">

                                <div class="col-sm-12 p-0">

                                  <div class="form-group mb-30">

                                    <label for="name">الأسم</label>

                                    <input id="name" name="name" class="form-control" placeholder="الأسم" type="text" name="name" value="{{ old('name') }}" size="20" required>

                                  </div>

                                </div>

                                <div class="col-sm-12 p-0">

                                  <div class="form-group mb-30">

                                    <label for="email">البريد الإلكتروني</label>

                                    <input id="email" name="email" class="form-control" type="email" placeholder="البريد الإلكتروني" value="{{ old('email') }}" required>

                                  </div>

                                </div>

                                <div class="col-sm-12 p-0">

                                  <div class="form-group mb-30">

                                    <label for="password">الرقم السري</label>

                                    <input id="password" name="password" class="form-control" type="password" placeholder="الرقم السري"  value="{{ old('password') }}" size="20" required>

                                  </div>

                                </div>

                                <!-- <div class="col-sm-12 p-0">

                                  <div class="form-group mb-30">

                                    <label for="confirm_password">تأكيد الرقم السري</label>

                                    <input id="confirm_password" name="confirm_password" class="form-control" type="password" placeholder="تأكيد الرقم السري" required="" aria-required="true">

                                  </div>

                                </div> -->

                                <div class="col-sm-12 p-0">

                                  <div class="form-group mb-30">

                                    <label for="phone">رقم الجوال</label>

                                    <input id="phone" class="form-control" type="text" placeholder="رقم الجوال" name="phone" value="{{ old('phone') }}" size="20" required>

                                  </div>

                                </div>

                                <!-- <div class="col-sm-12 p-0">

                                  <div class="form-group mb-30">

                                    <label for="gender">الجنس </label>

                                    <select class="form-control" id="gender"> 

                                        <option>ذكر</option> 

                                        <option>أنثي</option> 

                                      </select>

                                  </div>

                                </div> -->

                                <!-- <div class="col-sm-12 p-0">

                                  <div class="form-group mb-30">

                                    <label for="age">العمر</label>

                                    <input id="age" name="age" class="form-control" type="text" placeholder="العمر" required="" aria-required="true">

                                  </div>

                                </div> -->

                                <!-- <div class="col-sm-12 p-0">

                                  <div class="form-group mb-30">

                                    <label for="job">الوظيفة</label>

                                    <input id="job" name="job" class="form-control" type="text" placeholder="الوظيفة" required="" aria-required="true">

                                  </div>

                                </div> -->

                          </div>

                      </div>

                      <div class="row">

                          <div class="col-md-6 col-md-offset-3">

                              <div class="form-group form-group-center text-center mb-30 mt-20 ">
<!-- 
                                    <a href="dashboard.html" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">تسجيل  </a> -->
                                    <input type="submit" id="register-submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100" value="تسجيل  ">
                                    <!-- 

                                    <input name="form_botcheck" class="form-control" type="hidden" value="">

                                    <button type="submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">تسجيل جديد</button>-->

                              </div>

                          </div>

                      </div>    

                    </form>  

                </div>

            </div>

        </div>

      </div>

    </section>

    

  </div>

  <!-- end main-content -->













@stop