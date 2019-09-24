
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
                  <h2 class="title text-white">@t('Chapter Test')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: about -->
 

   <?php 
    if (count($chapterExamQuestions) > 0): ?>
   <section class="divider">
      <div class="container">
         <div class="row pt-30 rtl">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
               <h4>{{ $chapter->name  }} @t('Test')</h4>
               <h6>@t('Question') <span class="question_no">@t('1')</span>@t(' Out of'){{count($chapterExamQuestions)}} </h6>
            </div>
            <!-- /.col-8 -->
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 time_remaining_div">
               <p class="text-dark">@t('Time Remaining:') <span class="time_remaining" id="time_remaining"></span></p>
            </div>
            <!-- /.col-3 -->
         </div>
         <img class="question_loader_lg" src="/public/loading-lg.gif">
         <input type="hidden" class="percentageCalculate" value="0" />
         <input type="hidden" class="min_pass" value="{{ $chapterExamQuestions[0]->min_pass }}" />
         <?php foreach ($chapterExamQuestions as $key => $chapterExamQuestion): ?>
         <div class="questionwithoptions {{ $key != 0 ? 'hide' : NULL }}">
            <input type="hidden" class="questionTimeRemaining" value="{{ $chapterExamQuestion->question_time }}" />
            <div class="row mb-3">
               <?php 
                  if ($chapterExamQuestion->question_type == 'image'): ?>
               <div class="col-12 text-center">
                  <img class="img img-responsive" src="\public\storage\{{ $chapterExamQuestion->question_image }}" />
               </div>
               <!-- /.col-12 -->
               <?php endif ?>
               <?php if ($chapterExamQuestion->question_type == 'text'): ?>
               <div class="col-12">
                  <div class="ques_title"> {{ $chapterExamQuestion->question_title }}</div>
               </div>
               <!-- /.col-12 -->
               <?php endif ?>
            </div>
            <!-- /.row -->
            <?php $options = json_decode($chapterExamQuestion->answers); ?>
            <div id="altcontainer">
               <?php if ($options): ?>
               <?php foreach ($options as $key => $option): ?>
               <label class="radiocontainer"> 
               {{ $option->option }}
               <input type="radio" name="quiz" value="{{ $option->id }}" data-chapter_native_id="{{  $chapter->id }}"  data-question_id="{{ $chapterExamQuestion->question_id }}" data-exam_id="{{  $chapterExamQuestion->exam_id }}">
               <span class="checkmark"></span>
               </label>
               <?php endforeach ?>
               <?php endif ?>
            </div>
            <button class="answerbutton btn btn-success mt-4 mb-2">@t('Continue') ❯</button>
            <button class="previousQuestion btn btn-success mt-4 mb-2 ">@t('Back') ❯</button>
         </div>
         <!-- /.questionwithoptions -->
         <?php endforeach ?>
         <?php else: ?>
         <div class="podcast-detail all_questions_show row pt-3 pb-3">
            @t('Test not added yet')
         </div>
         <?php endif ?>
         <div class="podcast-detail test_complete_result row pt-3 pb-3">
            <div class="col-xs-12">
               <div class="row">
                  <div class="col-xs-9">
                     <h4>@t('Your Score')</h4>
                     <h6>@t("Congratulations! You've Completed the") {{ $chapter->name }} @t('Test') </h6>
                  </div>
                  <!-- /.col-xs-9 -->
               </div>
               <!-- /.row -->
            </div>
            <div class="col-xs-12">
               <div class="row border p-3">
                  <div class="col-xs-7">
                     <p class="text-secondary m-0">@t('Score')</p>
                     <p class="text-secondary m-0"><span class="test_percentage text-dark"></span>@t('% out of 100%')</p>
                  </div>
                  <!-- /.col-xs-6 -->
                  <div class="col-xs-5">
                     <p class="text-secondary m-0">@t('Rating')</p>
                     <p><span class="test_result text-dark m-0"></span></p>
                  </div>
                  <!-- /.col-xs-6 -->
               </div>
               <!-- /.row -->
               <div class="row m-3 text-left">
                  <a href="{{ lang_url('all_tests') }}"><button class="btn btn-lg btn-success">@t('Done')</button></a>
               </div>
               <!-- /.row -->
            </div>
            <!-- /.col-xs-12 -->
         </div>
         <div class="separator separator-rounedd"></div>
      </div>
   </section>
</div>
<!-- end main-content -->
<?php if (count($chapterExamQuestions) > 0): ?>
@push('scripts')
<script>
   jQuery(document).ready(function($) {
   
     // remaining timer 
     document.getElementById('time_remaining').innerHTML = '{{ $chapterExamQuestions[0]->question_time }}';
     var timerStart;
     startTimer();
   
     function startTimer() {
       var presentTime = document.getElementById('time_remaining').innerHTML;
       var timeArray = presentTime.split(/[:]+/);
       var m = timeArray[0];
       var s = checkSecond((timeArray[1] - 1));
       if(s==59){m=m-1}
       
       document.getElementById('time_remaining').innerHTML =
         m + ":" + s;
       timerStart = setTimeout(startTimer, 1000);
       if(m<0){
         document.getElementById('time_remaining').innerHTML = '{{ $chapterExamQuestions[0]->question_time }}';
   
         clearTimeout(timerStart);
   
         var $this = $(document).find('.questionwithoptions:not(.hide) button.answerbutton'),
             answerparent = $this.parent().find('.radiocontainer').first(),
             answerElem = answerparent.find('input[name="quiz"]');
             answer = 0,
             exam_id = answerElem.attr('data-exam_id'),
             question_id = answerElem.attr('data-question_id'),
             qustionDiv = $this.parent(),
             remainingQuestions = qustionDiv.next('.questionwithoptions').length,
             initPercentage = $('.percentageCalculate').val(),
             chapter_native_id = answerElem.attr('data-chapter_native_id'),
   
             min_passing = $('.min_pass').val();
   
             qustionDiv.css('opacity', '0.2');
   
             $.ajax({
                     type: 'POST',
                     url: '{{ lang_url("test_answer") }}',
                     data: {"_token": "{{ csrf_token() }}", 'user_id':'{{ Auth::user()->id }}', 'exam_id':exam_id, 'question_id':question_id, 'answer':answer, 'remainingQuestions':remainingQuestions, 'initPercentage':initPercentage, 'min_passing':min_passing, 'chapter_native_id':chapter_native_id},
                 })
                 .done(function(response) {


   
                   var nextQuestion = qustionDiv.fadeOut().next('.questionwithoptions');
                   $('.percentageCalculate').val(response['percentage']);

                   $('.test_result').html(response['result']);
   
   
                   if (nextQuestion.length > 0) {
                    
                     nextQuestion.fadeIn("slow", function() {
                         $(this).removeClass("hide");
                         $('#time_remaining').html(nextQuestion.find('.questionTimeRemaining').val());
                         setTimeout(startTimer, 1000);
                         $('.question_no').html(parseInt($('.question_no').html()) +1);
                     });
                     qustionDiv.remove();
                     $('.question_loader_lg').hide();
   
                   } else {
                     $('.time_remaining_div').remove();
                     $('.test_complete_result .test_percentage').html($('.percentageCalculate').val());
                     $('.test_complete_result').fadeIn();
                     $('.question_loader_lg').hide();
                   }
   
                 });
   
               
       }
     }
   
     function checkSecond(sec) {
       if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
       if (sec < 0) {sec = "59"};
       return sec;
     }
   
   
   
   
     $(document).on('click', '.questionwithoptions:not(.hide) .radiocontainer', function(e) {
       var $this = $(this);
       $this.addClass('checkedlabel').siblings('label').removeClass('checkedlabel');
     });
   
     $(document).on('click', '.questionwithoptions:not(.hide) button.answerbutton', function(e) {
       clearTimeout(timerStart);
       $('.question_loader_lg').show();
       var $this = $(this),
           answerElem = $('.radiocontainer input[name="quiz"]:checked'),
           answer = answerElem.val(),
           exam_id = answerElem.attr('data-exam_id'),
           question_id = answerElem.attr('data-question_id'),
           qustionDiv = $this.parent(),
           remainingQuestions = qustionDiv.next('.questionwithoptions').length,
           initPercentage = $('.percentageCalculate').val(),
           chapter_native_id = answerElem.attr('data-chapter_native_id'),
   
           min_passing = $('.min_pass').val();
   
           qustionDiv.css('opacity', '0.2');
   
       if (answerElem.length > 0) {
         
          var totalQuestion={{count($chapterExamQuestions)}};


         $.ajax({
                 type: 'POST',
                 url: '{{ lang_url("test_answer") }}',
                 data: {"_token": "{{ csrf_token() }}", 'user_id':'{{ Auth::user()->id }}', 'exam_id':exam_id, 'question_id':question_id, 'answer':answer, 'remainingQuestions':remainingQuestions, 'initPercentage':initPercentage, 'min_passing':min_passing, 'chapter_native_id':chapter_native_id,'totalQuestion':totalQuestion},
             })
             .done(function(response) {
   
               var nextQuestion = qustionDiv.fadeOut().next('.questionwithoptions');
               $('.percentageCalculate').val(response['percentage']);
               $('.test_result').html(response['result']);
   
   
               if (nextQuestion.length > 0) {
                
                 nextQuestion.fadeIn("slow", function() {
                     $(this).removeClass("hide");
                     $('#time_remaining').html(nextQuestion.find('.questionTimeRemaining').val());
                     setTimeout(startTimer, 1000);
                     $('.question_no').html(parseInt($('.question_no').html()) +1);
                 });
                 qustionDiv.remove();
                 $('.question_loader_lg').hide();
   
               } else {
                 $('.time_remaining_div').remove();
                 $('.question_loader_lg').hide();
                 $('.test_complete_result .test_percentage').html($('.percentageCalculate').val());

                 $('.test_complete_result').fadeIn();

                
               }
   
             });
         
       }
       else
       {

                    var nextQuestion = qustionDiv.fadeOut().next('.questionwithoptions');

                   if (nextQuestion.length > 0) {
                    
                     nextQuestion.fadeIn("slow", function() {
                         $(this).removeClass("hide");
                         $('#time_remaining').html(nextQuestion.find('.questionTimeRemaining').val());
                         setTimeout(startTimer, 1000);
                         $('.question_no').html(parseInt($('.question_no').html()) +1);
                     });
                     qustionDiv.remove();
                     $('.question_loader_lg').hide();
   
                   } else {
                     $('.time_remaining_div').remove();
                     $('.test_complete_result .test_percentage').html($('.percentageCalculate').val());
                     $('.test_complete_result').fadeIn();
                     $('.question_loader_lg').hide();
                     if($('.percentageCalculate').val()==0)
                     {
                       $('.test_result').html("Not Passed");
                    }
                   }


       }

       
     });


      $(document).on('click', '.questionwithoptions:not(.hide) button.previousQuestion', function(e) {
     
                       var $this = $(this);
                      qustionDiv = $this.parent();
                   
                    var nextQuestion = qustionDiv.fadeOut().prev('.questionwithoptions');

                  

                  
                    
                     nextQuestion.fadeIn("slow", function() {
                         $(this).removeClass("hide");
                         $('#time_remaining').html(nextQuestion.find('.questionTimeRemaining').val());
                         setTimeout(startTimer, 1000);
                         $('.question_no').html(parseInt($('.question_no').html()) -1);
                     });
                     qustionDiv.remove();
                     $('.question_loader_lg').hide();
   
                  
   
                  

          
       

     });




     
   });
</script>
@endpush
<?php endif ?>
@stop
