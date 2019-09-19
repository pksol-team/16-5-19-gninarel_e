@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-title">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" class="logo_black"></a>
            <h1 class="text-center"><span>{{ ($type == 'book' ? t('Books'): t('Tools') ) }}</span></h1>
         </div>
      </div>
   </div>
</div>
<div class="all-books">
   <div class="row">
      <div class="col-md-12">
         <ul>
          <?php if ($productsDecode): ?>
            <?php foreach ($productsDecode as $key => $product): ?>

              <li class="row">
                 <div class="col-md-1">
                    <div class="date-and-formats">
                       <div class="podcast-date-box updated">
                          <span class="podcast-date">{{ date("d", strtotime($product->created_at)) }}</span>
                          <span class="podcast-month-year">{{ date("m, Y", strtotime($product->created_at)) }}</span>
                       </div>
                       <div class="podcast-format-box">
                          <i class="fa fa-{{ ($product->product_spec->type == 'book' ? 'book': 'wrench' ) }}"></i>
                       </div>
                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="post-img">
                       <div class="img-forex">
                          <img src="\public\storage\{{ $product->thumbnail }}" alt="{{ $product->name }}">
                       </div>
                    </div>
                 </div>
                 <div class="col-md-7">
                    <div class="post-detail">
                       <div class="podcast-post-content post-content">
                          <h2 class="blog-shortcode-post-title">
                             <a href="{{ lang_url('product/'.$product->product_id.'/view') }}">{{ $product->name }}</a>
                          </h2>
                          <p class="podcast-single-line-meta">
                             <span>$ {{ $product->price }}</span>
                          </p>
                          <div class="podcast-post-content-container">
                             <p>{{ $product->short_description }}</p>
                             <p><a class="readmore" href="{{ lang_url('product/'.$product->product_id.'/view') }}">@t('View More') </a></p>
                          </div>
                       </div>
                    </div>
                 </div>
              </li>
              
            <?php endforeach ?>
          <?php else: ?>
            <li class="row">
              <div class="col-md-12">
                <div class="post-detail">
                   <div class="podcast-post-content post-content">
                      <h2 class="blog-shortcode-post-title">
                         @t('No Record Found !')
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