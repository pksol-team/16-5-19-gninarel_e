<?php use App\User; ?>

@extends('frontend.template.layout')
















@section('title') <?= $title; ?> @stop















@section('content')















  <!-- Start main-content -->

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

                    <li class="active text-gray-silver">الخدمات والمنتجات</li>

                </ol>

                <h2 class="title text-white">الانشطة التدريبة </h2>

            </div>

          </div>

        </div>

      </div>

    </section>

      

    <section class="divider">

      <div class="container">

          <div class="row rtl">

              <div class="col-xs-12 col-sm-12 col-md-12 mb-sm-30">

                  <h2 class="mt-0 font-30 heading-title-spec">الانشطة التدريبة</h2>

                  <p class="mb-30">وصف الباقة هناوصف الباقة هناوصف الباقة هناوصف الباقة هناوصف الباقة هناوصف الباقة هناوصف الباقة هناوصف الباقة هنا</p> 

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
                                echo 'User';
                              }
                            ?> </h3>

                  <img src="\public\storage\{{ $events->image }}" alt="{{ $events->name }}"> 
                  <?php $dt = new DateTime($events->start_date); ?> 

                  <p class="color-dark-green font-weight-600 font-16 course-divider">التاريخ<span class="color-theme-green course-span">{{ $dt->format('d-m-Y') }}</span></p>

                  <p class="color-dark-green font-weight-600 font-16 course-divider">النوع<span class="color-theme-green course-span">{{ ucwords(str_replace('_', ' ', $events->events->type)) }} </span></p>

                  <p class="color-dark-green font-weight-600 font-16 course-divider">الرسوم<span class="color-theme-green course-span">{{ $events->events->price }} </span></p>
                  
                </div>
                <?php if ($events->course_enroll_status != 'finish' && $events->course_enroll_status != 'cancelled' && $events->course_enroll_status != 'closed' && $events->course_enroll_status != 'on_hold'): ?>
                  <?php if (Auth::check()): ?>

                    <?php $enrolledCourse = DB::table('course_subscriptions')->where([['event_id', $events->events->id], ['user_id', Auth::user()->id]])->first(); ?>
                    <?php if (!$enrolledCourse): ?>
                      <a href="{{ lang_url('events/'.$events->events->id) }}" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">تفاصيل الدورة </a>
                    <?php else: ?>
                      <span>Note: <b>You are already Enrolled in this course</b></span>
                    <?php endif ?>
                  <?php else: ?>
                      <a href="{{ lang_url('events/'.$events->events->id) }}" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">تفاصيل الدورة </a>
                  <?php endif ?>
                <?php endif ?>
                
            </div> 
     <?php endforeach ?>
  <?php else: ?>
    <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">
      <p class="color-dark-green font-weight-600 font-16 course-divider">
        No Events Found!
      </p>
    </div>


    <?php endif ?>

          </div>   


      </div>

    </section>  

   

      

  </div>

  <!-- end main-content -->























  @stop