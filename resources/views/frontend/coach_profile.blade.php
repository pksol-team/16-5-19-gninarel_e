@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Start main-content -->
<div class="main-content">
   <!-- Section: inner-header -->
   <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="/frontend/_assets/images/breadcrumb-bg.png">
      <div class="container pt-70 pb-20">
         <!-- Section Content -->
         <div class="section-content">
            <div class="row">
               <div class="col-md-12">
                  <ol class="breadcrumb text-right text-black mb-0 mt-40">
                     <li><a href="{{ lang_url('') }}">@t('the main page')</a></li>
                     <li class="active text-gray-silver">@t('For the best direction')</li>
                     <li class="active text-gray-silver">@t('Trainers')</li>
                  </ol>
                  <h2 class="title text-white">@t('Free Membership')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: profile -->
   <section class="divider">
      <div class="container">
         <div class="row">
            <div class="col-md-10 col-md-offset-1">
               <div class="blog-posts single-post">
                  <article class="post clearfix mb-0">
                     <div class="entry-header">
                        <div class="post-thumb thumb"> <img src="\public\storage\{{ $allCoaches->users->avatar }}" alt="{{ $allCoaches->users->name }}" class="img-responsive img-fullwidth"> </div>
                     </div>
                     <div class="entry-title pt-10 pl-15">
                        <h4 class="color-theme-green font-weight-600">@t('About')</h4>
                     </div>
                     <div class="entry-content mt-10">
                        <p class="mb-15">{{ $allCoaches->users->about }}</p>
                     </div>
                     <div class="clearfix"></div>
                  </article>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section>
      <div class="container">
         <div class="section-content">
            <div class="row">
               <div class="col-md-12 text-center mt-30">
                  <h4 class="text-center">@t('Around...')</h4>
                  <ul class="styled-icons flat medium list-inline mb-40">
                     <?php if ($allCoaches->users->instagram != '' && $allCoaches->users->instagram != NULL): ?>
                     <li><a target="_blank" href="{{ strstr( $allCoaches->users->instagram, 'http' ) ? $allCoaches->users->instagram : 'https://'.$allCoaches->users->instagram }}"><i class="fa fa-instagram"></i></a> </li>
                     <?php endif ?>
                     <?php if ($allCoaches->users->facebook != '' && $allCoaches->users->facebook != NULL): ?>
                     <li><a target="_blank" href="{{ strstr( $allCoaches->users->facebook, 'http' ) ? $allCoaches->users->facebook : 'https://'.$allCoaches->users->facebook }}"><i class="fa fa-facebook"></i></a> </li>
                     <?php endif ?>
                     <?php if ($allCoaches->users->twitter != '' && $allCoaches->users->twitter != NULL): ?>
                     <li><a target="_blank" href="{{ strstr( $allCoaches->users->twitter, 'http' ) ? $allCoaches->users->twitter : 'https://'.$allCoaches->users->twitter }}"><i class="fa fa-twitter"></i></a> </li>
                     <?php endif ?>
                     <?php if ($allCoaches->users->youtube != '' && $allCoaches->users->youtube != NULL): ?>
                     <li><a target="_blank" href="{{ strstr( $allCoaches->users->youtube, 'http' ) ? $allCoaches->users->youtube : 'https://'.$allCoaches->users->youtube }}"><i class="fa fa-youtube"></i></a> </li>
                     <?php endif ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop