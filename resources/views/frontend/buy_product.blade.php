@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-title">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="/"><img src="/frontend/assets/img/logo21.png" alt="" class="logo_black"></a>
            <h1 class="text-center"><span>Checkout form</span></h1>
         </div>
      </div>
   </div>
</div>
<div class="all-books checkout">
   <form name="checkoutForm" id="checkoutForm" method="POST" action="{{ lang_url('checkout_post') }}" class="checkoutForm">
    @csrf
   <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
         <ul class="list-group mb-3">
           <li class="list-group-item d-flex justify-content-between lh-condensed">
             <div>
               <h6 class="my-0">{{ $productNativeDecode->name }}</h6>
               <small class="text-muted">{{ $productNativeDecode->short_description }}</small>
             </div>
             <span class="text-muted book_price">$ <input type="text" name="product_price" class="book_price_main" value="{{ $productNativeDecode->price }}"></span>

           </li>
           <li class="list-group-item d-flex justify-content-between lh-condensed">
             <h6 class="my-0 quantity-h">Quantity</h6>
             <div class="qty-changer">
               <button class="qty-change minus">-</button>
               <input class="qty-input form-group" name="qty-input" type="number" min="1" value="1" readonly>
               <button class="qty-change plus">+</button>
             </div>
           </li>
           <li class="list-group-item d-flex justify-content-between">
             <h6 class="my-0">Total Price</h6>
             <span class="text-muted total_price"><strong>$<span>{{ $productNativeDecode->price }}</span></strong></span>
             <input name="total_price_hidden" type="hidden" min="{{ $productNativeDecode->price }}" value="{{ $productNativeDecode->price }}">
             <input name="product_native_id" type="hidden" value="{{ $productNativeDecode->id }}">
           </li>
         </ul>
      </div>
      <div class="col-md-8 order-md-1">
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
           <div class="col-md-12 mb-3 text-center">
              <button class="btn submmit" type="submit">Proceed</button>
           </div>
        </div>
      </div>
   </div>
   </form>
</div>
@stop