<?php 
   use App\Course;
   use App\ChaptersNative;
   use App\CategoryNative;
   use App\VideoNative;
   use App\User_access;
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
      <div class="col-4 podcasting-img-desc user_prof_listing">
         <div class="">
           <ul class="list-unstyled mt-3">
             <li class=""><a class="d-block" href="{{ lang_url('profile') }}"><i class="fa fa-user-o mr-1 ml-1"></i> Profile</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('all_purchases') }}"><i class="fa fa-shopping-cart mr-1 ml-1"></i> Purchases</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('all_subscriptions') }}"><i class="fa fa-check mr-1 ml-1"></i> Subscription</a></li>
             <li class="active"><a class="d-block" href="{{ lang_url('schools') }}"><i class="fa fa-graduation-cap mr-1 ml-1"></i> Electronic School</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('training_activities') }}"><i class="fa fa-tasks mr-1 ml-1"></i> Training Activities</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('communication') }}"><i class="fa fa-address-book-o mr-1 ml-1"></i> Communication</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('logout_frontend') }}"><i class="fa fa-sign-out mr-1 ml-1"></i> Logout</a></li>
           </ul>
         </div>
      </div>
      <div class="col-8">
         <div class="course-detail">
            <div class="row">
               <div class="col-md-12">
                <div class="border mt-4 p-3">
                  <div class="podcastimg text-center">
                     <img class="border" src="\public\storage\{{ $schoolNative->image }}" height="300" alt="{{ $schoolNative->name }}">
                  </div>
                  <div class="podcast-desc-text">
                     <h4>
                        <strong>School Description:</strong>
                     </h4>
                     <p> {{ $schoolNative->description }} </p>
                  </div>
                </div>
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
                                        <?php $last_watched = NULL;  ?>
                                       <?php foreach ($chapterNative as $key => $chapter): ?>
                                         <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $chapter->name }}</td>
                                            <td>2</td>
                                            <td>
                                              <?php 
                                                $watched = User_access::where([['user_id', Auth::user()->id], ['object_type', 'chapter'], ['object_id', $chapter->chapters->id], ['status', 'completed']])->first();
                                                if ($watched) {
                                                  echo 'Watched';
                                                  $last_watched = 1;
                                                } else {
                                                  if ($last_watched === 1) {
                                                    echo 'In Progress';
                                                    $last_watched = NULL;
                                                  } else {
                                                    if ($key == 0) {
                                                      echo 'In Progress';
                                                    } else {
                                                      echo 'Not Watched';
                                                    }
                                                  }
                                                }
                                               ?>
                                            </td>
                                            <?php if ($key == 0): ?>
                                              <td><a href="{{ lang_url('chapters/'.$chapter->chapters->id.'/view') }}"><button class="btn btn-default"> View Details</button></a></td>
                                            <?php else: ?>
                                              <?php 
                                                $videoNative = User_access::where([['user_id', Auth::user()->id], ['object_type', 'chapter'], ['object_id', $last_chapter_id], ['status', 'completed']])->first();
                                              ?>
                                              <?php if ($videoNative): ?>
                                                <td><a href="{{ lang_url('chapters/'.$chapter->chapters->id.'/view') }}"><button class="btn btn-default"> View Details</button></a></td>
                                              <?php else: ?>
                                                 <td><button class="btn btn-default" disabled> View Details</button></td>
                                              <?php endif ?>
                                            <?php endif ?>
                                         </tr>
                                      <?php $last_chapter_id = $chapter->chapter_id; ?>

                                       <?php  endforeach ?>
                                    <?php endif ?>
                                   </tbody>
                                 </table>
                              </div><!-- /.col-12 -->
                           </div><!-- /.row -->
                        </li>
                           <?php endforeach ?>
                        <?php else: ?>
                          <li class="mb-4">
                           <div class="row">
                            <div class="col-12">No Courses Found!</div><!-- /.col-12 -->
                           </div>
                          </li>
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