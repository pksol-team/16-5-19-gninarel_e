@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-member-ship">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12 text-center new-member">
         <h3><button type="btn">New Membership Plans Available Now</button></h3>
         <div class="our_logo">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" alt=""></a>
         </div>
         <p>Select from one of our new extended membership plans to <br> lock in massive savings for the lifetime of your membership. </p>
      </div>
   </div>
   <div class="pricing-table">
      <div class="row">
         <div class="panel-wrapper active pricingtable-column col-md-4">
            <div class="panel-container">
               <div class="main-panel">
                  <div class="panel-heading">
                     <h3 class="title-row">
                        Free Plan
                     </h3>
                  </div>
                  <div class="panel-body pricing-row">
                     <div class="price ">
                        <span class="currency">$</span>
                        <span class="integer-part">00</span>
                        <span class="time price-without-decimal">Price per month, billed annually until cancelled</span>
                     </div>
                  </div>
                  <ul class="features-ul">
                     <li class="featureli">
                        <strong>1 Month FREE</strong>
                     </li>
                     <li class="featureli">All Inclusive Membership</li>
                     <li class="featureli">Every Update Guarantee*</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                  </ul>
                  <div class="panel-footer footer-row">
                     <a target="_self" href="{{ lang_url('register') }}">Sign Up Now</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="panel-wrapper  pricingtable-column col-md-4">
            <div class="panel-container">
               <div class="main-panel">
                  <div class="panel-heading">
                     <h3 class="title-row">
                        14 Days Plan
                     </h3>
                  </div>
                  <div class="panel-body pricing-row">
                     <div class="price ">
                        <span class="currency">$</span>
                        <span class="integer-part">247</span>
                        <span class="time price-without-decimal">Price per month, billed annually until cancelled</span>
                     </div>
                  </div>
                  <ul class="features-ul">
                     <li class="featureli">
                        <strong>2 Months FREE</strong>
                     </li>
                     <li class="featureli">All Inclusive Membership</li>
                     <li class="featureli">Every Update Guarantee*</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                  </ul>
                  <div class="panel-footer footer-row">
                     <a target="_self" href="{{ lang_url('register') }}">Sign Up Now</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="panel-wrapper  pricingtable-column col-md-4">
            <div class="panel-container">
               <div class="main-panel main-panel_last">
                  <div class="panel-heading">
                     <h3 class="title-row">
                        1 Month Plan
                     </h3>
                  </div>
                  <div class="panel-body pricing-row">
                     <div class="price ">
                        <span class="currency">$</span>
                        <span class="integer-part">294</span>
                        <span class="time price-without-decimal">Price per month, billed annually until cancelled</span>
                     </div>
                  </div>
                  <ul class="features-ul">
                     <li class="featureli">
                        <strong>2 Months FREE</strong>
                     </li>
                     <li class="featureli">All Inclusive Membership</li>
                     <li class="featureli">Every Update Guarantee*</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                  </ul>
                  <div class="panel-footer footer-row">
                     <a target="_self" href="{{ lang_url('register') }}">Sign Up Now</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-2"></div>
         <div class="panel-wrapper  pricingtable-column col-md-4">
            <div class="panel-container">
               <div class="main-panel main-panel_last">
                  <div class="panel-heading">
                     <h3 class="title-row">
                        Annual
                     </h3>
                  </div>
                  <div class="panel-body pricing-row">
                     <div class="price ">
                        <span class="currency">$</span>
                        <span class="integer-part">294</span>
                        <span class="time price-without-decimal">Price per month, billed annually until cancelled</span>
                     </div>
                  </div>
                  <ul class="features-ul">
                     <li class="featureli">
                        <strong>2 Months FREE</strong>
                     </li>
                     <li class="featureli">All Inclusive Membership</li>
                     <li class="featureli">Every Update Guarantee*</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                  </ul>
                  <div class="panel-footer footer-row">
                     <a target="_self" href="{{ lang_url('register') }}">Sign Up Now</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="panel-wrapper  pricingtable-column col-md-4">
            <div class="panel-container">
               <div class="main-panel main-panel_last">
                  <div class="panel-heading">
                     <h3 class="title-row">
                        Lifetime 
                     </h3>
                  </div>
                  <div class="panel-body pricing-row">
                     <div class="price ">
                        <span class="currency">$</span>
                        <span class="integer-part">999</span>
                        <span class="time price-without-decimal">Price per month, billed annually until cancelled</span>
                     </div>
                  </div>
                  <ul class="features-ul">
                     <li class="featureli">
                        <strong>FREE</strong>
                     </li>
                     <li class="featureli">All Inclusive Membership</li>
                     <li class="featureli">Every Update Guarantee*</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                  </ul>
                  <div class="panel-footer footer-row">
                     <a target="_self" href="{{ lang_url('register') }}">Sign Up Now</a>
                  </div>
               </div>
            </div>
            <div class="col-md-2"></div>
         </div>
      </div>
   </div>
   <div class="pricing-disclimar">
      <div class="row">
         <div class="col-md-12">
            <div class="pricing-disclimar-text">
               <p>
                  <span>Every Update Guarantee*- 
                  <em>Your TierONE membership includes access to every future update &amp; addition we make to the platform at no extra charge to you. This means new courses, new software, etc. are all included and this will remain effective for as long as your keep your membership active. With an active membership you’ll never have to work about costly up-sells, hidden fees, or missing out on the next awesome update.&nbsp;</em>&nbsp;
                  </span>
               </p>
               <p>
                  <span>Price Lock Guarantee**- 
                  <em>If you sign up for a TierONE membership and receive a promotional price, then we will honor that price for as long as you keep your membership active. You’ll never have to worry about unexpected price increases from one month to the next. However, if you cancel your membership and decide to return, you will have to do so at the current market rate.&nbsp;</em>
                  </span>
               </p>
            </div>
         </div>
      </div>
   </div>
</div>
@stop