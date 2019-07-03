@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo_trans.png" alt="Logo" class="logo_black"></a>
            <h1 class="text-center"><span>Chapter Test</span></h1>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-9">
      </div>
   </div>
</div>
<?php if (count($chapterExamQuestions) > 0): ?>
<div class="podcast-detail all_questions_show row pt-3 pb-3">
   <div class="col-12">
    <div class="row question_title_with_time">
      <div class="col-9">
        <h4>{{ $chapter->name  }} Test</h4>
        <h6>Question <span class="question_no">1</span> Out of 10</h6>
      </div><!-- /.col-8 -->
      <div class="col-3">
        <p class="text-dark">Time Remaining: <span class="time_remaining" id="time_remaining"></span></p>
      </div><!-- /.col-3 -->
    </div><!-- /.row -->
<img class="question_loader_lg" src="\public\loading-lg.gif">
<input type="hidden" class="percentageCalculate" value="0" />
<input type="hidden" class="min_pass" value="{{ $chapterExamQuestions[0]->min_pass }}" />
  <?php foreach ($chapterExamQuestions as $key => $chapterExamQuestion): ?>
    
  <div class="questionwithoptions {{ $key != 0 ? 'd-none' : NULL }}">
    <input type="hidden" class="questionTimeRemaining" value="{{ $chapterExamQuestion->question_time }}" />
    <div class="row mb-3">
      <?php if ($chapterExamQuestion->question_type == 'image'): ?>
        
        <div class="col-12 text-center">
          <img class="img img-responsive" src="\public\storage\{{ $chapterExamQuestion->question_image }}" />
        </div><!-- /.col-12 -->

      <?php endif ?>

      <?php if ($chapterExamQuestion->question_type == 'text'): ?>
        
        <div class="col-12">
          <div class="ques_title"> {{ $chapterExamQuestion->question_title }}</div>
        </div><!-- /.col-12 -->
      
      <?php endif ?>

    </div><!-- /.row -->
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

    <button class="answerbutton btn btn-success mt-4 mb-2">Continue ❯</button>

  </div><!-- /.questionwithoptions -->

  <?php endforeach ?>
<?php else: ?>
  <div class="podcast-detail all_questions_show row pt-3 pb-3">
    Test not added yet
  </div>

<?php endif ?>
<div class="podcast-detail test_complete_result row pt-3 pb-3">
  <div class="col-12">
    <div class="row">
      <div class="col-9">
        <h4>Your Score</h4>
        <h6>Congratulations! You've Completed the {{ $chapter->name  }} Test</h6>
      </div><!-- /.col-9 -->
    </div><!-- /.row -->
  </div>
  <div class="col-12">
    <div class="row border p-3">
      <div class="col-7">
        <p class="text-secondary m-0">Score</p>
        <p class="text-secondary m-0"><span class="test_percentage text-dark"></span>% out of 100%</p>
      </div><!-- /.col-6 -->
      <div class="col-5">
        <p class="text-secondary m-0">Rating</p>
        <p><span class="test_result text-dark m-0"></span></p>
      </div><!-- /.col-6 -->
    </div><!-- /.row -->
    <div class="row m-3">
      <a href="{{ lang_url('all_tests') }}"><button class="btn btn-lg btn-success">Done</button></a>
    </div><!-- /.row -->
  </div><!-- /.col-12 -->
</div>

   </div>
</div>

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

        var $this = $(document).find('.questionwithoptions:not(.d-none) button.answerbutton'),
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
                        $(this).removeClass("d-none");
                        $('#time_remaining').html(nextQuestion.find('.questionTimeRemaining').val());
                        setTimeout(startTimer, 1000);
                        $('.question_no').html(parseInt($('.question_no').html()) +1);
                    });
                    qustionDiv.remove();
                    $('.question_loader_lg').hide();

                  } else {
                    $('.all_questions_show .question_title_with_time').remove();
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





    
    $(document).on('click', '.questionwithoptions:not(.d-none) .radiocontainer', function(e) {
      var $this = $(this);
      $this.addClass('checkedlabel').siblings('label').removeClass('checkedlabel');
    });

    $(document).on('click', '.questionwithoptions:not(.d-none) button.answerbutton', function(e) {
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
                    $(this).removeClass("d-none");
                    $('#time_remaining').html(nextQuestion.find('.questionTimeRemaining').val());
                    setTimeout(startTimer, 1000);
                    $('.question_no').html(parseInt($('.question_no').html()) +1);
                });
                qustionDiv.remove();
                $('.question_loader_lg').hide();

              } else {
                $('.all_questions_show .question_title_with_time').remove();
                $('.test_complete_result .test_percentage').html($('.percentageCalculate').val());
                $('.test_complete_result').fadeIn();
                $('.question_loader_lg').hide();
              }

            });
        
      }
      
    });
    
  });
</script>
@endpush
<?php endif ?>

@stop