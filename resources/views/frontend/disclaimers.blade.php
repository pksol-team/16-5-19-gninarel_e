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
            <h2>@t('Disclaimers')</h2>
            <p>@t('DisclaimersText')</p>
         </div>
      </div>
   </div>
</div>
@stop