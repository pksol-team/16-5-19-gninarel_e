@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-resources">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="you_need">
      <div class="row">
         <div class="offset-md-4 col-md-4">
            <div class="our_logo">
               <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" alt="Logo"></a>
            </div>
         </div>
      </div>
      <div class="row">
        <div class="elegant-dual-button">
           <div class="first-btn">
              <a class="btn" href="{{ lang_url('courses/'.$course_id.'/view') }}"><i class="fa fa-arrow-right float-left"> &nbsp;</i> Back to Course </a>
           </div>
        </div>
      </div><!-- /.row -->
      <div class="row">
         <div class="offset-md-2 col-md-8">
            <h1 class="text-center"> <span class="blue_color"> {{ $videoNative->name }} </span></h1>
              <?php $decodedVideo = json_decode($videoNative->video_upload); ?>
            <video controls width="100%" height="530" src="\public\storage\{{ $decodedVideo[0]->download_link }}"></video>
            <p>{{ $videoNative->description }}</p>
         </div>
      </div>
   </div>
</div>
@stop