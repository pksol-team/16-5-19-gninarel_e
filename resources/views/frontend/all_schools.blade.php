@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-title">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" alt="" class="logo_black"></a>
            <h1 class="text-center"><span>Schools</span></h1>
         </div>
      </div>
   </div>
</div>
<div class="all-books all-schools">
   <div class="row">
      <div class="col-md-12">
         <ul class="list-unstyled">
          <?php if ($schoolNative): ?>
            <?php foreach ($schoolNative as $key => $school): ?>

              <li class="d-inline-block bg-white border p-0 mr-4 ml-4 school_listing">
                <div class="main">
                  <div class="text-center">
                    <h3 class="text-dark"><a href="{{ lang_url('school/'.$school->schools->id.'/view') }}">{{ $school->name }}</a></h3>
                    <img class="mb-2 w-100 border" src="\public\storage\{{ $school->image }}" alt="{{ $school->name }}">
                    <span>{{ $school->description }}</span>
                    <a href="{{ lang_url('school/'.$school->schools->id.'/view') }}" class="row mt-3 mb-3"><button class="btn btn-success w-100">Details</button></a>
                  </div><!-- /.col-4 -->
                </div><!-- /.row -->
              </li>
              
            <?php endforeach ?>
          <?php else: ?>
            <li class="row">
              <div class="col-md-12">
                <div class="post-detail">
                   <div class="podcast-post-content post-content">
                      <h2 class="blog-shortcode-post-title">
                         No Record Found !
                      </h2>
                   </div>
                </div>
              </div>
            </li>
          <?php endif ?>
         </ul>
      </div>
   </div>
</div>
@stop