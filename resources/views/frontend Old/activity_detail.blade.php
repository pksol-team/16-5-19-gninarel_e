<?php use App\User; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="container pt-50 pb-50">
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="elegant-special-heading-wrapper">
            <h1 class="special-heading-title" style="color: #41a161;">Activity Detail</h1>
         </div>
      </div>
   </div>
</div>
<div class="podcast-detail pt-5 pb-5" style="padding: 10px 0 ">
   <div class="row">
     <div class="col-md-12" style="overflow-x: scroll;">
       <table class="activity-detail table-bordered">
        <thead>
          
         <tr>
           <th>Event Subject</th>
           <th>Subscription date</th>
           <th>Event Type</th>
           <th>Event Classification</th>
           <th>Venue</th>
           <th>Event Date</th>
           <!-- <th>Period (days)</th> -->
           <th>Hours</th>
           <th>Price (SAR)</th>
           <th>Paid (SAR)</th>
           <th>Balance (SAR)</th>
           <th>Payment Status</th>
           <th>Number of students</th>
           <th>Status</th> 
           <?php if ($training_activity->payment_status == 'Partially Paid'): ?>
             <th>Pay Remaining</th>
           <?php endif ?>
         </tr>

        </thead>
        <tbody>
          <tr>
            <td>{{ $training_activity->name }}</td>
            <td>
               <?php 

                 $dt = new DateTime($training_activity->enroll_date);
                 echo $dt->format('d-m-Y');

              ?>
            </td>
            <td>{{ ucwords(str_replace('_', ' ', $training_activity->type)) }}</td>
            <td>{{ $training_activity->classification }}</td>
            <td>{{ $training_activity->location }}</td>
            <td>
              <?php 

                $dt = new DateTime($training_activity->start_date);
                 echo $dt->format('d-m-Y');

             ?>
            </td>
            <!-- <td>{{-- $training_activity->days --}}</td> -->
            <td>{{ $training_activity->hours }}</td>
            <td>
              <?php 

                  $coperativeActivity = DB::table('course_subscriptions')
                  ->join('events', 'course_subscriptions.event_id', '=', 'events.id')
                  ->select('course_subscriptions.*', 'events.*')
                  ->where([['events.type', $training_activity->type], ['course_subscriptions.status', 'active']])
                  ->groupBy('course_subscriptions.user_id')
                  ->get();

              ?>
              <?php if ($training_activity->type == 'cooperative_courses'): ?>
                
                  <div class='text-success'><b> {{ $training_activity->price/count($coperativeActivity) }} </b></div>

              <?php else: ?>
                {{ $training_activity->price }}
              <?php endif ?>
            </td>
            <td>{{ $training_activity->paid }}</td>
            <td>
              <?php if ($training_activity->type == 'cooperative_courses'): ?>
                

              <?php else: ?>
                <?php $remaining = $training_activity->price - $training_activity->paid; ?>

                  {{ $remaining  }}
              <?php endif ?>

            </td>
            <td>{{ $training_activity->payment_status }}</td>
            <td>{{ count($coperativeActivity) }}</td>
            <td>{{ ucwords(str_replace('_', ' ', $training_activity->course_enroll_status)) }}</td>
            <?php if ($training_activity->payment_status == 'Partially Paid'): ?>
              <td>
                 <a href="{{ lang_url($training_activity->event_id.'/payment_course/'.$training_activity->subscriptionID ) }}"><button class="btn btn-default">Pay</button></a>
             </td>
           <?php endif ?>

          </tr>
          
        </tbody>
       </table> 
     </div>
   </div>
   <div class="row">
     <div class="col-lg-12">
       <table class="activity-detail-one">
         <tr>
           <td>Coach</td>
           <td>
            <?php 

              $coach = User::findOrFail($training_activity->coach_id);
              echo $coach->name.' '.$coach->last_name;

             ?>

           </td>
         </tr>
         <tr>
           <td>Venue Details</td>
           <td>{{ $training_activity->location }}</td>
         </tr>
         <tr>
           <td>Description</td>
           <td>{{$training_activity->description}}</td>
         </tr>
         <!-- <tr>
           <td>Days</td>
           <td>{{-- $training_activity->days --}}</td>
         </tr> -->
         <!-- <tr>
           <td>Time</td>
           <td>From 6:30 PM to 9:30 PM</td>
         </tr>
         <tr>
           <td>Spesefication</td>
           <td>Free Master File</td>
         </tr>
         <tr>
           <td></td>
           <td>Free Book</td>
         </tr>
         <tr>
           <td></td>
           <td>Free online access for a month</td>
         </tr> -->
       </table> 
     </div>
   </div>
</div>
</div>
@stop