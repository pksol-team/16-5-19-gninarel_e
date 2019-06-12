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
         <div class="panel-wrapper  pricingtable-column col-md-3">
            <div class="panel-container">
               <div class="main-panel main-panel_last">
                  <div class="panel-heading">
                     <h3 class="title-row">
                        Gold Plan
                     </h3>
                  </div>
                  <div class="panel-body pricing-row">
                     <div class="price ">
                        <span class="currency">$</span>
                        <span class="integer-part">999</span>
                        <span class="time price-without-decimal">Price per month, billed annually until cancelled</span>
                     </div>
                  </div>
                  <ul class="features-ul" style="height:425px;">
                     <li class="featureli">
                        <strong>Lifetime Subscription</strong>
                     </li>
                     <li class="featureli">All Inclusive Membership</li>
                     <li class="featureli">Every Update Guarantee*</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                     <li class="featureli">All Inclusive Membership</li>
                     <li class="featureli">Every Update Guarantee*</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                  </ul>
                  <div class="panel-footer footer-row">
                     <form name="buy_req" id="buy_req" method="POST" action="{{ lang_url('buy_plan') }}" class="buy_req">
                        @csrf
                        <input type="hidden" name="plan_name" value="Gold" />
                        <input type="hidden" name="no" value="1" />
                        <input type="hidden" name="price" value="999" />
                        <button class="btn btn-success btn-lg" type="submit">Buy Now</button>
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-md-2"></div>
         </div>
         <div class="panel-wrapper  pricingtable-column col-md-3">
            <div class="panel-container">
               <div class="main-panel main-panel_last">
                  <div class="panel-heading">
                     <h3 class="title-row">
                        Silver Plan
                     </h3>
                  </div>
                  <div class="panel-body pricing-row">
                     <div class="price ">
                        <span class="currency">$</span>
                        <span class="integer-part">500</span>
                        <span class="time price-without-decimal">Price per month, billed annually until cancelled</span>
                     </div>
                  </div>
                  <ul class="features-ul" style="height:425px;">
                     <li class="featureli">
                        <strong>Annullay Subscription</strong>
                     </li>
                     <li class="featureli">All Inclusive Membership</li>
                     <li class="featureli">Every Update Guarantee*</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                     <li class="featureli">Every Update Guarantee*</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                  </ul>
                  <div class="panel-footer footer-row">
                     <form name="buy_req" id="buy_req" method="POST" action="{{ lang_url('buy_plan') }}" class="buy_req">
                        @csrf
                        <input type="hidden" name="plan_name" value="Silver" />
                        <input type="hidden" name="no" value="2" />
                        <input type="hidden" name="price" value="500" />
                        <button class="btn btn-success btn-lg" type="submit">Buy Now</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="panel-wrapper  pricingtable-column col-md-3">
            <div class="panel-container">
               <div class="main-panel main-panel_last">
                  <div class="panel-heading">
                     <h3 class="title-row">
                        Monthly Plan
                     </h3>
                  </div>
                  <div class="panel-body pricing-row">
                     <div class="price ">
                        <span class="currency">$</span>
                        <span class="integer-part">200</span>
                        <span class="time price-without-decimal">Price per month, billed annually until cancelled</span>
                     </div>
                  </div>
                  <ul class="features-ul" style="height:425px;">
                     <li class="featureli">
                        <strong>1 Month Subscription</strong>
                     </li>
                     <li class="featureli">All Inclusive Membership</li>
                     <li class="featureli">Every Update Guarantee*</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                  </ul>
                  <div class="panel-footer footer-row">
                     <form name="buy_req" id="buy_req" method="POST" action="{{ lang_url('buy_plan') }}" class="buy_req">
                        @csrf
                        <input type="hidden" name="plan_name" value="Monthly" />
                        <input type="hidden" name="no" value="3" />
                        <input type="hidden" name="price" value="200" />
                        <button class="btn btn-success btn-lg" type="submit">Buy Now</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="panel-wrapper pricingtable-column col-md-3">
            <div class="panel-container">
               <div class="main-panel">
                  <div class="panel-heading">
                     <h3 class="title-row">
                        Weekly Plan
                     </h3>
                  </div>
                  <div class="panel-body pricing-row">
                     <div class="price ">
                        <span class="currency">$</span>
                        <span class="integer-part">100</span>
                        <span class="time price-without-decimal">Price per month, billed annually until cancelled</span>
                     </div>
                  </div>
                  <ul class="features-ul" style="height:425px;">
                     <li class="featureli">
                        <strong>1 week Subscription</strong>
                     </li>
                     <li class="featureli">All Inclusive Membership</li>
                     <li class="featureli">Every Update Guarantee*</li>
                     <li class="featureli">Price Lock Guarantee**</li>
                  </ul>
                  <div class="panel-footer footer-row">
                     <form name="buy_req" id="buy_req" method="POST" action="{{ lang_url('buy_plan') }}" class="buy_req">
                        @csrf
                        <input type="hidden" name="plan_name" value="Weekly" />
                        <input type="hidden" name="no" value="4" />
                        <input type="hidden" name="price" value="100" />
                        <button class="btn btn-success btn-lg" type="submit">Buy Now</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div><!-- /.row -->
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