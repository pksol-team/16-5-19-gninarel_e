<?php use App\User; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Start main-content -->
<div class="main-content">
   <!-- Section: inner-header -->
   <section class="inner-header divider parallax layer-overlay overlay-dark-5" style="height: 60%;" data-bg-img="/frontend/_assets/images/breadcrumb-bg.png">
      <div class="container pt-70 pb-20">
         <!-- Section Content -->
         <div class="section-content">
            <div class="row">
               <div class="col-md-12">
                  <ol class="breadcrumb text-right text-black mb-0 mt-40">
                     <li><a href="{{ lang_url('') }}">@t('the main page')</a></li>
                     <li class="active text-gray-silver">@t('Services and products')</li>
                  </ol>
                  <h2 class="title text-white">@t('Services and products')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: about -->
   <section class="divider">
      <div class="container">
         <div class="row rtl">
            <div class="col-xs-12 col-sm-12 col-md-12 mb-sm-30">
               <h2 class="mt-0 font-30 heading-title-spec">@t('Definition of')</h2>
               <p class="mb-30">@t('Package Description Here Package Description Here Package Description Here Package Description Package Description Here Package Description Package Here Description Package Here')</p>
            </div>
         </div>
         <div class="row rtl">
            <?php if (count($allPlans) > 0): ?>
            <?php foreach ($allPlans as $key => $plans): ?> 
            <div class="col-xs-12 col-sm-6 col-md-3 hvr-float-shadow mb-sm-30">
               <div class="pricing-table maxwidth400">
               </div>
               <div class=" bg-white border-1px p-30 pt-20 pb-20" style="min-height: 55%;">
                  <h3 class="package-type font-24 m-0 mb-20 color-theme-green text-center">{{ $plans->title }}</h3>
                  <p>{{ $plans->description }}</p>
                  <h4 class="color-theme-green ">@t('Advantages')</h4>
                  <?php 
                     $advantages = explode(',', $plans->advantages);
                     ?>
                  <ul class="table-list list-icon theme-colored pb-0">
                     <?php foreach ($advantages as $key => $advantage): ?>
                     <?php if (strlen(trim($advantage)) > 1): ?>
                     <li><i class="">- </i>{{ $advantage }}</li>
                     <?php endif ?>
                     <?php endforeach ?>
                  </ul>
               </div>
               <form name="buy_req" id="buy_req" method="POST" action="{{ lang_url('buy_plan') }}" class="buy_req">
                  @csrf
                  <input type="hidden" name="plan_name" value="{{ $plans->title }}" />
                  <input type="hidden" name="no" value="2" />
                  <input type="hidden" name="duration" value="{{ $plans->duration }}" />
                  <input type="hidden" name="price" value="{{ $plans->price }}" />
                  <button class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat" type="submit">@t('Participation( :planPrice SR per month)', ['planPrice' => $plans->price])</button>
               </form>
            </div>
            <?php endforeach ?>
            <?php else: ?>
            <div class="col-xs-12 col-sm-6 col-md-3 hvr-float-shadow mb-sm-30">
               <div class=" bg-white border-1px p-30 pt-20 pb-20">
                  <h3 class="package-type font-24 m-0 mb-20 color-theme-green text-center">@t('Plans not added yet')</h3>
               </div>
            </div>
            <?php endif ?>
         </div>
      </div>
   </section>
</div>
<div class="separator separator-rounedd"></div>
<section class="divider">
   <div class="container">
      <div class="row rtl">
         <div class="col-xs-12 col-sm-12 col-md-12 mb-sm-30">
            <h2 class="mt-0 font-30 heading-title-spec">@t('Utilities')</h2>
            <p class="mb-30">@t('Package Description Here Package Description Here Package Description Here Package Description Package Description Here Package Description Package Here Description Package Here')</p>
         </div>
      </div>
      <div class="row rtl">
         <?php if ($productsDecode): ?>
         <?php foreach ($productsDecode as $key => $product): ?>
         <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
            <div class="pricing-table maxwidth400">
            </div>
            <div class=" bg-white border-1px p-30 pt-20 pb-20" style="min-height: 55%;">
               <h3 class="package-type font-24 m-0 mb-20 color-theme-green text-center">{{ $product->name }} </h3>
               <img src="\public\storage\{{ $product->thumbnail }}" alt="{{ $product->name }}">  
               <p>{{ $product->short_description }}</p>
            </div>
            <a href="{{ lang_url('product/'.$product->product_id.'/view') }}" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">@t('File details')</a>
         </div>
         <?php endforeach ?>
         <?php else: ?>
         <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
            <p>@t('No Record Found !')</p>
         </div>
         <?php endif ?>
      </div>
</section>
</div>
<div class="separator separator-rounedd"></div>
<section class="divider">
   <div class="container">
      <div class="row rtl">
         <div class="col-xs-12 col-sm-12 col-md-12 mb-sm-30">
            <h2 class="mt-0 font-30 heading-title-spec">@t('Books')</h2>
            <p class="mb-30">@t('Package description here Package description here Package description here Package description here Package description here Package description Package description here Package description')</p>
         </div>
      </div>
      <div class="row rtl">
         <?php if ($productsDecode1): ?>
         <?php foreach ($productsDecode1 as $key => $product): ?>
         <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
            <div class="bg-white border-1px p-30 pt-20 pb-20 text-center" style="min-height: 91%;">
               <h3 class="package-type font-24 m-0 mb-20 color-theme-green text-center">{{ $product->name }} </h3>
               <img height="340" src="\public\storage\{{ $product->thumbnail }}" alt="{{ $product->name }}">  
               <p>{{ $product->short_description }}</p>
            </div>
            <a href="{{ lang_url('product/'.$product->product_id.'/view') }}" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">@t('File details')</a>
         </div>
         <?php endforeach ?>
         <?php else: ?>
         <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
            <p>@t('No Record Found !')</p>
         </div>
         <?php endif ?>
      </div>
</section>
</div>
<div class="separator separator-rounedd"></div>
<section class="divider">
   <div class="container">
      <div class="row rtl">
         <div class="col-xs-12 col-sm-12 col-md-12 mb-sm-30">
            <h2 class="mt-0 font-30 heading-title-spec">@t('Training activities')</h2>
            <p class="mb-30">@t('Package description here Package description here Package description here Package description here Package description here Package description Package description here Package description')</p>
         </div>
      </div>
      <div class="row rtl">
         <?php if ($schoolNative): ?>
         <?php foreach ($schoolNative as $key => $school): ?>
         <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
            <div class="pricing-table maxwidth400">
            </div>
            <div class=" bg-white border-1px p-30 pt-20 pb-20" style="min-height: 55%;">
               <h3 class="package-type font-24 m-0 mb-20 color-theme-green text-center"><a href="{{ lang_url('school/'.$school->schools->id.'/view') }}">{{ $school->name }}</a></h3>
               <img src="\public\storage\{{ $school->image }}" alt="{{ $school->name }}">  
               <p>{{ $school->description }}</p>
            </div>
            <a href="{{ lang_url('school/'.$school->schools->id.'/view') }}" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">@t('the details') </a>
         </div>
         <?php endforeach ?>
         <?php else: ?>
         <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
            <div class="pricing-table maxwidth400">
            </div>
            <div class=" bg-white border-1px p-30 pt-20 pb-20">
               <p>@t('No Record Found !')</p>
            </div>
         </div>
         <?php endif ?>
      </div>
   </div>
</section>
</div>
<div class="separator separator-rounedd"></div>
<section class="divider">
   <div class="container">
      <div class="row rtl">
         <div class="col-xs-12 col-sm-12 col-md-12 mb-sm-30">
            <h2 class="mt-0 font-30 heading-title-spec">@t('Training activities')</h2>
            <p class="mb-30">@t('Package description here Package description here Package description here Package description here Package description here Package description Package description here Package description')</p>
         </div>
      </div>
      <div class="row rtl">
         <?php if (count($eventNative) > 0): ?>
         <?php foreach ($eventNative as $key => $events): ?>
         <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
            <div class="pricing-table maxwidth400">
            </div>
            <div class=" bg-white border-1px p-30 pt-20 pb-20">
               <h3 class="package-type font-24 m-0 mb-20 color-theme-green text-center">
                  <?php
                     $coach = User::find($events->events->coach_id);
                     if ($coach) {
                         echo $coach->name.' '.$coach->last_name;
                     } else {
                       echo t('User');
                     }
                     ?> 
               </h3>
               <img src="\public\storage\{{ $events->image }}" alt="{{ $events->name }}"> 
               <?php $dt = new DateTime($events->start_date); ?> 
               <p class="color-dark-green font-weight-600 font-16 course-divider">@t('History')<span class="color-theme-green course-span">{{ $dt->format('d-m-Y') }}</span></p>
               <p class="color-dark-green font-weight-600 font-16 course-divider">@t('Type')<span class="color-theme-green course-span">{{ ucwords(str_replace('_', ' ', $events->events->type)) }} </span></p>
               <p class="color-dark-green font-weight-600 font-16 course-divider">@t('Fees')<span class="color-theme-green course-span">{{ $events->events->price }} </span></p>
            </div>
            <?php if ($events->course_enroll_status != 'finish' && $events->course_enroll_status != 'cancelled' && $events->course_enroll_status != 'closed' && $events->course_enroll_status != 'on_hold'): ?>
            <?php if (Auth::check()): ?>
            <?php $enrolledCourse = DB::table('course_subscriptions')->where([['event_id', $events->events->id], ['user_id', Auth::user()->id]])->first(); ?>
            <?php if (!$enrolledCourse): ?>
            <a href="{{ lang_url('events/'.$events->events->id) }}" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">@t('Course details') </a>
            <?php else: ?>
            <span>@t('Note:') <b>@t('You are already Enrolled in this course')</b></span>
            <?php endif ?>
            <?php else: ?>
            <a href="{{ lang_url('events/'.$events->events->id) }}" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">@t('Course details') </a>
            <?php endif ?>
            <?php endif ?>
         </div>
         <?php endforeach ?>
         <?php else: ?>
         <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
            <p class="color-dark-green font-weight-600 font-16 course-divider">
               @t('No Events Found!')
            </p>
         </div>
         <?php endif ?>
      </div>
   </div>
</section>
</div>
<!-- end main-content -->
@push('scripts')
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<script>
   $(document).ready(function() {
     function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();
           reader.onload = function(e) {
               $('#imagePreview').css('background-image', 'url('+e.target.result +')');
               $('#imagePreview').hide();
               $('#imagePreview').fadeIn(650);
           }
           reader.readAsDataURL(input.files[0]);
       }
   }
   $("#imageUpload").change(function() {
       readURL(this);
   });
   });
</script>    
<script>
   $(function () {
   $('[data-toggle="tooltip"]').tooltip()
   });
   $(document).ready(function(){  
   
   var colorPalette = ['000000', 'FF9966', '6699FF', '99FF66', 'CC0000', '00CC00', '0000CC', '333333', '0066FF', 'FFFFFF'];
   var forePalette = $('.fore-palette');
   var backPalette = $('.back-palette');
   
   for (var i = 0; i < colorPalette.length; i++) {
   forePalette.append('<a href="#" data-command="foreColor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
   backPalette.append('<a href="#" data-command="backColor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
   }
   $('.toolbar a').click(function(e) {
   e.preventDefault();
   var command = $(this).data('command');
   if (command == 'h1' || command == 'h2' || command == 'p') {
     document.execCommand('formatBlock', false, command);
   }
   if (command == 'foreColor' || command == 'backColor') {
     var color = $(this).data('value');
     document.execCommand($(this).data('command'), false, color);
     alert(color);
   }
   if (command == 'removeFormat') {
     document.execCommand('removeFormat', false, command);
   }
   if (command == 'createlink' || command == 'insertimage') {
     url = prompt('Enter the link here: ', 'http:\/\/');
     document.execCommand($(this).data('command') && 'enableObjectResizing', false, url);
   } else document.execCommand($(this).data('command'), false, null);
   });
   $('.editorAria img').click(function(){
     document.execCommand('enableObjectResizing', false);
   });
   $("#getHTML").click(function(){
   var editorId = $(this).attr('get-data');
   var html = $("#" + editorId).find('.editorAria').html();
   alert(html);
   });
   });
   
</script>
@endpush