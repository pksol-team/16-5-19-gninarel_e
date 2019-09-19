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
                     <li class="active text-gray-silver">@t('Definition of')</li>
                  </ol>
                  <h2 class="title text-white">@t('For the best direction')</h2>
               </div>

               @t('this')
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: about -->
   <section class="divider">
      <div class="container">
         <div class="row pt-30 rtl">
            <div class="col-md-12">
               <h2 class="mt-0 mb-30 font-30 heading-title-spec">@t('Definition of
')</h2>
               <p class="mb-30">@t('aboutText')</p>
            </div>
         </div>
         <div class="separator separator-rounedd"></div>
         <div class="row pt-30 rtl">
            <div class="col-md-12">
               <div class="col-md-2 col-sm-12">
                  <!-- <h2 class="mt-0 mb-0 font-30 heading-title-spec pull-right ml-30">رسالتنا</h2> -->
               </div>
               <div class="col-md-10 col-sm-12">
                  <p class="mt-10 mb-40">@t('To be the first choice in trading knowledge')</p>
               </div>
            </div>
            <div class="col-md-12">
               <div class="col-md-2 col-sm-12">
                  <h2 class="mt-0 mb-0 font-30 heading-title-spec pull-right ml-30">@t('Our mission')</h2>
               </div>
               <div class="col-md-10 col-sm-12">
                  <ul class="list">
                     <li>@t('Maximize the sustainable value of our shareholders' investments by balancing the economic return on investment and risk.')</li>
                     <li>@t('Recognize our employees as valuable resources and motivate them to unleash their creativity and expand their knowledge.')</li>
                     <li>@t('Activate participation constructively to achieve the ambition of real estate ownership for members of our community.')</li>
                     <li>@t('Maximize the sustainable value of our shareholders' investments by balancing the economic return on investment and risk.')</li>
                     <li>@t('Recognize our employees as valuable resources and motivate them to unleash their creativity and expand their knowledge.')</li>
                     <li>@t('Activate participation constructively to achieve the ambition of real estate ownership for members of our community.')</li>
                  </ul>
               </div>
            </div>
            <div class="col-md-12 mt-30">
               <div class="col-md-2 col-sm-12">
                  <h2 class="mt-0 mb-0 font-30 heading-title-spec pull-right ml-30">@t('rate us')</h2>
               </div>
               <div class="col-md-10 col-sm-12">
                  <ul class="list">
                     <li>@t('Innovation: Always striving for excellence, development and creativity to keep abreast of all developments in our business sector.')</li>
                     <li>@t('Leadership: Stay at the forefront of the highest standards in all of our business to provide added value that matches our customers' needs and more.   ')</li>
                     <li>@t('Trust: Maintain strong and solid relationships with all our partners based on transparency, fairness, fairness and mutual appreciation.')</li>
                     <li>@t('Efficiency: Working to develop our entrepreneurial capabilities through professionalism, competence and a holistic view.')</li>
                     <li>@t('Responsibility: Commitment to achieving sustainable returns and balanced growth for our customers, shareholders, employees and all segments of our society.')</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop