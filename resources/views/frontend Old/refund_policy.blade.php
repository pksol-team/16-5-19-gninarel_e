@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-logo">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" alt="Logo" class="logo_black"></a>
         </div>
      </div>
   </div>
</div>
<div class="main-ref">
   <div class="row">
      <div class="col-md-12">
         <div class="ref-text">
            <h2>Refund Policy</h2>
            <p>
               Our refund policy is very simple…we don’t offer them. You are in the business of trading, and at ExampleTrading we treat your order the same way the market would; meaning once your order has been placed and your payment has been processed, there is no turning back, even if things don’t turn out how you expected. If that scares you, or if you have any inclination that our products or services are not right for you, then please do not submit your order. <strong>If you have any questions about what we offer, or if you need further clarification about what your purchase will include, then please don’t hesitate to contact us at (info@ExampleTrading.com), we are happy to answer your questions and help you in any way that we can. </strong>
            </p>
            <p>The truth is our refund policy is strict because we want to promote professionalism in every interaction we have with our clients. Just as we encourage you to perform your due diligence, assess your personal situation, and make an informed decision before you place a trade, we also encourage you to do the same when making the decision to join the community here at ExampleTrading. We give everything we have to help traders succeed, and if we’re going to devote that level of energy and effort then we want to ensure that it’s directed towards individuals who are serious about their future and committed to their success! If that’s not you, then that’s ok. We understand that our services may not be suited for everyone.</p>
            <p>Likewise, as much as we would enjoy the opportunity to work with you, if your financial situation that has you worried about paying your rent, if you’re having to take on debt just to feed your family, or if you’re concerned about being able to afford your medication next month, then we must ask that you resist the temptation to sign up for our services. The last thing we want to do is reply to your email, where you explain your unfortunate financial circumstance and ask for a refund, by sending you a link to this page with a simple note that says “…sorry.” So please don’t put yourself in that awkward situation.</p>
         </div>
      </div>
   </div>
</div>
@stop