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
         <div class="col-12">
            <h1 class="text-center"><span class="blue_color">All Coaches</h1>
               <ul class="list-unstyled">
                  <?php if ($allUsers): ?>
                     <?php foreach ($allUsers as $key => $coach): ?>
                        <li class="coaches_listing d-inline-block bg-white">
                           <div>
                              <img src="\public\storage\{{ $coach->avatar }}" alt="{{ $coach->name }}" />
                              <h4 class="text-uppercase">{{ $coach->name }}</h4>
                              <h6 class="text-primary">{{ $coach->last_name }}</h6>
                              <p class="coach_about">{{ $coach->about }}</p>
                              <ul class="list-unstyled">
                                 <li class="d-inline p-3">
                                    <a href="#">
                                     <i class="fa fa-facebook text-muted"></i>
                                    </a>
                                 </li>
                                 <li class="d-inline p-3">
                                    <a href="#">
                                     <i class="fa fa-twitter text-muted"></i>
                                    </a>
                                 </li>
                                 <li class="d-inline p-3">
                                    <a href="#">
                                     <i class="fa fa-linkedin text-muted"></i>
                                    </a>
                                 </li>
                                 <li class="d-inline p-3">
                                    <a href="#">
                                     <i class="fa fa-instagram text-muted"></i>
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </li>
                     <?php endforeach ?>
                  <?php else: ?>
                     <li>Users not added yet</li>
                  <?php endif ?>
               </ul>         
         </div>
      </div>
   </div>
</div>
@stop