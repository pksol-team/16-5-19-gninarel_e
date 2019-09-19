<?php 
   use Carbon\Carbon;
   use App\VideoNative;
   use App\User_access;
   use App\User;
   use App\Comment;
   use App\Exams;
   use App\UserLoginDetail;
   use App\UserLoginNotify;
   use App\Notification;
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

       $newNotification = [
         'table_ID' => Auth::user()->id,
         'slug' => 'users',
         'title' => 'Unknown device login',
         'short_desc' => Auth::user()->email.' has logged in from other device',
         'url' => 'admin/users/'.Auth::user()->id.'/edit',
         'status' => 0,
           'created_at' => Carbon::now()
       ];

       Notification::insert($newNotification);
   
     }
   
   }
   
   $testSkipCheck = Exams::where('chapter_id', '=',  $chapter->id)->whereBetween('min_pass', [1, 100])->get();
   
   $skipTest = count($testSkipCheck);
   
   ?>
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
                  <li><a href="index.html">الصفحة الرئيسية</a></li>
                  <li class="active text-gray-silver">الأنشطة التدريبية</li>
               </ol>
               <h2 class="title text-white">احتراف التداول 1</h2>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="divider bg-white">
   <div class="container pt-150">
      <div class="row">
         <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="vertical-tab">
               <ul class="nav nav-tabs">
                  <li class=""><a href="{{ lang_url('profile') }}"><img src="/frontend/_assets/images/icon-1.png" class="img-responsive" alt="icon-1"/> الملف الشخصي </a></li>
                  <li><a href="{{ lang_url('all_purchases') }}"><img src="/frontend/_assets/images/icon-2.png" class="img-responsive" alt="icon-2"/> مشترياتي</a></li>
                  <li><a href="{{ lang_url('all_subscriptions') }}"><img src="/frontend/_assets/images/icon-3.png" class="img-responsive" alt="icon-3"/> باقاتي</a></li>
                  <li><a href="{{ lang_url('schools') }}"><img src="/frontend/_assets/images/icon-4.png" class="img-responsive" alt="icon-4"/> المدرسة  الالكترونية</a></li>
                  <li class="active"><a href="{{ lang_url('training_activities') }}"><img src="/frontend/_assets/images/icon-5.png" class="img-responsive" alt="icon-5"/> الانشطة التدريبة</a></li>
                  <li><a href="{{ lang_url('communication') }}"><img src="/frontend/_assets/images/icon-6.png" class="img-responsive" alt="icon-6"/> التواصل </a></li>
                  <li><a href="{{ lang_url('logout_frontend') }}" ><img src="/frontend/_assets/images/icon-7.png" class="img-responsive" alt="icon-7"/> خروج</a></li>
               </ul>
            </div>
         </div>
         <div class="col-md-9 col-sm-9-col-xs-12">
            <?php 
               $chapter_id = $chapter->chapters->id;
               $videoNative = VideoNative::with('videos')->whereHas('videos', function ($query) use ($chapter_id) {
                  $query->where('chapter_id', $chapter_id);
               })->where([['lang', Request::locale()], ['status', 'active']])->get();
               
                  $chapterCompleted = User_access::where([['user_id', Auth::user()->id], ['object_type', 'chapter'], ['object_id', $chapter_id], ['status', 'completed']])->first();
               ?>
            <?php if (count($chapterCompleted) > 0): ?>
            <?php if ($skipTest > 0): ?>
            <div class="p-4 mb-5 videos_design_li">
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
                           <a href="{{ lang_url('chapters/'.$chapter->id.'/test/serve') }}" class="text-white">
                           <button type="button" class="btn btn-primary">Start Test</button>
                           </a>
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
               <div class="row" style="margin-bottom:10px;">
                  <div class="col-xs-2">
                     <div>Questions:</div>
                     <div>Time:</div>
                     <div>Difficulty:</div>
                  </div>
                  <!-- /.col-3 -->
                  <div class="col-xs-10">
                     <div>From 10 up to 10 Questions</div>
                     <div>About 10 Minutes</div>
                     <div>The test will provide a variety of question from easy to hard ones</div>
                  </div>
                  <!-- /.col-3 -->
               </div>
               <!-- /.row -->
               <button class="btn btn-success"><a href="{{ lang_url('chapters/'.$chapter->id.'/test/serve') }}" class="text-white"> Start Test</a></button>
            </div>
            <?php endif ?>
            <?php endif ?>
         </div>
         <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="tab-content">
               <div class="tab-pane fade" id="tab1">
               </div>
               <div class="tab-pane fade in active" id="tab5">
                  <div class="row mb-30">
                     <div class="col-md-12">
                        <h2 class="text-right color-theme-green">التفاصيل</h2>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="table-responsive table-condensed">
                           <table class="table sub-table border-white">
                              <tbody>
                                 <tr>
                                    <td class="bg-lighter">عنوان النشاط </td>
                                    <td>احتراف التداول 1</td>
                                    <!-- <td class="bg-lighter">تاريخ النشاط</td>
                                       <td>22/1/2019</td>
                                       <td class="bg-lighter">الحالة </td>
                                       <td>انتهت  </td>
                                       <td class="bg-lighter">المكان   </td>
                                       <td>اونلاين   </td> -->
                                 </tr>
                                 <tr>
                                    <td class="bg-lighter">{{ $chapter->name }} </td>
                                    <td>{{ $chapter->description }}</td>
                                    <!-- <td class="bg-lighter">نوع النشاط</td>
                                       <td>دورة </td>
                                       <td class="bg-lighter">المدة </td>
                                       <td>88  </td>
                                       <td class="bg-lighter">العدد   </td>
                                       <td>1200   </td> -->
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="row mt-30">
                     <!-- <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="vertical-tab sub-tabs">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#lesson1" data-toggle="tab"> الدرس الاول</a></li>
                            <li class=""><a href="#lesson2" data-toggle="tab"> الدرس الثاني</a></li>
                            <li class=""><a href="#lesson3" data-toggle="tab"> الدرس الثالث</a></li>
                            <li class=""><a href="#lesson4" data-toggle="tab"> الدرس الرابع</a></li>
                            <li class=""><a href="#lesson5" data-toggle="tab"> الدرس الخامص</a></li>
                          </ul>
                        </div>
                        </div> -->
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php if (count($videoNative) > 0): ?>
                        <?php foreach ($videoNative as $key => $video): ?>
                        <div class="row main_comment_{{ $video->id }} mainVideosDiv" data-videonative-id="{{ $video->id }}" id="video_list_{{ $video->id }}">
                           <?php 
                              $videoWatchedSingle = User_access::where([['user_id', Auth::user()->id], ['object_type', 'video'], ['object_id', $video->video_id], ['status', 'watched']])->first();
                              
                              ?>
                           <h4 class="color-dark-green">{{ $video->name }} <span style="font-size: 1.2em;"><i class="fa fa-check-circle" style="color:{{ $videoWatchedSingle ? '#3c763d' : '#000' }};" aria-hidden="true"></i></h4>
                           <p class="color-dark-green">{{ $video->description }}</p>
                           <?php $decodedVideo = json_decode($video->video_upload); ?>
                           <?php if (count($decodedVideo) > 0): ?>
                           <div class="fluid-video-wrapper">
                              <?php if ($key == 0): ?>
                              <video data-user-id="{{ Auth::user()->id }}" data-video-id="{{ $video->videos->id }}" data-videonative-id="{{ $video->id }}" class="plyr_Player" width="100%" height="530" ata-plyr-config='{ "title": "{{ $video->name }}" }' playsinline controls disablePictureInPicture controlsList="nodownload">
                                 <source src="\public\storage\{{ $decodedVideo[0]->download_link }}" type="video/mp4" />
                                 <source src="\public\storage\{{ $decodedVideo[0]->download_link }}" type="video/webm" />
                              </video>
                              <?php else: ?>
                              <?php $videoWatched = User_access::where([['user_id', Auth::user()->id], ['object_type', 'video'], ['object_id', $last_video_id], ['status', 'watched']])->first(); 
                                 ?>
                              <video data-user-id="{{ Auth::user()->id }}" data-video-id="{{ $video->videos->id }}" data-videonative-id="{{ $video->id }}" class="{{ $videoWatched ? NULL : 'hide' }} plyr_Player" width="100%" height="530" ata-plyr-config='{ "title": "{{ $video->name }}" }' playsinline controls>
                                 <source src="{{ $videoWatched ? '\\public\storage\\'.$decodedVideo[0]->download_link : NULL }}" type="video/mp4" />
                                 <source src="{{ $videoWatched ? '\\public\storage\\'.$decodedVideo[0]->download_link : NULL }}" type="video/webm" />
                              </video>
                              <?php endif ?>
                           </div>
                           <?php endif ?>
                           <div class="separator separator-rounedd"></div>
                           <h4 class="color-dark-green">المرفقات</h4>
                           <?php if ($key == 0): ?>
                           <div class="m-0">
                              <?php $allAttachments = json_decode($video->attachments); ?>
                              <?php if (count($allAttachments) > 0): ?>
                              <?php foreach ($allAttachments as $key => $attch): ?>
                              <p><a target="_blank" href="\public\storage\{{ $attch->download_link }}">الملف الاول <span class="color-dark-green mr-20 ml-10">{{ substr($attch->original_name, -20) }}</span><i class="fa fa-paperclip"></i></a></p>
                              <?php endforeach ?>
                              <?php else: ?>
                              <div class="m-0">
                                 <p>No Attachment Found!</p>
                              </div>
                              <?php endif ?>
                           </div>
                           <?php else: ?>
                           <div class="m-0 attachmentsOfVideo {{ $videoWatched ? NULL : 'hide' }}">
                              <?php $allAttachments = json_decode($video->attachments); ?>
                              <?php if (count($allAttachments) > 0): ?>
                              <?php foreach ($allAttachments as $key => $attch): ?>
                              <p><a target="_blank" href="\public\storage\{{ $attch->download_link }}">الملف الاول <span class="color-dark-green mr-20 ml-10">{{ substr($attch->original_name, -20) }}</span><i class="fa fa-paperclip"></i></a></p>
                              <?php endforeach ?>
                              <?php else: ?>
                              <div class="m-0">
                                 <p>No Attachment Found!</p>
                              </div>
                              <?php endif ?>
                           </div>
                           <?php endif ?>
                           <div class="separator separator-rounedd"></div>
                           <div class="comments-area">
                              <h5 class="comments-title color-dark-green">التعليقات الخاصة</h5>
                              <ul class="comment-list">
                                 <?php $allComments = Comment::where([['status', 'active'], ['parent_id', 0], ['video_id', $video->id]])->orderBy('id', 'ASC')->get(); ?>
                                 <?php if (count($allComments) > 0): ?>
                                 <?php foreach ($allComments as $key => $comment): ?>
                                 <?php $user = User::find($comment->user_id)->first(); ?>
                                 <li>
                                    <div class="media comment-author">
                                       <div class="col-xs-2 text-center">
                                          <img class="img-circle" src="\public\storage\{{ $user->avatar }}">
                                          <h5 class="media-heading comment-heading">{{ $user->name }}</h5>
                                          <div class="comment-date color-dark-green">{{ $comment->created_at }}</div>
                                       </div>
                                       <div class="col-xs-10 media-body bg-lighter p-10">
                                          <div class="comment-section">
                                             <p>{{ $comment->comment }}</p>
                                             <button class="rep-btn comment_reply_button rep-btn pull-right m-0" data-coach_id="{{ $video->user_id }}" data-video_id="{{ $video->id }}" data-parent_id="{{ $comment->id }}">Reply</button>
                                             <?php $allCommentsReply = Comment::where([['status', 'active'], ['parent_id', $comment->id], ['video_id', $video->id]])->orderBy('id', 'DESC')->get(); ?>
                                             <?php if (count($allCommentsReply) > 0): ?>
                                             <?php foreach ($allCommentsReply as $key => $commentReply): ?>
                                             <?php $userReplied = User::find($commentReply->user_id)->first(); ?>
                                             <div class="row replied-comment post-author-{{ $commentReply->id }}">
                                                <div class="replied-comment-img col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                   <img src="\public\storage\{{ $userReplied->avatar }}" class="img-circle">
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                                   <label>{{ $userReplied->name }}</label>
                                                   <p class="comment-done">{{ $commentReply->comment }}</p>
                                                </div>
                                             </div>
                                             <?php endforeach ?>
                                             <?php endif ?>
                                          </div>
                                       </div>
                                    </div>
                                 </li>
                                 <?php endforeach ?>
                                 <?php else: ?>
                                 <li>
                                    <div>No Feedback Given</div>
                                 </li>
                                 <?php endif ?>
                              </ul>
                              <div class="comment-box mt-30">
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <h5>إرسال تعليق للمدرب خاص </h5>
                                       <div class="row">
                                          <form class="comment_form" method="POST" id="form_comment_{{ $video->id }}" action="{{ lang_url('submit_comment') }}">
                                             @csrf
                                             <div class="col-sm-12">
                                                <div class="form-group">
                                                   <textarea class="form-control user_cmnt" required name="current_user_comment"  placeholder="Enter Message" rows="5"></textarea>
                                                   <input type="hidden" name="video_id" value="{{ $video->id }}">
                                                   <input type="hidden" name="coach_id" value="{{ $video->user_id }}">
                                                   <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                </div>
                                                <div class="form-group">
                                                   <button type="submit" class="btn btn-theme-green btn-flat pull-left  m-0" data-loading-text="Please wait...">أرسال</button>
                                                </div>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php $last_video_id = $video->video_id;?>
                        <?php endforeach ?>
                        <?php endif ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</section>
</div>
<!-- end main-content -->
@push('scripts')
<script src="/frontend/assets/js/plyr.js"></script>
<!-- <script src="https://cdn.plyr.io/3.5.3/plyr.polyfilled.js"></script> -->
<script>
   jQuery(document).ready(function($) {
       //comment reply button click show reply box
       $(document).on('click', '.comment_reply_button', function(e) {
           e.preventDefault();
           var $this = $(this),
               replyBox = $this.parent().children('.rep-btn-section').length,
               video_id = $this.attr('data-video_id'),
               coach_id = $this.attr('data-coach_id'),
               parent_id = $this.attr('data-parent_id'),
               replyForm = `<div class="rep-btn-section float-left col-11">
                <form method="POST" id="form_comment_` + video_id + `" class="comment_form" action="{{ lang_url('submit_comment') }}">
                  <div class="inner-comment">
                @csrf
                    <img src="\\public\\storage\\{{ Auth::user()->avatar }}" class="img-circle" alt="image description"">
                    <textarea name="current_user_comment" class="user_cmnt w-100 form-control" placeholder="Write your reply here" style="resize: none;"></textarea>
                     <input type="hidden" name="video_id" value="` + video_id + `">
                     <input type="hidden" name="coach_id" value="` + coach_id + `">
                     <input type="hidden" name="parent_id" value="` + parent_id + `">
                     <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                       <button type="submit" class="btn btn-success comment">Comment</button>
                  </form>
                </div>`;
   
           if (replyBox < 1) {
               $this.parent().append(replyForm);
           }
   
       });
       // load model 
   
       $('#test_model').modal('show');
   
   
       // comment 
   
       $(document).on('submit', '.comment_form', function(e) {
   
           e.preventDefault();
   
           var $this = $(this),
   
               commentLength = $this.find('textarea').val().trim().length,
   
               formData = $this.serialize(),
   
               current_user_comment = $this.find('textarea[name=current_user_comment]'),
               coach_id = $this.find('input[name=coach_id]'),
   
               commentForAppend = current_user_comment.val(),

               coach_idAppend = coach_id.val(),
   
               parent = $this.find('input[name=parent_id]').val(),
   
               video_id = $this.find('input[name=video_id]').val(),
   
               loader = '\\public\\loading.gif';
   
   
   
           // comment textarea is empty or spaces check
   
           if (commentLength > 0) {
   
               current_user_comment.val('');
   
               var commentBtn = $this.find('.comment');
   
               commentBtn.html('<img src="' + loader + '" class="mr-1 ml-1">Comment').attr('disabled', '1');
   
   
   
               $.ajax({
   
                       type: 'POST',
   
                       url: '{{ lang_url("submit_comment") }}',
   
                       data: formData,
   
                   })
   
                   .done(function(response) {
   
                       commentBtn.html('Comment').removeAttr('disabled');
   
                       // new comment
   
                       if (parent == undefined) {
                           $(".main_comment_" + video_id + " ul.comment-list li:contains('No Feedback Given')").remove();
   
                           var $newComment = `<li>
                                                       <div class="media comment-author"> 
                                                         <div class="col-xs-2 text-center">
                                                           <img class="img-circle" src="\\public\\storage\\{{ Auth::user()->avatar }}">
                                                           <h5 class="media-heading comment-heading">{{ Auth::user()->name }}</h5>
                                                           <div class="comment-date color-dark-green">{{ Carbon::now() }}</div>
                                                         </div>
                                                         <div class="col-xs-10 media-body bg-lighter p-10">
                                                           <div class="comment-section">
                                                             <p>` + commentForAppend + `</p>
                                                             <button class="rep-btn comment_reply_button rep-btn pull-right m-0" data-coach_id="`+coach_idAppend+`" data-video_id="` + video_id + `" data-parent_id="` + response + `">Reply</button>
                                                           </div>
                                                         </div>
                                                     </div>
                                                     </li>`;
   
                           $('.main_comment_' + video_id).find('ul.comment-list').append($newComment);
   
                           $('.main_comment_' + video_id + ' .comment-list').animate({
                               scrollTop: $('.main_comment_' + video_id + ' .comment-list').prop("scrollHeight")
                           }, 1000);
   
   
                       } else {
   
                           // comment reply
   
                           var $newComment = `
                                             <div class="row replied-comment post-author-` + response + `">
                                               <div class="replied-comment-img col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                 <img src="\\public\\storage\\{{ Auth::user()->avatar }}" class="img-circle">
                                               </div>
                                               <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                                 <label>{{ Auth::user()->name }}</label>
                                                 <p class="comment-done">` + commentForAppend + `</p>
                                               </div>
                                             </div>`;
                           $($newComment).insertBefore('.main_comment_' + video_id + ' .media-body .comment-section .rep-btn-section');
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
           next_video = $('#video_list_' + videonative_id).next('.mainVideosDiv'),
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
   
               data: {
                   "_token": "{{ csrf_token() }}",
                   'user_id': user_id,
                   'videonative_id': videonative_id
               },
   
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
   
       function insertVideoTime() {
   
           if (ResumeTime != videoDuration && ResumeTime != 0) {
   
               $.ajax({
   
                   type: 'POST',
   
                   url: '{{ lang_url("InsertVideoTime") }}',
   
                   data: {
                       "_token": "{{ csrf_token() }}",
                       'user_id': user_id,
                       'videonative_id': videonative_id,
                       'ResumeTime': ResumeTime
                   },
   
               });
   
           }
   
       }
   
   
   
       setInterval(insertVideoTime, 5000);
   
   
   
       // video end event trigged
   
       val.on('ended', event => {
   
           // val.on('pause', event => {
   
           const instance = event.detail.plyr;
   
   
   
           $.ajax({
   
               type: 'POST',
   
               url: '{{ lang_url("deleteVideoTime") }}',
   
               data: {
                   "_token": "{{ csrf_token() }}",
                   'user_id': user_id,
                   'videonative_id': videonative_id
               },
   
           });
   
   
   
   
           $.ajax({
   
                   type: 'POST',
   
                   url: '{{ lang_url("updatevideowatched") }}',
   
                   data: {
                       "_token": "{{ csrf_token() }}",
                       'user_id': user_id,
                       'video_id': video_id,
                       'total_videos': total_videos,
                       'chapter_id': chapter_id,
                       "next_video_id": next_video_id
                   },
   
               })
   
               .done(function(response) {
   
                   if (response == 0) {
   
                       // Do Nothing
   
                   }
   
                   // return 1 (record inserted in database, Video watched successufully)
                   else if (response == 1) {
   
                       $('#video_list_' + videonative_id + ' h4 span i').attr('style', 'color:#3c763d;');
   
                       if ('{{ $skipTest }}' > 0) {
   
                           $('.videos_design_li').prepend(`
   
   
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
   
                               <div class="row" style="margin-bottom:10px;">
   
                                 <div class="col-xs-2">
   
                                   <div>Questions:</div>
   
                                   <div>Time:</div>
   
                                   <div>Difficulty:</div>
   
                                 </div>
   
                                 <div class="col-xs-10">
   
                                   <div>From 10 up to 10 Questions</div>
   
                                   <div>About 10 Minutes</div>
   
                                   <div>The test will provide a variety of question from easy to hard ones</div>
   
                                 </div>
   
                               </div>
   
                               <button class="btn btn-success"><a href="{{ lang_url('chapters/'.$chapter->id.'/test/serve') }}" class="text-white"> Start Test</a></button>
   
                             `);
   
                           $('#test_model').modal('show');
   
                       }
   
                   }
   
                   // return next video
                   else {
   
   
   
                       var videoSrc = response;
   
                       next_video.find('video').removeClass('hide');
   
                       next_video.find('source').attr('src', videoSrc);
   
                       next_video.find('video')[0].load();
   
   
   
                       $('#video_list_' + videonative_id + ' h4 span i').attr('style', 'color:#3c763d;');
   
                       $('#video_list_' + videonative_id).next('.mainVideosDiv').find('.attachmentsOfVideo').removeClass('hide');
   
                   }
   
               });
   
   
   
       });
   
   });
</script>
@endpush
@stop