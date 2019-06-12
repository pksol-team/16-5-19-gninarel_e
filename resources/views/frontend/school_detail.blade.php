<?php 
   use App\Course;
   use App\ChaptersNative;
   use App\CategoryNative;
   use App\VideoNative;
?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-9">
         <div class="elegant-special-heading-wrapper">
            <h1 class="special-heading-title text-uppercase">{{ $schoolNative->name }}</h1>
         </div>
      </div>
   </div>
</div>
<div class="podcast-detail">
   <div class="row">
      <div class="col-md-3 podcasting-img-desc">
         <div class="podcastimg">
            <img src="\public\storage\{{ $schoolNative->image }}" height="300" alt="{{ $schoolNative->name }}">
         </div>
         <div class="podcast-desc-text">
            <h4>
               <strong>School Description:</strong>
            </h4>
            <p> {{ $schoolNative->description }} </p>
         </div>
      </div>
      <div class="col-md-9">
         <div class="course-detail">
            <div class="row">
               <div class="col-md-12">
                  <h3>Courses:</h3>
                  <div class="">
                     <ul class="list-unstyled">
                     <?php if (count($courseNative) > 0): ?>
                        <?php foreach ($courseNative as $key => $courses): ?>
                        <li class="mb-4">
                           <div class="row">
                              <div class="col-2">
                                 <img src="\public\storage\{{ $courses->image }}" alt="{{ $schoolNative->name }}" />
                              </div>
                              <div class="post-detail col-10">
                                 <div class="podcast-post-content post-content">
                                    <h5 class="blog-shortcode-post-title"><strong>{{ $courses->name }}</strong></h5>
                                    <div class="podcast-post-content-container">
                                       <p>{{ $courses->description }}</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <table class="display table-bordered" width="100%">
                                   <thead>
                                       <tr>
                                           <th>Sr.</th>
                                           <th>Chapters</th>
                                           <th>Hours</th>
                                           <th>Status</th>
                                           <th>&nbsp;</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                    <?php 
                                       $course_id = $courses->courses->id;
                                       $chapterNative = ChaptersNative::with('chapters')->whereHas('chapters', function ($query) use ($course_id) {
                                          $query->where('course_id', $course_id);
                                       })->where([['lang', Request::locale()], ['status', 'active']])->get();
                                     ?>
                                    <?php if (count($chapterNative) > 0): ?>
                                       <?php foreach ($chapterNative as $key => $chapter): ?>
                                         <tr>
                                             <td>{{ $key+1 }}</td>
                                             <td>{{ $chapter->name }}</td>
                                             <td>2</td>
                                             <td>{{ $chapter->status }}</td>
                                             <td><a href="{{ lang_url('chapters/'.$chapter->chapters->id.'/view') }}"><button class="btn btn-default"> View Details</button></a></td>
                                         </tr>
                                       <?php  endforeach ?>
                                    <?php endif ?>
                                   </tbody>
                                 </table>
                              </div><!-- /.col-12 -->
                           </div><!-- /.row -->
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
</div>
@stop