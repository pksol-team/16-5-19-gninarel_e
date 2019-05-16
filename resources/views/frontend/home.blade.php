@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-resources">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="offset-md-4 col-md-4">
         <div class="our_logo">
            <a href="/"><img src="/frontend/assets/img/logo21.png" alt="Logo"></a>
         </div>
      </div>
   </div>
   <div class="row resources">
      <div class="col-md-12">
         <h1 class="text-center"><span>The</span> <span  class="blue_color">All-Inclusive&nbsp;</span><span>Resource For Traders</span></h1>
         <hr class="sep-shadow">
         <h3 class="text-center">
            <span>Training Courses 
            <span>|</span> Custom Software 
            <span class="blue_color">|</span>&nbsp;
            </span>
            <span>Live Trading Rooms 
            <span class="blue_color">|</span>&nbsp;
            </span>
            <span>Expert Analysis 
            <span class="blue_color">|</span> Global Community
            </span>
         </h3>
      </div>
   </div>
   <div class="row video_resource">
      <div class="offset-3 col-md-6">
         <iframe width="100%" height="405" src="https://www.youtube.com/embed/faCiZq1xtuU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
@stop