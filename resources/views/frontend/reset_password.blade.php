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
                     <li><a href="{{ lang_url('') }}">@t('الصفحة الرئيسية')</a></li>
                     <li class="active text-gray-silver">@t('الدخول')</li>
                  </ol>
                  <h2 class="title text-white">@t('منطقة الدخول')</h2>
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
                  <form class="form-inline" name="loginform" id="loginform" method="POST" action="{{ lang_url('forgot_reset_password') }}">
                     @csrf
                     <input name="GUID" type="hidden" value="{{ $userGet->GUID }}">
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
                                 <label for="password">@t(' كلمه السر ')</label>
                                 <input id="password" name="password" class="form-control" type="password" placeholder="@t('كلمه السر')" aria-required="true" value="{{ old('password') }}" size="20" required>
                              </div>
                           </div>
                           <div class="col-sm-12 p-0">
                              <div class="form-group mb-30">
                                 <label for="confirm_password">@t('تأكيد كلمة المرور ') </label>
                                 <input id="confirm_password" name="confirm_password" class="form-control" type="password" placeholder="@t('تأكيد كلمة المرور')" aria-required="true" value="{{ old('confirm_password') }}" size="20" required>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group form-group-center text-center mb-30 mt-20 ">
                              <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100" value="@t('تحديث')">
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