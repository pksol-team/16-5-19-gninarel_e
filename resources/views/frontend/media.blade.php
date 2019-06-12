@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-logo">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" alt=""></a>
            <h1 class="text-center"><span>Media</span></h1>
         </div>
      </div>
   </div>
</div>
<div class="main-ref">
   <div class="row">
      <div class="col-12 ">
         <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
               <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Video</a>
               <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Photos</a>
               <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Tools</a>
            </div>
         </nav>
         <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <?php if ($youtubeVideos): ?>
                  <div class="row">
                  <?php foreach ($youtubeVideos as $key => $singleVideo): ?>
                        <div class="col-4 p-0 d-inline-block">
                           <iframe width="95%" height="200" src="{{ $singleVideo->link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                  <?php endforeach ?>
                  </div><!-- /.row -->
               <?php else: ?>
                  <p>No Video found</p>
               <?php endif ?>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
               <div class="row">
                  <div class="col-4 mb-3 d-inline-block">
                     <img src="/frontend/assets/img/media/dsf.jpg" alt="Image" />
                  </div>
                  <div class="col-4 mb-3 d-inline-block">
                     <img src="/frontend/assets/img/media/FL-29-04-2019-07-24-20.jpg" alt="Image" />
                  </div>
                  <div class="col-4 mb-3 d-inline-block">
                     <img src="/frontend/assets/img/media/FL-29-04-2019-07-24-30.jpg" alt="Image" />
                  </div>
                  <div class="col-4 mb-3 d-inline-block">
                     <img src="/frontend/assets/img/media/FL-29-04-2019-07-25-01.jpg" alt="Image" />
                  </div>
                  <div class="col-4 mb-3 d-inline-block">
                     <img src="/frontend/assets/img/media/FL-29-04-2019-07-27-49.jpg" alt="Image" />
                  </div>
                   <div class="col-4 mb-3 d-inline-block">
                     <img src="/frontend/assets/img/cornerstone.png" alt="Image" />
                  </div>
               </div><!-- /.row -->
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
               <h2>Lorem Ipsum dolor sit</h2>
               Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus nostrum, ratione quia. Accusamus quia cupiditate inventore iste commodi, possimus asperiores consequuntur facere nesciunt sequi error deserunt fugit pariatur, porro amet numquam necessitatibus officia dolorum molestias rem aspernatur, iusto suscipit? Eligendi quo vero quod commodi accusantium esse cum expedita et sit!
            </div>
         </div>
      
      </div>
   </div>
</div>
@stop