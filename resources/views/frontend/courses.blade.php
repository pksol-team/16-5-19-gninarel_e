@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-9">
         <div class="elegant-special-heading-wrapper">
            <h1 class="special-heading-title">@t('ALL COURSES')</h1>
            <!-- <p class="special-heading-description">By Akil Stokes: Trading - Investing - Entrepreneurship - Motivation</p> -->
         </div>
      </div>
   </div>
</div>
<div class="podcast-detail">
   <div class="row">
      <div class="col-md-8">
         <div class="rating-Episodes-view">
            <ul class="nav nav-tabs">
               <li>
                  <a data-toggle="tab" href="#episodes" class="active show">
                  <i class="fa fa-graduation-cap"></i>@t('Courses')
                  </a>
               </li>
            </ul>
            <div class="tab-content">
               <div id="episodes" class="tab-pane fade active show">
                  <ul>

                     <?php if (count($courseNative) > 0): ?>
                        <?php foreach ($courseNative as $key => $course): ?>
                           <li class="row">
                              <div class="date-and-formats">
                                 <div class="podcast-date-box updated">
                                    <span class="podcast-date">{{ date("d", strtotime($course->created_at)) }}</span>
                                    <span class="podcast-month-year">{{ date("m, Y", strtotime($course->created_at)) }}</span>
                                 </div>
                              </div>
                              <div class="post-img">
                                 <img src="\public\storage\{{ $course->image }}" alt="{{ $course->name }}" />
                              </div>
                              <div class="post-detail">
                                 <div class="podcast-post-content post-content">
                                    <h2 class="blog-shortcode-post-title">
                                       <a href="{{ lang_url('courses/'.$course->courses->id.'/view') }}">{{ $course->name }}</a>
                                    </h2>
                                    <p class="podcast-single-line-meta">
                                       <span></span>
                                    </p>
                                    <div class="podcast-post-content-container">
                                       <p>{{ $course->description }}</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12 text-right">
                                 <a class="readmore" href="{{ lang_url('courses/'. $course->courses->id.'/view') }}">@t('Read More')</a>
                              </div>
                           </li>
                        <?php endforeach ?>
                     <?php endif ?>
                     
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop