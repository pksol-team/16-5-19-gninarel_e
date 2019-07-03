<?php use Illuminate\Support\Facades\DB; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-9">
         <div class="elegant-special-heading-wrapper">
            <h1 class="special-heading-title">Training Activities</h1>
         </div>
      </div>
   </div>
</div>
<div class="podcast-detail pt-5 pb-5">
   <div class="row">
      <div class="col-4 podcasting-img-desc user_prof_listing">
         <div class="">
           <ul class="list-unstyled mt-3">
             <li class=""><a class="d-block" href="{{ lang_url('profile') }}"><i class="fa fa-user-o mr-1 ml-1"></i> Profile</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('all_purchases') }}"><i class="fa fa-shopping-cart mr-1 ml-1"></i> Purchases</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('all_subscriptions') }}"><i class="fa fa-check mr-1 ml-1"></i> Subscription</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('schools') }}"><i class="fa fa-graduation-cap mr-1 ml-1"></i> Electronic School</a></li>
             <li class="active"><a class="d-block" href="{{ lang_url('training_activities') }}"><i class="fa fa-tasks mr-1 ml-1"></i> Training Activities</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('communication') }}"><i class="fa fa-address-book-o mr-1 ml-1"></i> Communication</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('logout_frontend') }}"><i class="fa fa-sign-out mr-1 ml-1"></i> Logout</a></li>
           </ul>
         </div>
      </div>
      <div class="col-8">
        <div class="tab-content">
          <!-- <div class="row mb-4"><a href="{{ lang_url('plans_pricing') }}"><button class="btn btn-success">Add School</button></a></div> -->
          <!-- /.row -->
          <table id="school-Datatable" class="display table-bordered table-responsive" width="100%">
            <thead>
                <tr>
                  <th>Subscription Date</th>
                  <th>Type</th>
                  <th>Classification</th>
                  <th>Title</th>
                  <th>Location</th>
                  <th>Activity Start Date</th>
                  <th>Days</th>
                  <th>Hours</th>
                  <th>Price</th>
                  <th>Total</th>
                  <th>Paid</th>
                  <th>Total Registerd</th>
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
              <?php if (count($training_activities) > 0): ?>
                <?php foreach ($training_activities as $key => $training_activity): ?>
                
                  <tr>
                    <td>
                       <?php 

                         $dt = new DateTime($training_activity->enroll_date);
                         echo $dt->format('d-m-Y');

                      ?>
                    </td>
                    <td>{{ ucwords(str_replace('_', ' ', $training_activity->type)) }}</td>
                    <!-- <td>Training Room/Training Consultant/Coperative Courses/Others/Private Courses</td> -->
                    <td>{{ $training_activity->classification }}</td>
                    <!-- <td>Online/Offsite</td> -->
                    <td>{{ $training_activity->name }}</td>
                    <td>{{ $training_activity->location }}</td>
                    <!-- <td>Online/Hotel/Other/Institution</td> -->
                    <td>
                      <?php 

                        $dt = new DateTime($training_activity->start_date);
                         echo $dt->format('d-m-Y');

                     ?>
                    </td>
                    <td>{{ $training_activity->days }}</td>
                    <td>{{ $training_activity->hours }}</td>
                    <td>
                      <?php 

                          $coperativeActivity = DB::table('course_subscriptions')
                          ->join('courses', 'course_subscriptions.course_id', '=', 'courses.id')
                          ->select('course_subscriptions.*', 'courses.*')
                          ->where([['courses.type', $training_activity->type], ['course_subscriptions.status', 'active']])
                          ->groupBy('course_subscriptions.user_id')
                          ->get();

                      ?>
                      <?php if ($training_activity->type == 'cooperative_courses'): ?>
                        
                          <div class='text-success'><b> {{ $training_activity->price/count($coperativeActivity) }} </b></div>

                      <?php else: ?>
                        {{ $training_activity->price }}
                      <?php endif ?>
                    </td>
                    <td>{{ $training_activity->enroll_price }}</td>
                    <td>{{ $training_activity->paid }}</td>
                    <td>{{ count($coperativeActivity) }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $training_activity->course_enroll_status)) }}</td>

                    <!-- <td>Finish/Open Registration/Inprogress/Cancelled/Delayed/Closed Registration/On hold</td> -->
                    <td>
                      <a href="{{ lang_url($training_activity->subscriptionID.'/activity_detail') }}"><button class="btn btn-default"> View Details</button></a>
                    </td>
                  </tr>

                <?php endforeach ?>
              <?php else: ?>
                <tr>
                  <td colspan="50">You have not enrolled in any course yet</td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>
        </div>
      </div>
   </div>
</div>
@stop