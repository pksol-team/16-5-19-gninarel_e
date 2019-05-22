@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-resources">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="you_need">
      <div class="row">
         <div class="offset-md-4 col-md-4">
            <div class="our_logo">
               <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" alt=""></a>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="offset-md-2 col-md-8">
            <h1 class="text-center"><span  class="blue_color">ABOUT&nbsp;</span><span>US</span></h1>
            <img src="/frontend/assets/img/media/img8.jpg" alt="">
            <p>From the very beginning, the team at ExampleTrading set out to radically change the way we interact with traders. We wanted to make sure that each and everyone of our clients receives the absolute best we have to offer.</p>
            <p>There are many pieces to the trading puzzle, and for the first time ever, we’re able to deliver everything you need through one incredible platform. </p>
            <p>Gone are the days of having to purchase multiple training course to make sure you have access to all the information you need. With your TierONE membership you’ll have unfiltered access to every course we deliver through our platform.</p>
            <p>To date we’ve developed 5 separate training courses so you can start with the absolute basics and then gradually work your way up to more advanced concepts like Fibonacci ratio analysis, trading psychology, money management, and more. Each course has been broken up into modules that contain topic specific lessons, making it easy for you to work at your own pace, track your progress, and focus on the information that is important to you.</p>
            <p>And if that weren’t enough…our goal is to make sure you’re always equipped with the latest information, therefore, your TierONE membership will also include any and all new content added to the platform. We already have new courses and content in development and these will all be made available to you at no additional cost! </p>
         </div>
      </div>
      <div class="row">
         <div class="offset-md-4 col-md-4 text-center">
            <div class="elegant-dual-button">
               <div class="first-btn">
                  <a class="btn" href="plans-pricing.html">See Plans &amp; Pricing</a>
               </div>
               <div class="middle-or">
                  <span>OR</span>
               </div>
            </div>
            <div class="elegant-dual-button">
               <div class="last-btn">
                  <a class="btn" href="14-day-trial.html">
                  <span>Start A 14 Day Trial</span>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop