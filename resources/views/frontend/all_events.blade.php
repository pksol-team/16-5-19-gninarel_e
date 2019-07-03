<?php use App\User; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="elegant-special-heading-wrapper">
            <h1 class="special-heading-title">Events</h1>
         </div>
      </div>
   </div>
</div>
<div class="podcast-detail pt-5 pb-5">
   <div class="row">
     <div class="col-md-12">
       <div class="">
          <ul class="list-unstyled">
          <?php if (count($courseNative) > 0): ?>
             <?php foreach ($courseNative as $key => $courses): ?>
             <li class="mb-4">
                <div class="row">
                   <div class="col-2">
                      <img src="\public\storage\{{ $courses->image }}" alt="{{ $courses->name }}" />
                   </div>
                   <div class="post-detail col-10">
                      <div class="podcast-post-content post-content">
                         <h5 class="blog-shortcode-post-title"><strong>{{ $courses->name }}</strong></h5>
                         <p class="text-dark"><small>Coach: <b>
                           <?php
                              $coach = User::find($courses->courses->coach_id);
                              echo $coach->name.' '.$coach->last_name;
                           ?>
                         </b></small></p>
                         <div class="podcast-post-content-container">

                            <?php $dt = new DateTime($courses->start_date); ?>
                            <p class="m-0">Start Date: <b>{{ $dt->format('d-m-Y') }}</b></p>
                            <p class="m-0">Status: <b>{{ ucwords(str_replace('_', ' ', $courses->course_enroll_status)) }}</b></p>
                            <p class="m-0">Type: <b>{{ ucwords(str_replace('_', ' ', $courses->courses->type)) }}</b></p>
                            <p class="m-0">Description: <b>{{ $courses->description }}</b></p>
                            <p class="m-0">Location: <b>{{ $courses->location }}</b></p>
                            <p class="m-0">Price: <b>{{ $courses->price }}</b></p>
                            <p class="m-0">Classification: <b>{{ $courses->classification }}</b></p>
                            <p class="m-0">Days: <b>{{ $courses->days }}</b></p>
                            <p>Hours: <b>{{ $courses->hours }}</b></p>
                            <?php if ($courses->course_enroll_status != 'finish' && $courses->course_enroll_status != 'cancelled' && $courses->course_enroll_status != 'closed' && $courses->course_enroll_status != 'on_hold'): ?>
                              
                              <form method="POST" action="{{ lang_url('') }}/enroll_course">
                                @csrf
                                  <input type="hidden" name="courses_native_id" value="{{ $courses->id }}" />
                                  <button class="btn btn-success" type="submit">Enroll in</button>
                              </form>

                            <?php endif ?>


                         </div>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-12">
                      
                   </div><!-- /.col-12 -->
                </div><!-- /.row -->
             </li>
             <hr />
                <?php endforeach ?>
             <?php else: ?>
               <li class="mb-4">
                <div class="row">
                 <div class="col-12">No Events Found!</div><!-- /.col-12 -->
                </div>
               </li>
             <?php endif ?>
          </ul>
       </div> 
     </div>
   </div>
   
</div>
@stop