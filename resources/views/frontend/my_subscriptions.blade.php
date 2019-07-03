@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo_trans.png" alt="Logo" class="logo_black"></a>
            <h1 class="text-center"><span>Subscriptions</span></h1>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-9">
      </div>
   </div>
</div>
<div class="podcast-detail user_prof_listing">
  <div class="row">
     <div class="col-md-4">
      <ul class="list-unstyled mt-3">
        <li class=""><a class="d-block" href="{{ lang_url('profile') }}"><i class="fa fa-user-o mr-1 ml-1"></i> Profile</a></li>
        <li class=""><a class="d-block" href="{{ lang_url('all_purchases') }}"><i class="fa fa-shopping-cart mr-1 ml-1"></i> Purchases</a></li>
        <li class="active"><a class="d-block" href="{{ lang_url('all_subscriptions') }}"><i class="fa fa-check mr-1 ml-1"></i> Subscription</a></li>
        <li class=""><a class="d-block" href="{{ lang_url('schools') }}"><i class="fa fa-graduation-cap mr-1 ml-1"></i> Electronic School</a></li>
        <li class=""><a class="d-block" href="{{ lang_url('training_activities') }}"><i class="fa fa-tasks mr-1 ml-1"></i> Training Activities</a></li>
        <li class=""><a class="d-block" href="{{ lang_url('communication') }}"><i class="fa fa-address-book-o mr-1 ml-1"></i> Communication</a></li>
        <li class=""><a class="d-block" href="{{ lang_url('logout_frontend') }}"><i class="fa fa-sign-out mr-1 ml-1"></i> Logout</a></li>
      </ul>
     </div>
     <div class="col-md-8">
       <div class="tab-content">
          <div id="episodes" class="tab-pane fade active show mb-4">
             <div class="row mb-4"><a href="{{ lang_url('plans_pricing') }}"><button class="btn btn-success">Subscriptions</button></a></div><!-- /.row -->
             <table id="school-Datatable" class="display table-bordered" width="100%">
               <thead>
                 <tr>
                     <th>Start Date</th>
                     <th>End Date</th>
                     <th>Days Left</th>
                     <th>Package Name</th>
                     <th>Price</th>
                     <th>Status</th>
                 </tr>
               </thead>
               <tbody>
                <?php if ($my_subscriptions): ?>
                  <?php foreach ($my_subscriptions as $key => $subscriptions): ?>
                   <tr>
                       <td>
                         <?php 

                           $dt = new DateTime($subscriptions->package_start_date);
                           echo $dt->format('d-m-Y');

                        ?>
                       </td>
                       <td>
                          <?php 

                            $dt = new DateTime($subscriptions->package_end_date);
                            echo $dt->format('d-m-Y');

                         ?>
                       </td>
                       <td>
                        <?php
                          if ($subscriptions->package_name != 'Gold') {
                            $expiry_date = $subscriptions->package_end_date;
                            $current_date = time();
                            $seconds_to_expire = strtotime($expiry_date) - $current_date;
                            $days_to_expire = floor($seconds_to_expire/86400);
                            echo ($days_to_expire < 0) ? '0' : $days_to_expire;
                          }
                        ?>
                       </td>
                       <td>{{ $subscriptions->package_name }}</td>
                       <td>{{ $subscriptions->package_price }}</td>
                       <td>{{ $subscriptions->status }}</td>
                   </tr>

                  <?php endforeach ?>
                <?php endif ?>
               </tbody>
             </table>
          </div>
       </div>
     </div>
  </div>
</div>
@stop