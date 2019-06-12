@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-member-ship p-5">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row mt-5">
      <div class="col-8 bg-white p-3">
         <form name="buy_plan_school" id="buy_plan_school" method="POST" action="{{ lang_url('buy_plan_school') }}" class="buy_plan_school">
            @csrf
            <?php
               $date = date("Y-m-d");// current date
               if ($no == '1') {
                  $period = '';
                  
               } else if ($no == '2') {
                  $period = '+1 year';

               } else if ($no == '3') {
                  $period = '+1 month';
                  
               } else if ($no == '4') {
                  $period = '+1 week';                     
               }
               $date = strtotime(date("Y-m-d", strtotime($date)) . $period); 
               $time = date("Y-m-d h:i:s", $date);
            ?>
            @if(session()->has('error'))
            <div class="alert alert-red">
               <ul class="list-unstyled mb-0">
                  <li class="text-white">{!! session()->get('error') !!}</li>
               </ul>
            </div>
            @endif
            <input type="hidden" name="plan_name" value="{{ $plan_name }}" />
            <input type="hidden" name="no" value="{{ $no }}" />
            <input type="hidden" name="price" value="{{ $price }}" />
            <input type="hidden" name="package_start_date" value="{{ date('Y-m-d h:i:s') }}" />
            <input type="hidden" name="package_end_date" value="{{ $time }}" />
            <div class="row contact-form">
               <?php if ($schoolNative): ?>
               <div class="form-group col-12">
                  <label for="school_name">School</label>
                  <select class="form-control" name="school" id="school_name">
                  <?php foreach ($schoolNative as $key => $school): ?>
                     <option value="{{ $school->schools->id }}">{{ $school->name }}</option>
                  <?php endforeach ?>
                  </select>
               </div>
               <?php endif ?>
               <div class="form-group col-12">
                  <label for="price">Membership <small><span class="mbrshp_name">{{ $plan_name }}</span></small></label>
                  <input type="text" class="form-control" value="${{ $price }}" id="price" name="price" placeholder="Enter Last Name" required disabled readonly>
               </div>

               <div class="form-group col-12">
                  <label for="price">Expires on</label>
                  <input type="text" class="form-control" value="{{ $time }}" id="price" name="price" placeholder="Enter Last Name" required disabled readonly>
               </div>
               <button type="submit" class="btn btn-primary">Buy Package</button>
            </div>
         </form>
      </div><!-- /.col-8 -->
   </div><!-- /.row -->
</div>
@stop