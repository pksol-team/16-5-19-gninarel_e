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
                     <li><a href="{{ lang_url('') }}">@t('Home')</a></li>
                     <li class="active text-gray-silver">@t('Thank You')</li>
                  </ol>
                  <h2 class="title text-white">@t('Thank You')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: about -->
   <section class="divider">
      <div class="container">
         <div class="row pt-30 rtl">
            <div class="col-md-12 check-custom">
               <h1 class="text-center"><span  class="blue_color">@t('THANK YOU')</span></h1>
               <p class="mb-30 text-center"><i class="fa fa-check"></i></p>
               <p class="text-center">@t('Thank you For Your Order !')</p>
               <p class="text-center"><strong>@t('Questions About You Order')</strong> @t('Call') : -21-98765432</p>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop