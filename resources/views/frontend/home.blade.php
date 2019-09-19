@extends('frontend.template.layout')



@section('title') <?= $title; ?> @stop



@section('content')



<!-- Start main-content -->

  <div class="main-content">

    <!-- Section: home -->

    <section id="home" class="divider">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="/frontend/_assets/images/slide-1.png">
            <div class="carousel-caption custom-caption">
              <h1 class="text-white font-weight-500 mb-0 mt-0 font-32">@t('أساسيات التعامل حتي الأحترافية في التداول السعودي')</h1>
              <h4 class="text-white font-weight-400 mb-0 mt-0 font-22 mt-20">@t('حاصل علي ترخيص من المؤؤسة العامة للتدريب التقني والمهني')</h4>
            </div>
          </div>

          <div class="item">
            <img src="/frontend/_assets/images/slide-1.png">
            <div class="carousel-caption custom-caption">
              <h1 class="text-white font-weight-500 mb-0 mt-0 font-32">@t('أساسيات التعامل حتي الأحترافية في التداول السعودي')</h1>
              <h4 class="text-white font-weight-400 mb-0 mt-0 font-22 mt-20">@t('حاصل علي ترخيص من المؤؤسة العامة للتدريب التقني والمهني')</h4>
            </div>
          </div>

          <div class="item">
            <img src="/frontend/_assets/images/slide-1.png">
            <div class="carousel-caption custom-caption">
              <h1 class="text-white font-weight-500 mb-0 mt-0 font-32">@t('أساسيات التعامل حتي الأحترافية في التداول السعودي')</h1>
              <h4 class="text-white font-weight-400 mb-0 mt-0 font-22 mt-20">@t('حاصل علي ترخيص من المؤؤسة العامة للتدريب التقني والمهني')</h4>
            </div>
          </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
          <span class="sr-only">@t('Previous')</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
          <span class="sr-only">@t('Next')</span>
        </a>
      </div>

    </section>

    <!-- Section: About -->

    <section class="divider bg-white">

      <div class="container">

          <div class="section-content">

              <div class="row">

                    <div class="col-md-12 text-right">

                        <h2 class="mt-0 mb-50 font-30 heading-title-spec">@t('أحدث الأخبار ')</h2>

                    </div>

             </div>

             

              <div class="row">

                <div class="col-md-12">

                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">

                        <div class="item ">

                          <div class="service-block bg-white">

                            <div class="thumb">

                                <img alt="featured project" src="/frontend/_assets/images/media-1.png" class="img-fullwidth">

                            </div>

                            <div class="content flip p-25 pt-0 text-center">

                              <h3>@t('عنوان الخبر')</h3>

                              <p class="text-right">@t('أن نكون الخيار الأول في  معرفة التداولأن نكون الخيار الأول في  معرفة التداولأن نكون الخيار الأول في  معرفة التداول')</p>

                            </div>

                          </div>

                        </div>

                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">

                        <div class="item ">

                          <div class="service-block bg-white">

                            <div class="thumb">

                                <img alt="featured project" src="/frontend/_assets/images/media-2.png" class="img-fullwidth">

                            </div>

                            <div class="content flip p-25 pt-0 text-center">

                              <h3>@t('عنوان الخبر')</h3>

                              <p class="text-right">@t('أن نكون الخيار الأول في  معرفة التداولأن نكون الخيار الأول في  معرفة التداولأن نكون الخيار الأول في  معرفة التداول')</p>

                            </div>

                          </div>

                        </div>

                    </div>

                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">

                        <div class="item ">

                          <div class="service-block bg-white">

                            <div class="thumb">

                                <img alt="featured project" src="/frontend/_assets/images/media-3.png" class="img-fullwidth">

                            </div>

                            <div class="content flip p-25 pt-0 text-center">

                              <h3>@t('عنوان الخبر')</h3>

                              <p class="text-right">@t('أن نكون الخيار الأول في  معرفة التداولأن نكون الخيار الأول في  معرفة التداولأن نكون الخيار الأول في  معرفة التداول')</p>

                            </div>

                          </div>

                        </div>

                    </div>

                </div>

              </div>  

               

          </div>

      </div>

    </section>

      

    <div class="separator separator-rouned"></div>  

      

    <!-- Section: Parteners --> 

    <section class="bg-white">

        <div class="container">

            <div class="section-content">

                <div class="row">

                    <div class="col-md-12 rtl p-0">

                        <h2 class="mt-0 mb-50 font-30 heading-title-spec">@t('شركائنا ')</h2>

                    </div>

                </div>

                <div class="row clients">

                    <div class="col-md-3 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                        <div class="parteners-white-block">

                            <img src="/frontend/_assets/images/part-1.png">

                        </div> 

                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                        <div class="parteners-white-block">

                            <img src="/frontend/_assets/images/part-2.png">

                        </div> 

                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                        <div class="parteners-white-block">

                            <img src="/frontend/_assets/images/part-3.png">

                        </div> 

                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                        <div class="parteners-white-block">

                            <img src="/frontend/_assets/images/part-4.png">

                        </div> 

                    </div>

                </div>

            </div>

        </div>

      </section>  

      

  </div>

  <!-- end main-content -->

@push('scripts')

  <script>
  $(document).ready(function() {
    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#imagePreview').css('background-image', 'url('+e.target.result +')');
              $('#imagePreview').hide();
              $('#imagePreview').fadeIn(650);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  $("#imageUpload").change(function() {
      readURL(this);
  });
  });
  </script>    
  <script>
      $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });
  $(document).ready(function(){
    
    
  var colorPalette = ['000000', 'FF9966', '6699FF', '99FF66', 'CC0000', '00CC00', '0000CC', '333333', '0066FF', 'FFFFFF'];
    var forePalette = $('.fore-palette');
    var backPalette = $('.back-palette');

    for (var i = 0; i < colorPalette.length; i++) {
      forePalette.append('<a href="#" data-command="foreColor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
      backPalette.append('<a href="#" data-command="backColor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
    }
    $('.toolbar a').click(function(e) {
      e.preventDefault();
      var command = $(this).data('command');
      if (command == 'h1' || command == 'h2' || command == 'p') {
        document.execCommand('formatBlock', false, command);
      }
      if (command == 'foreColor' || command == 'backColor') {
        var color = $(this).data('value');
        document.execCommand($(this).data('command'), false, color);
        alert(color);
      }
      if (command == 'removeFormat') {
        document.execCommand('removeFormat', false, command);
      }
      if (command == 'createlink' || command == 'insertimage') {
        url = prompt('Enter the link here: ', 'http:\/\/');
        document.execCommand($(this).data('command') && 'enableObjectResizing', false, url);
      } else document.execCommand($(this).data('command'), false, null);
    });
    $('.editorAria img').click(function(){
        document.execCommand('enableObjectResizing', false);
    });
    $("#getHTML").click(function(){
      var editorId = $(this).attr('get-data');
      var html = $("#" + editorId).find('.editorAria').html();
      alert(html);
    });
  });
      
  </script>
@endpush

@stop