@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-title">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" class="logo_black"></a>
            <h1 class="text-center"><span>@t('Checkout form')</span></h1>
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
                  <h6 class="my-0 quantity-h">@t('Quantity')</h6>
                  <div class="qty-changer">
                     <button class="qty-change minus">-</button>
                     <input class="qty-input form-group" name="qty-input" type="number" min="1" value="1" readonly>
                     <button class="qty-change plus">+</button>
                  </div>
               </li>
               <li class="list-group-item d-flex justify-content-between">
                  <h6 class="my-0">@t('Total Price')</h6>
                  <span class="text-muted total_price"><strong>$<span>{{ $productNativeDecode->price }}</span></strong></span>
                  <input name="total_price_hidden" type="hidden" min="{{ $productNativeDecode->price }}" value="{{ $productNativeDecode->price }}">
                  <input name="product_native_id" type="hidden" value="{{ $productNativeDecode->id }}">
               </li>
            </ul>
         </div>
         <div class="col-md-8 order-md-1">
            <div class="row">
               <div class="col-md-12 mb-3">
                  <label for="first_name">@t('First name')</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="@t('First name')" required>
                  <div class="invalid-feedback">
                     @t('Valid first name is required.')
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 mb-3">
                  <label for="last_name">@t('Last name')</label>
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="@t('Last name')" required>
                  <div class="invalid-feedback">
                     @t('Valid last name is required.')
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 mb-3">
                  <label for="user_address">@t('Address')</label>
                  <input type="text" class="form-control" id="user_address" name="user_address" placeholder="@t('1234 Main St')" required>
                  <div class="invalid-feedback">
                     @t('Please enter your shipping address.')
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 mb-3 text-center">
                  <button class="btn submmit" type="submit">@t('Proceed')</button>
               </div>
            </div>
         </div>
      </div>
   </form>
</div>
<!-- ADD NEW JOB MODAL -->
<div class="modal fade" id="pay-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center color-theme-green font-weight-700 font-26 mt-20 mb-10" id="myModalLabel">@t('Order the product after the conversion')</h4>
            <p class="color-dark-green text-right">@t('Please fill out the form after the transfer process on our bank account')</p>
            <p class="text-gray mb-0 text-right">@t('Bank information'):</p>
            <p class="text-gray mb-0 text-right">@t('Bank name'): <span>@t('First Bank')</span></p>
            <p class="text-gray mb-0 text-right">@t('account number'): <span>@t(' 33333333332323')</span></p>
            <p class="text-gray mb-0 text-right">@t('IBAN'): <span>@t('sasasasasasasasasas') </span></p>
         </div>
         <div class="modal-body">
            <!-- add new job Form -->
            <form id="add_job" name="add_job" class="form-inline" action="" method="post" novalidate="novalidate">
               <div class="row">
                  <div class="col-md-12 col-sm-12">
                     <div class="col-sm-12 p-0">
                        <div class="form-group mb-30">
                           <label for="name">@t('The name')</label>
                           <input id="name" name="name" class="form-control" type="text" placeholder="@t('The name')" required="" aria-required="true">
                        </div>
                     </div>
                     <div class="col-sm-12 p-0">
                        <div class="form-group mb-30">
                           <label for="city">@t('City')</label>
                           <select class="form-control" id="city">
                              <option>@t('Riyadh')</option>
                              <option>@t('2')</option>
                              <option>@t('3')</option>
                              <option>@t('4')</option>
                              <option>@t('5')</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-12 p-0">
                        <div class="form-group mb-30">
                           <label for="account-number">@t('Account')</label>
                           <input id="account-number" name="account-number" class="form-control" type="text" placeholder="@t('account number')" required="" aria-required="true">
                        </div>
                     </div>
                     <div class="col-sm-12 p-0">
                        <div class="form-group mb-30">
                           <label for="amount">@t('Amount transferred')</label>
                           <input id="amount" name="amount" class="form-control" type="text" placeholder="@t('Amount transferred')" required="" aria-required="true">
                        </div>
                     </div>
                     <div class="col-sm-12 p-0">
                        <div class="form-group mb-30">
                           <label for="mobile">@t('Mobile number')</label>
                           <input id="mobile" name="mobile" class="form-control" type="text" placeholder="@t('Mobile number')" required="" aria-required="true">
                        </div>
                     </div>
                     <div class="col-sm-12 p-0">
                        <div class="form-group mb-30">
                           <label for="email">@t('E-mail')</label>
                           <input id="email" name="email" class="form-control" type="email" placeholder="@t('Email')" required="" aria-required="true">
                        </div>
                     </div>
                     <div class="col-sm-12 p-0">
                        <div class="form-group mb-0">
                           <label for="job_end">@t('Transfer receipt')</label>
                           <div class="file-input-wrapper">
                              <label for="upload-file" class="file-input-button">@t('review')</label>
                              <input id="upload-file" type="file" name="file1" />
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer text-center mb-30">
            <button type="button" class="btn btn-dark btn-flat btn-theme-green">@t('Order the product')</button>
         </div>
      </div>
   </div>
</div>
@stop