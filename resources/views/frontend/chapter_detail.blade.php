<?php use App\VideoNative; ?>
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
              <a class="btn" href="{{ URL::previous() }}"><i class="fa fa-arrow-right float-left"> &nbsp;</i> Back to Schools </a>
           </div>
        </div>
      </div><!-- /.row -->
      <div class="row">
         <div class="col-md-12">
            <h3>Chapter: <strong>{{ $chapter->name }}</strong></h3>
            <p>Description: {{ $chapter->description }}</p>
         </div>
         <ul class="list-unstyled col-8 offset-2">
            <?php 
              $chapter_id = $chapter->chapters->id;
              $videoNative = VideoNative::with('videos')->whereHas('videos', function ($query) use ($chapter_id) {
                 $query->where('chapter_id', $chapter_id);
              })->where([['lang', Request::locale()], ['status', 'active']])->get();
            ?>
            <?php if (count($videoNative)): ?>
              <?php foreach ($videoNative as $key => $video): ?>
                
               <li class="p-4 mb-5 videos_design_li">
                  <h4>{{ $video->name }}</h4>
                  <p>{{ $video->description }}</p>
                    <?php $decodedVideo = json_decode($video->video_upload); ?>
                  <video oncontextmenu="return false;" controls width="100%" height="530" src="\public\storage\{{ $decodedVideo[0]->download_link }}"></video>
                  <div>
                    <ul class="list-unstyled">
                      <li></li>
                    </ul>
                  </div>
               </li>

              <?php endforeach ?>
            <?php endif ?>
         </ul>
      </div>
   </div>
</div>
@stop