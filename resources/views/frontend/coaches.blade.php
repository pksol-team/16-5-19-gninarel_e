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
              <li><a href="{{ lang_url('') }}">الصفحة الرئيسية</a></li>
              <li class="active text-gray-silver">عن الأتجاه الأفضل</li>
              <li class="active text-gray-silver">المدربين</li>
            </ol>
            <h2 class="title text-white">المدربين</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Divider: Contact -->
  <div class="row">
    <div class="col-xs-10 text-right">
      @if($requestStatus)
      <div class="alert alert-red">
        <ul class="list-unstyled mb-0">
          <li class="text-white">Your have already send coach request! Your request is ({{ ucwords($requestStatus) }})</li>
        </ul>
      </div>
      @endif
      @if(session()->has('message'))
      <div class="alert alert-green">
        <ul class="list-unstyled mb-0">
          <li class="text-white">{!! session()->get('message') !!}</li>
        </ul>
      </div>
      @endif
      @if(session()->has('error'))
      <div class="alert alert-red">
        <ul class="list-unstyled mb-0">
          <li class="text-white">{!! session()->get('error') !!}</li>
        </ul>
      </div>
      @endif
    </div>
    <!-- /.col-xs-10 -->
  </div>
  <!-- /.row -->
  <section class="divider">
    <div class="container">
      <div class="row multi-row-clearfix">
        <?php if ($allUsers): ?>
        <?php //var_dump($allUsers); ?>
        <?php foreach ($allUsers as $key => $coach): ?>
        <div class="col-sm-6 col-md-4 mb-sm-30 sm-text-center mb-30">
          <div class="team maxwidth400">
            <a href="{{ lang_url('coach_profile/'.$coach->users->id) }}">
              <div class="thumb">
                <img class="img-fullwidth" src="\public\storage\{{ $coach->users->avatar }}" alt="{{ $coach->users->name }}">
              </div>
            </a>
            <div class="content p-5 bg-white clearfix text-center">
              <a href="{{ lang_url('coach_profile/'.$coach->users->id) }}">
                <h4 class="name color-dark-green mt-0 mb-5 font-20">{{ $coach->users->name }}  </h4>
              </a>
              <h5 class="color-theme-green">{{ $coach->users->last_name }} </h5>
              <p class="mb-10 color-semi-gray">{{ $coach->users->about }}</p>
              <ul class="styled-icons flat medium list-inline mb-40">
                <li><a href="#"><i class="fa fa-instagram"></i></a> </li>
                <li><a href="#"><i class="fa fa-facebook"></i></a> </li>
                <li><a href="#"><i class="fa fa-twitter"></i></a> </li>
                <li><a href="#"><i class="fa fa-youtube"></i></a> </li>
              </ul>
            </div>
          </div>
        </div>
        <?php endforeach ?>
        <?php else: ?>
        <div class="col-sm-6 col-md-4 mb-sm-30 sm-text-center mb-30">
          <div class="team maxwidth400">
            <div class="content p-5 bg-white clearfix text-center">
              <p class="mb-10 color-semi-gray">Coaches not found!</p>
            </div>
          </div>
        </div>
        <?php endif ?>
        <?php if (Auth::check()): ?>
        <?php $userRole = Auth::user()->role_id; ?>
        <?php if ($userRole != '2' && $userRole != '1'): ?>
        <div class="col-sm-6 col-md-4 mb-sm-30 sm-text-center mb-30">
          <div class="team maxwidth400">
            <a data-toggle="modal" data-target="#join-trainers" class="join-trainers">
              <div class="content border-1px p-60 bg-light clearfix text-center color-semi-gray">
                <i class="fa fa-plus font-60 mb-20" style="color: #E0E0E0"></i>
                <h4 class="mt-0 color-semi-gray mb-5 font-26">إنظمام</h4>
                <p class="mb-10 font-22">انظم لمدربين الاتجاه الأفضل</p>
              </div>
            </a>
          </div>
        </div>
        <?php endif ?>
        <?php else: ?>
        <div class="col-sm-6 col-md-4 mb-sm-30 sm-text-center mb-30">
          <div class="team maxwidth400">
            <a data-toggle="modal" data-target="#join-trainers" class="join-trainers">
              <div class="content border-1px p-60 bg-light clearfix text-center color-semi-gray">
                <i class="fa fa-plus font-60 mb-20" style="color: #E0E0E0"></i>
                <h4 class="mt-0 color-semi-gray mb-5 font-26">إنظمام</h4>
                <p class="mb-10 font-22">انظم لمدربين الاتجاه الأفضل</p>
              </div>
            </a>
          </div>
        </div>
        <?php endif ?>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <nav>
            <ul class="pagination theme-colored pull-center">
              <li> <a href="#" aria-label="Previous"> <span aria-hidden="true">«</span> </a> </li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">...</a></li>
              <li> <a href="#" aria-label="Next"> <span aria-hidden="true">»</span> </a> </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- end main-content -->
<div class="modal fade" id="join-trainers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center color-theme-green font-weight-700 font-26 mt-20 mb-10" id="myModalLabel">انضمام</h4>
        <p class="color-dark-green">نموذج انضمام متدرب جديد لفريق عمل الاتجاه الأفضل 
          فضلاً قم بتعبة النموذج التالي :
        </p>
      </div>
      <div class="modal-body">
        <!-- add new job Form -->
        <form id="add_job" name="add_job" class="form-inline" method="POST" action="{{ lang_url('be_a_coach_submit') }}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputName1">الأسم</label>
                  <input id="InputName1" name="name" class="form-control" type="text" placeholder="الأسم" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                </div>
              </div>
              <!-- <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="city">المدينة </label>
                  <select class="form-control" id="city"> 
                      <option>الرياض</option> 
                      <option>2</option> 
                      <option>3</option> 
                      <option>4</option> 
                      <option>5</option> 
                    </select>
                </div>
                </div> -->
              <!-- <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="gender">الجنس </label>
                  <select class="form-control" id="gender"> 
                      <option>ذكر</option> 
                      <option>أنثي</option> 
                    </select>
                </div>
                </div> -->
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputPhone1">رقم الهاتف المحمول  </label>
                  <input id="InputPhone1" name="phone" class="form-control" type="text" placeholder="رقم الهاتف المحمول" value="{{ Auth::check() ? Auth::user()->phone : '' }}" required>
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputEmail1">رالبريد الإلكتروني</label>
                  <input id="InputEmail1" name="email" class="form-control" type="text" placeholder="البريد الإلكتروني " value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                </div>
              </div>
              <!-- <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="field">التخصص</label>
                  <input id="field" name="field" class="form-control" type="text" placeholder="التخصص" required="" aria-required="true">
                </div>
                </div> -->
              <!-- <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="job">العمل</label>
                  <input id="job" name="job" class="form-control" type="text" placeholder="العمل" required="" aria-required="true">
                </div>
                </div> -->
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputExperience1">سنوات الخبرة</label>
                  <input id="InputExperience1" class="form-control" type="text" placeholder="سنوات الخبرة" name="experience">
                  <input id="upload-file" class="custom-upload" type="file" name="exp_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputCertificates1">سشهادات</label>
                  <input id="InputCertificates1" class="form-control" type="text" placeholder="سشهادات" name="experience">
                  <input id="upload-file" class="custom-upload" type="file" name="cert_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputEducation1">سالتعليم </label>
                  <input id="InputEducation1" class="form-control" type="text" placeholder="سالتعليم " name="experience">
                  <input id="upload-file" class="custom-upload" type="file" name="edu_attc[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="InputLicense1">سنوات الخبرة</label>
                  <input id="InputLicense1" class="form-control" type="text" placeholder="سنوات الخبرة" name="experience">
                  <input id="upload-file" class="custom-upload" type="file" name="lic_attch[]" accept=".jpg,.png,.pdf,.jpeg,.gif,.bmp" multiple />
                </div>
              </div>
              <!-- <div class="col-sm-12 p-0">
                <div class="form-group mb-0">
                  <label for="job_end">السيرة الذاتية</label>
                      <div class="file-input-wrapper">
                        <label for="upload-file" class="file-input-button">أستعراض</label>
                        <input id="upload-file" type="file" name="file1" />
                      </div>
                </div>
                </div>
                <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="job_end">الشهادة </label>
                      <div class="file-input-wrapper">
                        <label for="upload-file2" class="file-input-button">أستعراض</label>
                        <input id="upload-file2" type="file" name="file2" />
                      </div>
                </div>
                </div> -->
              <!-- <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="more_details">معلومات اضافية</label>
                  <div class="editor" id="editor-2">
                    <div class="toolbar">
                      <a href="#" data-command='undo' data-toggle="tooltip" data-placement="top" title="Undo"><i class='fa fa-undo'></i></a>
                      <a href="#" data-command='redo' data-toggle="tooltip" data-placement="top" title="Redo"><i class='fa fa-undo icon-flipped '></i></a>
                              <a href="#" data-command='removeFormat' data-toggle="tooltip" data-placement="top" title="Clear format"><i class='fa fa-times '></i></a>
                      <div class="fore-wrapper"><i class='fa fa-font' data-toggle="tooltip" data-placement="top" title="text color" style='color:#C96;'></i>
                        <div class="fore-palette">
                        </div>
                      </div>
                      <div class="back-wrapper"><i class='fa fa-font'  data-toggle="tooltip" data-placement="top" title="Background color" style='background:#C96;'></i>
                        <div class="back-palette">
                        </div>
                      </div>
                      <a href="#" data-command='bold' data-toggle="tooltip" data-placement="top" title="Bold"><i class='fa fa-bold'></i></a>
                      <a href="#" data-command='italic' data-toggle="tooltip" data-placement="top" title="Italic"><i class='fa fa-italic'></i></a>
                      <a href="#" data-command='underline' data-toggle="tooltip" data-placement="top" title="Underline"><i class='fa fa-underline'></i></a>
                      <a href="#" data-command='strikeThrough' data-toggle="tooltip" data-placement="top" title="Stike through"><i class='fa fa-strikethrough'></i></a>
                      <a href="#" data-command='justifyLeft' data-toggle="tooltip" data-placement="top" title="Left align"><i class='fa fa-align-left'></i></a>
                      <a href="#" data-command='justifyCenter'><i class='fa fa-align-center' data-toggle="tooltip" data-placement="top" title="Center align"></i></a>
                      <a href="#" data-command='justifyRight' data-toggle="tooltip" data-placement="top" title="Right align"><i class='fa fa-align-right'></i></a>
                      <a href="#" data-command='justifyFull' data-toggle="tooltip" data-placement="top" title="Justify"><i class='fa fa-align-justify'></i></a>
                      <a href="#" data-command='indent' data-toggle="tooltip" data-placement="top" title="Indent"><i class='fa fa-indent'></i></a>
                      <a href="#" data-command='outdent'  data-toggle="tooltip" data-placement="top" title="Outdent"><i class='fa fa-outdent'></i></a>
                      <a href="#" data-command='insertUnorderedList'  data-toggle="tooltip" data-placement="top" title="Unordered list"><i class='fa fa-list-ul'></i></a>
                      <a href="#" data-command='insertOrderedList' data-toggle="tooltip" data-placement="top" title="Ordered list"><i class='fa fa-list-ol'></i></a>
                      <a href="#" data-command='h1' data-toggle="tooltip" data-placement="top" title="H1">H1</a>
                      <a href="#" data-command='h2'  data-toggle="tooltip" data-placement="top" title="H2">H2</a>
                      <a href="#" data-command='createlink' data-toggle="tooltip" data-placement="top" title="Inser link"><i class='fa fa-link'></i></a>
                      <a href="#" data-command='unlink' data-toggle="tooltip" data-placement="top" title="Unlink"><i class='fa fa-unlink'></i></a>
                      <a href="#" data-command='insertimage' data-toggle="tooltip" data-placement="top" title="Insert image"><i class='fa fa-image'></i></a>
                      <a href="#" data-command='p' data-toggle="tooltip" data-placement="top" title="Paragraph">P</a>
                      <a href="#" data-command='subscript' data-toggle="tooltip" data-placement="top" title="Subscript"><i class='fa fa-subscript'></i></a>
                      <a href="#" data-command='superscript'  data-toggle="tooltip" data-placement="top" title="Superscript"><i class='fa fa-superscript'></i></a>
                    </div>
                    <div id='editor' class="editorAria" contenteditable>
                  </div>
                </div>
                </div>
                </div> -->
              <div class="col-sm-12 p-0">
                <div class="form-group mb-30">
                  <label for="about">اعن دورتك  </label>
                  <textarea id="about" name="about" class="form-control" type="text" placeholder="اعن دورتك " required>
                  {{ Auth::check() ? Auth::user()->about : '' }}
                  </textarea>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer text-center mb-30">
        <button type="submit" class="btn btn-dark btn-flat btn-theme-green">تسجيل إنضمام</button>
      </div>
      </form>
    </div>
  </div>
</div>
@stop