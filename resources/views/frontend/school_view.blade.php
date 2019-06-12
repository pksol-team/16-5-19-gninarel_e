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
            <h1 class="text-center"><span>{{ $schoolNative->name }}</span></h1>
            <div class="img-forex">
               <img src="\public\storage\{{ $schoolNative->image }}" alt="{{ $schoolNative->name }}">
            </div>
            <div class="book-detail">
               <h3 class="mb-2"><strong>School Description:</strong></h3>
              {!! $schoolNative->description !!}
            </div>
            <div>
               <div class="row mt-3">
                  <div class="col-12 p-0">
                     <a class="" href="{{ lang_url('plans_pricing') }}">
                        <button class="btn btn-success w-100">Enroll in</button>
                     </a>
                  </div><!-- /.col-4 -->
               </div><!-- /.row -->
            </div>
         </div>
      </div>
   </div>
</div>
@stop