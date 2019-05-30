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
            <h1 class="text-center"><span>{{ $productDecode->name }}</span></h1>
            <div class="img-forex">
               <img src="\public\storage\{{ $productDecode->thumbnail }}" alt="{{ $productDecode->name }}">
            </div>
            <div class="date-n-price">
               <p><span class="product-price_detail"><strong>Price:</strong> $ {{ $productDecode->price }}</span></p>
            </div>
            <div class="book-detail">
               <h3 class="mb-2"><strong>Product Description:</strong></h3>
              {!! $productDecode->long_description !!}
            </div>
            <div>
               <?php if ($productDecode->product_spec->type == 'book'): ?>
               <h4><strong>Where to Buy:</strong></h4>
               <div class="row">
                  <div class="col-4">
                     <h3>From Amazon:</h3>
                     <a target="_blank" href="//{{ $productDecode->product_url }}" class="text-success amazon_url_link"> {{ $productDecode->product_url }} </a>
                  </div><!-- /.col-4 -->
                  <div class="col-4">
                     <h3>From Shop:</h3>
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, neque, ullam! Dolore assumenda a veniam recusandae laborum. Debitis, at, eius.</p>
                  </div><!-- /.col-4 -->
                  <div class="col-4">
                     <h3>From Website:</h3>
                     <a class="btn" href="{{ lang_url('product/'.$productDecode->id.'/checkout') }}">
                        <span>Buy Now</span>
                     </a>
                  </div><!-- /.col-4 -->
               </div><!-- /.row -->
               <?php else: ?>
                  <div class="row">
                     <div class="col-6">
                        <h3>From Link:</h3>
                        <a target="_blank" href="//{{ $productDecode->product_url }}" class="text-success amazon_url_link"> {{ $productDecode->product_url }} </a>
                     </div><!-- /.col-6 -->
                     <div class="col-6">
                        <h3>From Website:</h3>
                        <a class="btn" href="{{ lang_url('product/'.$productDecode->id.'/checkout') }}">
                           <span>Buy Now</span>
                        </a>
                     </div><!-- /.col-6 -->
                  </div>
               <?php endif ?>
            </div>
         </div>
      </div>
   </div>
</div>
@stop