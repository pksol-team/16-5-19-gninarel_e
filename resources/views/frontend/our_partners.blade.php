@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-logo">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" alt="Logo" class="logo_black"></a>
            <h1 class="text-center"><span>PARTNERS</span></h1>
         </div>
      </div>
   </div>
</div>
<div class="blogs light-grey-gradient">
   <div class="row partners">
      <div class="col-md-4">
         <div class="main-forex">
            <div class="img-forex"> 
               <img src="/frontend/assets/img/partners/corporate.png" class="img-responsive" alt="">
            </div>
            <div class="inner-post-detail">
               <h2 class="text-center blue_color">The Cornerstone</h2>
               <p>Every trader has to start out somewhere and The Cornerstone Course will set you on the right path from the very beginning. In this course you’ll the learn basic concepts of Forex trading and you’ll develop a solid foundation that can sustain years of future success.</p>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="main-forex">
            <div class="img-forex">
               <img src="/frontend/assets/img/partners/gctc.png" class="img-responsive" alt="">
            </div>
            <div class="inner-post-detail">
               <h2 class="text-center blue_color">The Cornerstone</h2>
               <p>Every trader has to start out somewhere and The Cornerstone Course will set you on the right path from the very beginning. In this course you’ll the learn basic concepts of Forex trading and you’ll develop a solid foundation that can sustain years of future success.</p>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="main-forex">
            <div class="img-forex">
               <img src="/frontend/assets/img/partners/maroof.png" alt="">
            </div>
            <div class="inner-post-detail">
               <h2 class="text-center blue_color">The Cornerstone</h2>
               <p>Every trader has to start out somewhere and The Cornerstone Course will set you on the right path from the very beginning. In this course you’ll the learn basic concepts of Forex trading and you’ll develop a solid foundation that can sustain years of future success.</p>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="main-forex">
            <div class="img-forex">
               <img src="/frontend/assets/img/partners/oxygen.png" alt="">
            </div>
            <div class="inner-post-detail">
               <h2 class="text-center blue_color">The Cornerstone</h2>
               <p>Every trader has to start out somewhere and The Cornerstone Course will set you on the right path from the very beginning. In this course you’ll the learn basic concepts of Forex trading and you’ll develop a solid foundation that can sustain years of future success.</p>
            </div>
         </div>
      </div>
   </div>
</div>
@stop