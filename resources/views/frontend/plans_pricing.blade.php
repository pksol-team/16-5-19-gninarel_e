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
                     <li><a href="{{ lang_url('') }}">@t('الصفحة الرئيسية')</a></li>
                     <li class="active text-gray-silver">@t('الخدمات والمنتجات')</li>
                  </ol>
                  <h2 class="title text-white">@t('الباقات ')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="divider">
      <div class="container">
         <div class="row rtl">
         </div>
         <div class="row rtl">
            <?php if (count($allPlans) > 0): ?>
            <?php foreach ($allPlans as $key => $plans): ?>              
            <div class="col-xs-12 col-sm-6 col-md-3 hvr-float-shadow mb-sm-30">
               <div class="pricing-table maxwidth400">
               </div>
               <div class="bg-white border-1px p-30 pt-20 pb-20" style="min-height: 280px;">
                  <h3 class="package-type font-24 m-0 mb-20 color-theme-green text-center">{{ $plans->title }}</h3>
                  <p>{{ $plans->description }}</p>
                  <h4 class="color-theme-green ">@t('المزايا')</h4>
                  <?php 
                     $advantages = explode(',', $plans->advantages);
                     ?>
                  <ul class="table-list list-icon theme-colored pb-0">
                     <?php foreach ($advantages as $key => $advantage): ?>
                     <?php if (strlen(trim($advantage)) > 1): ?>
                     <li><i class="">- </i>{{ $advantage }}</li>
                     <?php endif ?>
                     <?php endforeach ?>
                  </ul>
               </div>
               <form name="buy_req" id="buy_req" method="POST" action="{{ lang_url('buy_plan') }}" class="buy_req">
                  @csrf
                  <input type="hidden" name="plan_name" value="{{ $plans->title }}" />
                  <input type="hidden" name="plan_id" value="{{ $plans->id }}" />
                  <input type="hidden" name="no" value="2" />
                  <input type="hidden" name="duration" value="{{ $plans->duration }}" />
                  <input type="hidden" name="price" value="{{ $plans->price }}" />
                  <button class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat" type="submit">@t('إشتراك ( :plansprice ريال شهريا )', ['plansprice' => $plans->price ])</button>
               </form>
            </div>
            <?php endforeach ?>
            <?php else: ?>
            <div class="col-xs-12 col-sm-6 col-md-3 hvr-float-shadow mb-sm-30">
               <div class=" bg-white border-1px p-30 pt-20 pb-20">
                  <h3 class="package-type font-24 m-0 mb-20 color-theme-green text-center">@t('Plans not added yet')</h3>
               </div>
            </div>
            <?php endif ?>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop