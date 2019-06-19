<?php use App\VideoNative; ?>
<?php use App\User_access; ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-resources">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="you_need">
      <div class="row">
         <div class="offset-md-4 col-md-4">
            <div class="our_logo">
               <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo21.png" alt="Logo"></a>
            </div>
         </div>
      </div>
      <div class="row">
        <div class="elegant-dual-button">
           <div class="first-btn">
              <a class="btn" href="{{ URL::previous() }}"><i class="fa fa-arrow-right float-left"> &nbsp;</i> Back to Schools </a>
           </div>
        </div>
      </div><!-- /.row -->
      <div class="row">
         <div class="col-md-12">
            <h3>Chapter: <strong>{{ $chapter->name }}</strong></h3>
            <p>Description: {{ $chapter->description }}</p>
         </div>
         <ul class="list-unstyled col-8 offset-2">
            <?php 
              $chapter_id = $chapter->chapters->id;
              $videoNative = VideoNative::with('videos')->whereHas('videos', function ($query) use ($chapter_id) {
                 $query->where('chapter_id', $chapter_id);
              })->where([['lang', Request::locale()], ['status', 'active']])->get();
            ?>
            <?php if (count($videoNative)): ?>
              <?php foreach ($videoNative as $key => $video): ?>

               <li class="p-4 mb-5 videos_design_li" id="video_list_{{ $video->videos->id }}">
                <?php 
                  $videoWatchedSingle = User_access::where([['user_id', Auth::user()->id], ['object_type', 'video'], ['object_id', $video->video_id], ['status', 'watched']])->first();
                ?>
                  <h4>{{ $video->name }} <span class="float-right" style="font-size: 3em;"><i class="fa fa-check-square {{ $videoWatchedSingle ? 'text-success' : 'text-dark' }} " aria-hidden="true"></i></span></h4>
                  <p>{{ $video->description }}</p>
                  <?php $decodedVideo = json_decode($video->video_upload); ?>
                  <?php if (count($decodedVideo) > 0): ?>
                    <?php if ($key == 0): ?>
                      <video data-user-id="{{ Auth::user()->id }}" data-video-id="{{ $video->videos->id }}" class="plyr_Player" width="100%" height="530" ata-plyr-config='{ "title": "{{ $video->name }}" }' playsinline controls disablePictureInPicture controlsList="nodownload">
                          <source src="\public\storage\{{ $decodedVideo[0]->download_link }}" type="video/mp4" />
                          <source src="\public\storage\{{ $decodedVideo[0]->download_link }}" type="video/webm" />
                      </video>

                      <!-- Video -->
                    <?php else: ?>
                      <?php 
                        $videoWatched = User_access::where([['user_id', Auth::user()->id], ['object_type', 'video'], ['object_id', $last_video_id], ['status', 'watched']])->first();
                      ?>
                      <?php if ($videoWatched): ?>

                        <video data-user-id="{{ Auth::user()->id }}" data-video-id="{{ $video->videos->id }}" class="plyr_Player" width="100%" height="530" ata-plyr-config='{ "title": "{{ $video->name }}" }' playsinline controls>
                            <source src="\public\storage\{{ $decodedVideo[0]->download_link }}" type="video/mp4" />
                            <source src="\public\storage\{{ $decodedVideo[0]->download_link }}" type="video/webm" />
                        </video>

                      <?php endif ?>
                    <?php endif ?>
                  <?php endif ?>
                  <?php if ($key == 0): ?>
                    <div class="mt-2">
                      <h5>Attachments:</h5>
                      <ul class="list-unstyled">
                        <?php $allAttachments = json_decode($video->attachments); ?>
                        <?php if (count($allAttachments) > 0): ?>
                          <?php foreach ($allAttachments as $key => $attch): ?>
                              <li class="d-inline-block m-1 border p-4 text-center"><a target="_blank" href="\public\storage\{{ $attch->download_link }}" class="text-dark"><i class="fa fa-download display-4" aria-hidden="true"></i><span class="d-block">{{ substr($attch->original_name, -20) }}</span></a></li>
                          <?php endforeach ?>
                        <?php else: ?>
                          <li>No Attachment Found!</li>
                        <?php endif ?>
                      </ul>
                    </div>
                  <?php else: ?>
                      <?php if ($videoWatched): ?>

                        <div class="mt-2">
                          <h5>Attachments:</h5>
                          <ul class="list-unstyled">
                            <?php $allAttachments = json_decode($video->attachments); ?>
                            <?php if (count($allAttachments) > 0): ?>
                              <?php foreach ($allAttachments as $key => $attch): ?>
                                  <li class="d-inline-block m-1 border p-4 text-center"><a target="_blank" href="\public\storage\{{ $attch->download_link }}" class="text-dark"><i class="fa fa-download display-4" aria-hidden="true"></i><span class="d-block">{{ substr($attch->original_name, -20) }}</span></a></li>
                              <?php endforeach ?>
                            <?php else: ?>
                              <li>No Attachment Found!</li>
                            <?php endif ?>
                          </ul>
                        </div>

                      <?php endif ?>
                  <?php endif ?>
               </li>
                <?php $last_video_id = $video->video_id;?>
              <?php endforeach ?>
            <?php endif ?>
         </ul>
      </div>
   </div>
</div>
<!-- <script src="/frontend/assets/js/plyr.js"></script> -->

@push('scripts')
    <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script>
    <script>
        // const player = new Plyr('.plyr_Player');
        const players = Array.from(document.querySelectorAll('.plyr_Player')).map(p => new Plyr(p));

        $.each(players, function(index, val) {
           /* iterate through array or object */
          val.on('pause', event => {
              const instance = event.detail.plyr;

              var user_id = $(this)[0]['media']['attributes'][0]['value'];
              var video_id = $(this)[0]['media']['attributes'][1]['value'];

              $.ajax({
                      type: 'POST',
                      url: '{{ lang_url("updatevideowatched") }}',
                      data: {"_token": "{{ csrf_token() }}", 'user_id':user_id, 'video_id':video_id},
                  })
                  .done(function(response) {
                    if (response == 1) {
                      $('#video_list_'+video_id+' h4 span i').removeClass('text-dark').addClass('text-success')
                    }
                });

          });
        });

    </script>
@endpush
@stop