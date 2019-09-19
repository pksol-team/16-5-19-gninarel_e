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
                     <li class="active text-gray-silver">@t('عن الأتجاه الأفضل')</li>
                     <li class="active text-gray-silver">@t('تعريف')</li>
                  </ol>
                  <h2 class="title text-white">@t('عن الأتجاه الأفضل')</h2>
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
               <h2 class="mt-0 mb-30 font-30 heading-title-spec">@t('تعريف')</h2>
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
                  <p class="mt-10 mb-40">@t('أن نكون الخيار الأول في  معرفة التداول')</p>
               </div>
            </div>
            <div class="col-md-12">
               <div class="col-md-2 col-sm-12">
                  <h2 class="mt-0 mb-0 font-30 heading-title-spec pull-right ml-30">@t('مهمتنا')</h2>
               </div>
               <div class="col-md-10 col-sm-12">
                  <ul class="list">
                     <li>تعظيم القيمة المستدامة لاستثمارات مساهمينا بتحقيق التوازن بين العائد الاقتصادي للاستثمار والمخاطر.</li>
                     <li>تمييز موظفينا كموارد ثمينة وتحفيزهم لأطلاق مكامن ابداعهم وتوسيع مدارك المعرفة لديهم.</li>
                     <li>تفعيل المشاركة بشكل بناء لتحقيق طموح التملك العقاري لأفراد مجتمعنا.</li>
                     <li>تعظيم القيمة المستدامة لاستثمارات مساهمينا بتحقيق التوازن بين العائد الاقتصادي للاستثمار والمخاطر.</li>
                     <li>تمييز موظفينا كموارد ثمينة وتحفيزهم لأطلاق مكامن ابداعهم وتوسيع مدارك المعرفة لديهم.</li>
                     <li>تفعيل المشاركة بشكل بناء لتحقيق طموح التملك العقاري لأفراد مجتمعنا.</li>
                  </ul>
               </div>
            </div>
            <div class="col-md-12 mt-30">
               <div class="col-md-2 col-sm-12">
                  <h2 class="mt-0 mb-0 font-30 heading-title-spec pull-right ml-30">@t('قيمنا')</h2>
               </div>
               <div class="col-md-10 col-sm-12">
                  <ul class="list">
                     <li>الابتكار: السعي دوما الى التميّز والتطور والأبداع لمواكبة كافة المستجدات في قطاع أعمالنا.</li>
                     <li>القيادة: البقاء في الصدارة بأعلى المقاييس في كل أعمالنا لتقديم قيمة مضافة توازي احتياجات عملائنا وأكثر.</li>
                     <li>الثقة: الحفاظ على علاقات قوية ومتينة مع جميع شركائنا أساسها الشفافية والعدالة والأنصاف والتقدير المتبادل.</li>
                     <li>الكفاءة: العمل على تطوير قدراتنا الريادية من خلال التعامل باحترافية وجدارة ونظره شمولية.</li>
                     <li>المسؤولية: الالتزام بتحقيق عوائد مستدامة ونمو متوازن لعملائنا ومساهمينا وموظفينا وكافة أطياف مجتمعنا. </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop