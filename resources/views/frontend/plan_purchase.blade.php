<?php use App\UserSubscription; ?>
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
                     <li><a href="{{ lang_url('') }}">@t('the main page')</a></li>
                     <li class="active text-gray-silver">@t('For the best direction')</li>
                     <li class="active text-gray-silver">@t('Definition of')</li>
                  </ol>
                  <h2 class="title text-white">@t('For the best direction')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: about -->
   <section class="divider">
      <div class="container">
         <div class="row pt-30 rtl">
            <div class="col-md-12">
               <form id="buy_plan_school" name="buy_plan_school" class="form-inline" action="{{ lang_url('buy_plan_school') }}" method="post">
                  @csrf
                  <?php
                     $date = date("Y-m-d");// current date
                     if ($no == '1') {
                        $period = '';
                        
                     } else if ($no == '2') {
                        $period = '+1 year';
                     
                     } else if ($no == '3') {
                        $period = '+1 month';
                        
                     } else if ($no == '4') {
                        $period = '+1 week';                     
                     }
                     $date = strtotime(date("Y-m-d", strtotime($date)) . $period); 
                     $time = date("Y-m-d h:i:s", $date);
                     ?>
                  @if(session()->has('error'))
                  <div class="alert alert-red">
                     <ul class="list-unstyled mb-0">
                        <li class="text-white">{!! session()->get('error') !!}</li>
                     </ul>
                  </div>
                  @endif
                  <input type="hidden" name="plan_name" value="{{ $plan_name }}" />
                  <input type="hidden" name="no" value="{{ $no }}" />
                  <input type="hidden" class="total_price_hidden" name="price" value="{{ $price }}" />
                  <input type="hidden" name="package_start_date" value="{{ date('Y-m-d h:i:s') }}" />
                  <input type="hidden" name="package_end_date" value="{{ $time }}" />
                  <div class="row">
                     <div class="col-md-10 col-sm-12 col-md-offset-1">
                        <?php if ($schoolNative): ?>
                        <div class="col-sm-12 p-0">
                           <div class="form-group mb-30">
                              <label for="school_name">@t('مدرسة ')</label>
                              <select class="form-control" id="school_name" name="school">
                                 <?php foreach ($schoolNative as $key => $school): ?>
                                    <?php 
                                    $alreadySubscribed = UserSubscription::where([['user_id', Auth::user()->id],['school_id', $school->schools->id],['status', 'active']])->first(); ?>
                                    <?php if (!$alreadySubscribed): ?>
                                       <option value="{{ $school->schools->id }}">{{ $school->name }}</option>
                                    <?php endif ?>
                                 <?php endforeach ?>
                              </select>
                           </div>
                        </div>
                        <?php endif ?>
                        <div class="col-sm-12 p-0">
                           <div class="form-group mb-30">
                              <label for="price">@t('membership ')<small><span class="mbrshp_name">{{ $plan_name }}</span></small> </label>
                              <input id="price" class="form-control total_price_" type="text" value="${{ $price }}" id="price" readonly>
                           </div>
                        </div>
                        <div class="col-sm-12 p-0">
                           <div class="form-group mb-30">
                              <label for="price"> @t('Expires in')</label>
                              <input value="{{ $time }}" class="form-control" type="text" placeholder="@t(' الرقم السري')" readonly>
                           </div>
                        </div>
                        <div class="col-sm-12 p-0 mb-20">
                          <label for="couponCode">@t('Coupon code')</label>
                          <input value="{{ old('couponCode') }}" data-plan_id="{{ $planId }}" type="text" class="form-control couponCode" name="couponCode" style="width: 68%;">
                          <button type="button" class="btn btn-success apply_code" style="display: inline-block;">@t('Apply code')</button>
                          <img src="\public\loading.gif" class="loader_coupen mr-1 ml-1">
                          <span class="text-danger coupen_error">@t('Coupen expire or Invalid')</span>
                          <input type="hidden" name="coupen_status" class="coupen_status" value="0" />
                          <input type="hidden" name="discount_perc" class="discount_perc" value="0" />
                          <input type="hidden" class="user_id" name="user_id" value="{{ Auth::check() ? Auth::user()->id : NULL }}" />
                        </div>
                        <div class="form-group form-group-center text-center mb-30 mt-20">
                           <input name="form_botcheck" class="form-control" type="hidden" value="">
                           <button type="submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">@t('Buy a package')</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->

@push('scripts')
<script>
  $(document).ready(function() {
      $('.apply_code').on('click', function(e) {
        e.preventDefault();
        var $this = $('.couponCode'),
            coupenCode = $this.val(),
            object_id = $this.attr('data-plan_id'),
            object_type = '2';

            if (coupenCode != '') {

              $('.loader_coupen').show();

              $.ajax({
                    type: 'POST',
                    url: '{{ lang_url("coupenCheck") }}',
                    data: {"_token": "{{ csrf_token() }}", 'object_type':object_type, 'coupenCode':coupenCode, 'object_id':object_id},
                })
                .done(function(response) {
                  $('.loader_coupen').hide();
                  if (response == '0') {
                    $('.coupen_error').show();
                    $('.discount_perc').val('0');

                    $('.total_price_hidden').val('${{ $price }}');
                    $('.total_price_').val('${{ $price }}');

                  } else {
                    $('.coupen_error').hide();

                    $('.total_price_hidden').val(response['discountedPrice']);
                    $('.total_price_').val('$'+response['discountedPrice']);
                    $('.discount_perc').val(response['discount']);
                  }

                });


            } else {

              $('.loader_coupen').hide();
              $('.coupen_error').hide();
              $('.discount_perc').val('0');
              $('.total_price_hidden').val('${{ $price }}');
              $('.total_price_').val('${{ $price }}');
            }
        
      });
   });
</script>
@endpush
@stop