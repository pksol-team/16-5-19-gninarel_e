@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-resources">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="you_need">
      <div class="row">
         <div class="offset-md-4 col-md-4">
            <div class="our_logo">
               <a href="/"><img src="/frontent/assets/img/logo21.png" alt=""></a>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="offset-md-2 col-md-8">
            <h1 class="text-center"> <span class="blue_color"> Video Title </span></h1>
            <video controls autobuffer poster="/frontent/assets/img/cornerstone.png" width="100%" height="530">
               <source src="/frontent/assets/video/video1.mp4">
            </video>
            <p>From the very beginning, the team at ExampleTrading set out to radically change the way we interact with traders. We wanted to make sure that each and everyone of our clients receives the absolute best we have to offer.</p>
            <p>There are many pieces to the trading puzzle, and for the first time ever, we’re able to deliver everything you need through one incredible platform. </p>
         </div>
      </div>
   </div>
</div>
@stop