@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-resources">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="you_need">
      <div class="row">
         <div class="offset-md-4 col-md-4">
            <div class="our_logo">
               <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" alt="Logo"></a>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="offset-2 col-md-8">
            <h1 class="text-center"><span  class="blue_color">THANK&nbsp;</span><span>YOU</span></h1>
            <hr class="sep-shadow thank_you_sep-shadow">
            <div class="thanks-box">
               <p class="text-center"><i class="fa fa-check"></i></p>
               <p class="text-center">Thank you For Your Order !</p>
               <p class="text-center"><strong>Questions About You Order</strong> Call : -21-98765432</p>
            </div>
         </div>
      </div>
   </div>
</div>
@stop