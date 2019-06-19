@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo_trans.png" alt="Logo" class="logo_black"></a>
            <h1 class="text-center"><span>Purchases</span></h1>
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
        <li class="active"><a class="d-block" href="{{ lang_url('all_purchases') }}"><i class="fa fa-shopping-cart mr-1 ml-1"></i> Purchases</a></li>
        <li class=""><a class="d-block" href="{{ lang_url('all_subscriptions') }}"><i class="fa fa-check mr-1 ml-1"></i> Subscription</a></li>
        <li class=""><a class="d-block" href="{{ lang_url('schools') }}"><i class="fa fa-graduation-cap mr-1 ml-1"></i> Electronic School</a></li>
        <li class=""><a class="d-block" href="{{ lang_url('training_activities') }}"><i class="fa fa-tasks mr-1 ml-1"></i> Training Activities</a></li>
        <li class=""><a class="d-block" href="{{ lang_url('communication') }}"><i class="fa fa-address-book-o mr-1 ml-1"></i> Communication</a></li>
        <li class=""><a class="d-block" href="{{ lang_url('logout_frontend') }}"><i class="fa fa-sign-out mr-1 ml-1"></i> Logout</a></li>
      </ul>
     </div>
     <div class="col-md-8">
       <div class="tab-content">
          <div id="episodes" class="tab-pane fade active show mb-4">
             <div class="row mb-4"><a href=""><button class="btn btn-success">Purchase More</button></a></div><!-- /.row -->
             <table id="school-Datatable" class="display table-bordered" width="100%">
               <thead>
                 <tr>
                     <th>Purchase Date</th>
                     <th>Name</th>
                     <th>Price</th>
                     <th>Details</th>
                 </tr>
               </thead>
               <tbody>
                <?php if ($all_purchases): ?>
                  <?php foreach ($all_purchases as $key => $purchase): ?>
                   
                   <tr>
                       <td>{{ $purchase->created_at }}</td>
                       <td>{{ $purchase->ProductsNative->name }}</td>
                       <td>{{ $purchase->total_price }}</td>
                       <td><a href=""><button class="btn btn-default"> View Details</button></a></td>
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