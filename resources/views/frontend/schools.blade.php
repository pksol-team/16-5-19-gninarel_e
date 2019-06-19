@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-9">
         <div class="elegant-special-heading-wrapper">
            <h1 class="special-heading-title">ALL Schools</h1>
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
             <li class="active"><a class="d-block" href="{{ lang_url('schools') }}"><i class="fa fa-graduation-cap mr-1 ml-1"></i> Electronic School</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('training_activities') }}"><i class="fa fa-tasks mr-1 ml-1"></i> Training Activities</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('communication') }}"><i class="fa fa-address-book-o mr-1 ml-1"></i> Communication</a></li>
             <li class=""><a class="d-block" href="{{ lang_url('logout_frontend') }}"><i class="fa fa-sign-out mr-1 ml-1"></i> Logout</a></li>
           </ul>
         </div>
      </div>
      <div class="col-8">
        <div class="tab-content">
          <div class="row mb-4"><a href="{{ lang_url('plans_pricing') }}"><button class="btn btn-success">Add School</button></a></div><!-- /.row -->
          <table id="school-Datatable" class="display table-bordered" width="100%">
            <thead>
                <tr>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>School Name</th>
                  <th>Package Name</th>
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
             <?php if (count($my_subscriptions) > 0): ?>
                <?php foreach ($my_subscriptions as $key => $subscriptions): ?>
                  <tr>
                    <td>{{ $subscriptions->package_start_date }}</td>
                    <td>{{ $subscriptions->package_end_date }}</td>
                    <td>{{ $subscriptions->name }}</td>
                    <td>{{ $subscriptions->package_name }} Package</td>
                    <td>{{ $subscriptions->status }}</td>
                    <td>
                      @if ($subscriptions->status != "active")
                        <button class="btn btn-default" disabled> View Details</button>
                      @else
                        <a href="{{ lang_url('schools/'.$subscriptions->school_id.'/'.$subscriptions->id.'/view') }}"><button class="btn btn-default"> View Details</button></a>
                      @endif
                    </td>
                  </tr>
                <?php endforeach ?>
             <?php endif ?>
            </tbody>
          </table>
        </div>
      </div>
   </div>
</div>
@stop