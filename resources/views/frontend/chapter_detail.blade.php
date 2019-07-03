<?php use Carbon\Carbon;
      use App\VideoNative;
      use App\User_access;
      use App\User;
      use App\Comment;
      use App\Exams;
      use App\UserLoginDetail;
      use App\UserLoginNotify;
      ?>
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<?php
  $userLoginDetail = UserLoginDetail::where([['email', Auth::user()->email], ['user_agent', $userAgent]])->first();
  if (count($userLoginDetail) > 0) {

    if ($userLoginDetail->status != 'saved') {
      $userNotify = [
        'user_id' => Auth::user()->id,
        'email' => Auth::user()->email,
        'status' => 'active',
        'created_at' => Carbon::now(),

      ];
      UserLoginNotify::insert($userNotify);
    }
    
  }

  $testSkipCheck = Exams::where('chapter_id', '=',  $chapter->id)->whereBetween('min_pass', [1, 100])->get();
  $skipTest = count($testSkipCheck);
?>
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
         <ul class="list-unstyled col-8 offset-2 list_of_videos">
          <?php 
            $chapter_id = $chapter->chapters->id;
            $videoNative = VideoNative::with('videos')->whereHas('videos', function ($query) use ($chapter_id) {
               $query->where('chapter_id', $chapter_id);
            })->where([['lang', Request::locale()], ['status', 'active']])->get();

            $chapterCompleted = User_access::where([['user_id', Auth::user()->id], ['object_type', 'chapter'], ['object_id', $chapter_id], ['status', 'completed']])->first();

          ?>
            <?php if (count($chapterCompleted) > 0): ?>
              <?php if ($skipTest > 0): ?>
                
                <li class="p-4 mb-5 videos_design_li">
                  <?php 
                    $chapterCompleted = User_access::where([['user_id', Auth::user()->id], ['object_type', 'test'], ['object_id', $chapter->id], ['status', 'Passed']])->first();

                  ?>
                  <?php if (count($chapterCompleted) < 1): ?>
                    <!-- Model Box For Test -->
                    <div id="test_model" class="modal" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <div class="our_logo text-center">
                               <a href="{{ lang_url('') }}"><img class="w-50" src="/frontend/assets/img/logo21.png" alt="Logo"></a>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p><small>You have watched all video of this chapter <br />Give test of this chapter for being a part of next chapter</small></p>
                          </div>
                          <div class="modal-footer">
                            <a href="{{ lang_url('chapters/'.$chapter->id.'/test/serve') }}" class="text-white"><button type="button" class="btn btn-primary">Start Test</button> </a>
                              <?php if ($skipTest < 1): ?>
                                <button type="button" class="btn btn-secondary">Skip Test</button>
                              <?php endif ?>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <!-- Model Box For Test -->
                  <?php endif ?>
                  <h5>Attempt test for next chapter</h5>
                  <div class="row mb-3">
                    <div class="col-2">
                      <div>Questions:</div>
                      <div>Time:</div>
                      <div>Difficulty:</div>
                    </div><!-- /.col-3 -->
                    <div class="col-10">
                      <div>From 10 up to 10 Questions</div>
                      <div>About 10 Minutes</div>
                      <div>The test will provide a variety of question from easy to hard ones</div>
                    </div><!-- /.col-3 -->
                  </div><!-- /.row -->
                  <button class="btn btn-success"><a href="{{ lang_url('chapters/'.$chapter->id.'/test/serve') }}" class="text-white"> Start Test</a></button>
                  
                </li>
              <?php endif ?>
            <?php endif ?>

            <?php if (count($videoNative) > 0): ?>
              <?php foreach ($videoNative as $key => $video): ?>

               <li class="p-4 mb-5 videos_design_li" data-videonative-id="{{ $video->id }}" id="video_list_{{ $video->id }}">
                <?php 
                  $videoWatchedSingle = User_access::where([['user_id', Auth::user()->id], ['object_type', 'video'], ['object_id', $video->video_id], ['status', 'watched']])->first();
                ?>
                  <h4>{{ $video->name }} <span class="float-right" style="font-size: 3em;"><i class="fa fa-check-square {{ $videoWatchedSingle ? 'text-success' : 'text-dark' }} " aria-hidden="true"></i></span></h4>
                  <p>{{ $video->description }}</p>
                  <?php $decodedVideo = json_decode($video->video_upload); ?>
                  <?php if (count($decodedVideo) > 0): ?>
                    <?php if ($key == 0): ?>
                      <video data-user-id="{{ Auth::user()->id }}" data-video-id="{{ $video->videos->id }}" data-videonative-id="{{ $video->id }}" class="plyr_Player" width="100%" height="530" ata-plyr-config='{ "title": "{{ $video->name }}" }' playsinline controls disablePictureInPicture controlsList="nodownload">
                          <source src="\public\storage\{{ $decodedVideo[0]->download_link }}" type="video/mp4" />
                          <source src="\public\storage\{{ $decodedVideo[0]->download_link }}" type="video/webm" />
                      </video>

                      <!-- Video -->
                    <?php else: ?>
                      <?php 
                        $videoWatched = User_access::where([['user_id', Auth::user()->id], ['object_type', 'video'], ['object_id', $last_video_id], ['status', 'watched']])->first();
                      ?>

                        <video data-user-id="{{ Auth::user()->id }}" data-video-id="{{ $video->videos->id }}" data-videonative-id="{{ $video->id }}" class="{{ $videoWatched ? NULL : 'd-none' }} plyr_Player" width="100%" height="530" ata-plyr-config='{ "title": "{{ $video->name }}" }' playsinline controls>
                            <source src="{{ $videoWatched ? '\\public\storage\\'.$decodedVideo[0]->download_link : NULL }}" type="video/mp4" />
                            <source src="{{ $videoWatched ? '\\public\storage\\'.$decodedVideo[0]->download_link : NULL }}" type="video/webm" />
                        </video>

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

                      <div class="attachmentsOfVideo mt-2 {{ $videoWatched ? NULL : 'd-none' }}">
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

                    <div class="main_comment_{{ $video->id }} video_comments_box">
                      <h3 class="h6 fw-semi currentComment"><u><b>Feedbacks</b></u></h3>

                      <?php $allComments = Comment::where([['status', 'active'], ['parent_id', 0], ['video_id', $video->id]])->orderBy('id', 'DESC')->get(); ?>
                      <?php if (count($allComments) > 0): ?>
                        <?php foreach ($allComments as $key => $comment): ?>
                          <?php $user = User::find($comment->user_id)->first(); ?>
                          
                          <div class="post-author row mt-2 border p-1 bg-white rounded mb-3">
                            <div class="float-left no-shrink rounded-circle col-1 p-0">                        
                              <img src="\public\storage\{{ $user->avatar }}" class="rounded-circle" alt="image description">
                            </div>
                            <div class="description-wrap col-10">
                              <p class="author-heading m-0 l-h">{{ $user->name }}</p>
                              <p class="m-0" style="line-height: 1;"><small>{{ $comment->comment }}</small></p>
                              <button class="btn comment_reply_button" data-video_id="{{ $video->id }}" data-parent_id="{{ $comment->id }}">reply</button>
                              <?php $allCommentsReply = Comment::where([['status', 'active'], ['parent_id', $comment->id], ['video_id', $video->id]])->orderBy('id', 'DESC')->get(); ?>
                              <?php if ($allCommentsReply): ?>
                                <?php foreach ($allCommentsReply as $key => $commentReply): ?>
                                <?php $userReplied = User::find($commentReply->user_id)->first(); ?>
                                  
                                  <div class="post-author-replies post-author-{{ $commentReply->id }} row mt-2 border p-1 bg-white rounded mb-3">
                                    <div class="float-left no-shrink rounded-circle col-1 p-0">                        
                                      <img src="\public\storage\{{ $userReplied->avatar }}" class="rounded-circle" alt="image description">
                                    </div>
                                    <div class="description-wrap col-10">
                                      <p class="author-heading m-0 l-h">{{ $userReplied->name }}</p>
                                      <p class="m-0" style="line-height: 1;"><small>{{ $commentReply->comment }}</small></p>
                                    </div>
                                  </div>

                                <?php endforeach ?>
                        
                              <?php endif ?>


                            </div>
                          </div>
                          
                        <?php endforeach ?>
                      <?php else: ?>
                        <div>No Feedback Given</div>
                      <?php endif ?>
                    </div>

                    <div class="row post-author">
                       <div class="float-left no-shrink rounded-circle col-1 p-0">
                        <img src="\public\storage\{{ Auth::user()->avatar }}" class="rounded-circle" alt="image description">
                       </div>
                       <div class="description-wrap float-right col-11">
                        <form method="POST" id="form_comment_{{ $video->id }}" class="comment_form" action="{{ lang_url('submit_comment') }}">
                            @csrf
                             <textarea name="current_user_comment" class="user_cmnt w-100 form-control" placeholder="Write your comment here" style="resize: none;"></textarea>
                             <input type="hidden" name="video_id" value="{{ $video->id }}">
                             <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="displayButtons float-right mt-2">
                               <button type="submit" class="btn btn-success comment">Comment</button>
                            </div>
                          </form>
                       </div>
                      </div><!-- /.row -->
               </li>
                <?php $last_video_id = $video->video_id;?>
              <?php endforeach ?>
            <?php endif ?>
         </ul>
      </div>
   </div>
</div>

@push('scripts')
    <script src="/frontend/assets/js/plyr.js"></script>
    <!-- <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script> -->
    <script>

      jQuery(document).ready(function($) {

        // load model 
        $('#test_model').modal('show');

        
        //comment reply button click show reply box
        $(document).on('click', '.comment_reply_button', function(e) {
          e.preventDefault();

          var $this = $(this),
              replyBox = $this.parent('.description-wrap').next('.post-author').length,
              video_id = $this.attr('data-video_id'),
              parent_id = $this.attr('data-parent_id'),
              replyForm = `<div class="row post-author post-author-reply-div">
                       <div class="float-left no-shrink rounded-circle col-1 p-0">
                        <img src="\\public\\storage\\{{ Auth::user()->avatar }}" class="rounded-circle" alt="image description">
                       </div>
                       <div class="description-wrap float-right col-11">
                        <form method="POST" id="form_comment_`+video_id+`" class="comment_form" action="{{ lang_url('submit_comment') }}">
                            @csrf
                             <textarea name="current_user_comment" class="user_cmnt w-100 form-control" placeholder="Write your comment here" style="resize: none;"></textarea>
                             <input type="hidden" name="video_id" value="`+video_id+`">
                             <input type="hidden" name="parent_id" value="`+parent_id+`">
                             <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="displayButtons float-right mt-2">
                               <button type="submit" class="btn btn-success comment">Comment</button>
                            </div>
                          </form>
                       </div>
                      </div>`;

              if (replyBox < 1) {
                $this.parent().parent().append(replyForm);
              }

        });
        
        // comment 
        $(document).on('submit', '.comment_form', function(e) {
          e.preventDefault();
          
          var $this = $(this),
              commentLength = $this.find('textarea').val().trim().length,
              formData = $this.serialize(),
              current_user_comment = $this.find('textarea[name=current_user_comment]'),
              commentForAppend = current_user_comment.val(),
              parent = $this.find('input[name=parent_id]').val(),
              video_id = $this.find('input[name=video_id]').val(),
              loader = '\\public\\loading.gif';

              // comment textarea is empty or spaces check
              if (commentLength > 0) {
                current_user_comment.val('');
                var commentBtn = $this.find('.comment');
                  commentBtn.html('<img src="'+loader+'" class="mr-1 ml-1">Comment').attr('disabled', '1');

                $.ajax({
                        type: 'POST',
                        url: '{{ lang_url("submit_comment") }}',
                        data: formData,
                    })
                    .done(function(response) {
                      commentBtn.html('Comment').removeAttr('disabled');
                    // new comment
                      if (parent == undefined ) {
                        var $newComment = `<div class="post-author row mt-2 border p-1 bg-white rounded mb-3">
                                  <div class="float-left no-shrink rounded-circle col-1 p-0">                        
                                    <img src="\\public\\storage\\{{ Auth::user()->avatar }}" class="rounded-circle" alt="image description">
                                  </div>
                                  <div class="description-wrap col-10">
                                    <p class="author-heading m-0 l-h">{{ Auth::user()->name }}</p>
                                    <p class="m-0" style="line-height: 1;"><small>`+commentForAppend+`</small></p>
                                    <button class="btn comment_reply_button" data-video_id="`+video_id+`" data-parent_id="`+response+`">reply</button>
                                  </div>
                                </div>`;
                          $('.main_comment_'+video_id).append($newComment);
                          $('.main_comment_'+video_id).animate({ scrollTop: $('.main_comment_'+video_id).prop("scrollHeight")}, 1000);

                      } else {
                    // comment reply
                          var $newComment = `<div class="post-author row mt-2 border p-1 bg-white rounded mb-3">
                                    <div class="float-left no-shrink rounded-circle col-1 p-0">                        
                                      <img src="\\public\\storage\\{{ Auth::user()->avatar }}" class="rounded-circle" alt="image description">
                                    </div>
                                    <div class="description-wrap col-10">
                                      <p class="author-heading m-0 l-h">{{ Auth::user()->name }}</p>
                                      <p class="m-0" style="line-height: 1;"><small>`+commentForAppend+`</small></p>
                                    </div>
                                  </div>`;
                            $('.main_comment_'+video_id+ ' .post-author-reply-div').prev('.description-wrap').append($newComment);
                            
                      }

                  });

              }


        });
        
      });

        // Initialize Plyr.io
        const players = Array.from(document.querySelectorAll('.plyr_Player')).map(p => new Plyr(p));

        // all videos looping
        $.each(players, function(index, val) {
           /* iterate through array or object */

          var user_id = $(this)[0]['media']['attributes'][0]['value'],
              video_id = $(this)[0]['media']['attributes'][1]['value'],
              videonative_id = $(this)[0]['media']['attributes'][2]['value'],
              total_videos = parseInt("{{ count($videoNative) }}"),
              chapter_id = "{{ $chapter_id }}",
              next_video = $('#video_list_'+videonative_id).next('li'),
              next_video_id = parseInt(next_video.attr('data-videonative-id')),
              ResumeTime = null,
              videoDuration = null;

              // have next video check
              if (next_video.length < 1) {
                  next_video_id = 0;
                }
           
           // where user left video resume
           $.ajax({
               type: 'POST',
               url: '{{ lang_url("videoStartsFrom") }}',
               data: {"_token": "{{ csrf_token() }}", 'user_id':user_id, 'videonative_id':videonative_id},
           })
           .done(function(response) {
              if (response == null) {
                val.currentTime = 0;
              } else {
                val.currentTime = parseFloat(response);
              }
           });
          
           // where user left time get
          val.on('timeupdate', event => {
           ResumeTime = val.currentTime;
           videoDuration = val.duration;

          });
          
          // update time on every 5 sec in database
          function function_name() {
            if (ResumeTime != videoDuration && ResumeTime != 0) {
              $.ajax({
                  type: 'POST',
                  url: '{{ lang_url("InsertVideoTime") }}',
                  data: {"_token": "{{ csrf_token() }}", 'user_id':user_id, 'videonative_id':videonative_id, 'ResumeTime':ResumeTime},
              });
            }
          }

        setInterval(function_name, 5000);

          // video end event trigged
          val.on('ended', event => {
          // val.on('pause', event => {
              const instance = event.detail.plyr;

              $.ajax({
                  type: 'POST',
                  url: '{{ lang_url("deleteVideoTime") }}',
                  data: {"_token": "{{ csrf_token() }}", 'user_id':user_id, 'videonative_id':videonative_id},
              });


              $.ajax({
                      type: 'POST',
                      url: '{{ lang_url("updatevideowatched") }}',
                      data: {"_token": "{{ csrf_token() }}", 'user_id':user_id, 'video_id':video_id, 'total_videos':total_videos, 'chapter_id':chapter_id, "next_video_id":next_video_id},
                  })
                  .done(function(response) {
                    if (response == 0) {
                      // Do Nothing
                    } 
                    // return 1 (record inserted in database, Video watched successufully)
                    else if(response == 1) {
                        $('#video_list_'+videonative_id+' h4 span i').removeClass('text-dark').addClass('text-success');
                      if ('{{ $skipTest }}' > 0) {
                        $('ul.list_of_videos').prepend(`
                          <li class="p-4 mb-5 videos_design_li">
                            <!-- Model Box For Test -->
                              <div id="test_model" class="modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <div class="our_logo text-center">
                                         <a href="{{ lang_url('') }}"><img class="w-50" src="/frontend/assets/img/logo21.png" alt="Logo"></a>
                                      </div>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <p><small>You have watched all video of this chapter <br />Give test of this chapter for being a part of next chapter</small></p>
                                    </div>
                                    <div class="modal-footer">
                                      <a href="{{ lang_url('chapters/'.$chapter->id.'/test/serve') }}" class="text-white"><button type="button" class="btn btn-primary">Start Test</button> </a>
                                        <?php
                                          if ($skipTest < 1) {
                                            echo '<button type="button" class="btn btn-secondary">Skip Test</button>';
                                          }
                                        ?>
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <!-- Model Box For Test -->
                            <h5>Attempt test for next chapter</h5>
                            <div class="row mb-3">
                              <div class="col-2">
                                <div>Questions:</div>
                                <div>Time:</div>
                                <div>Difficulty:</div>
                              </div><!-- /.col-3 -->
                              <div class="col-10">
                                <div>From 10 up to 10 Questions</div>
                                <div>About 10 Minutes</div>
                                <div>The test will provide a variety of question from easy to hard ones</div>
                              </div><!-- /.col-3 -->
                            </div><!-- /.row -->
                            <button class="btn btn-success"><a href="{{ lang_url('chapters/'.$chapter->id.'/test/serve') }}" class="text-white"> Start Test</a></button>
                          </li>
                          `);
                          $('#test_model').modal('show');
                        }
                    } 
                    // return next video
                    else {

                      var videoSrc = response;
                      next_video.find('video').removeClass('d-none');
                      next_video.find('source').attr('src', videoSrc);
                      next_video.find('video')[0].load();

                      $('#video_list_'+videonative_id+' h4 span i').removeClass('text-dark').addClass('text-success');
                      $('#video_list_'+videonative_id).next('li').find('.attachmentsOfVideo').removeClass('d-none');
                    }
                });

          });
        });


    </script>
@endpush
@stop