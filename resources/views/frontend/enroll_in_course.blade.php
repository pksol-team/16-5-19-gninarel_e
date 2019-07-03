@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-title">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="/"><img src="/frontend/assets/img/logo21.png" alt="" class="logo_black"></a>
            <h4 class="text-center"><span>Enroll in Course: {{ $courseNative->name }}</span></h4>
         </div>
      </div>
   </div>
</div>
<div class="all-books checkout">
   <form name="checkoutForm" id="checkoutForm" method="POST" action="{{ lang_url('') }}/enroll_form" class="checkoutForm">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
    <input type="hidden" name="course_id" value="{{ $courseNative->courses->id }}" />
   <div class="row">
      <div class="col-md-10 order-md-1">
        <div class="row">
           <div class="col-md-12 mb-3">
              <label for="first_name">Course Price: <b>{{ $courseNative->price }}</b></label>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12 mb-3">
              <label for="first_name">First name</label>
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required>
              <div class="invalid-feedback">
                 Valid first name is required.
              </div>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12 mb-3">
              <label for="last_name">Last name</label>
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required>
              <div class="invalid-feedback">
                 Valid last name is required.
              </div>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12 mb-3">
              <label for="user_address">Address</label>
              <input type="text" class="form-control" id="user_address" name="user_address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                 Please enter your shipping address.
              </div>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12 mb-3">
              <label for="user_address">Amount Paid</label>
              <input type="number" class="form-control" id="paid" name="paid" placeholder="Amount you are paying">
              <div class="invalid-feedback">
                 Please enter amount you are paying
              </div>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12 mb-3 text-center">
              <button class="btn submmit" type="submit">Proceed</button>
           </div>
        </div>
      </div>
   </div>
   </form>
</div>
@stop