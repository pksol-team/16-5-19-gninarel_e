@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if($edit)
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp

                            @foreach($dataTypeRows as $row)
                                <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $display_options = $row->details->display ?? NULL;
                                    if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                        $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                    }
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                @endif
                                <?php if ($row->field == 'answers'): ?>
                                    <?php $answers = json_decode( $dataTypeContent->answers); 
                                    ?>
                                    <?php if ($answers): ?>
                                        <?php foreach ($answers as $key => $answer): ?>
                                            <div class="form-group all_answers">
                                                <label for="name">Option</label>
                                                <input required type="text" class="form-control" name="answers_break" placeholder="Answers" value="{{ $answer->option }}">

                                                <input type="checkbox" class="check" name="check" value="{{ $key+1 }}" {{ $dataTypeContent->correct_answer == $key+1 ? 'checked' : NULL }} /> Correct Answer
                                                <?php if ($key == 0): ?>
                                                    <button type="button" style="float: right;margin-top: 12px;" type="button" class="add btn btn-success">Add</button>
                                                <?php else: ?>
                                                    <button type="button" style="float: right;margin-top: 12px;" class="btn btn-danger remove">Remove</button>
                                                <?php endif ?>
                                            </div>
                                        <?php endforeach ?>

                                    <?php else: ?>
                                        <div class="form-group all_answers">
                                            <label for="name">Option</label>
                                            <input required type="text" class="form-control" name="answers_break" placeholder="Answers" value="">
                                            <input type="checkbox" class="check" name="check" value="1" checked />Correct Answer
                                            <button style="float: right;margin-top: 12px;" type="button" class="add btn btn-success">Add</button>
                                        </div>
                                    <?php endif ?>
                                <?php elseif($row->field == 'correct_answer'): ?>
                                <?php else: ?>
                                    <div class="form-group @if($row->type == 'relationship' && $row->display_name == 'User') hidden @endif @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                        {{ $row->slugify }}
                                        <label class="control-label" for="name">{{ $row->display_name }}</label>
                                        @include('voyager::multilingual.input-hidden-bread-edit-add')
                                        @if (isset($row->details->view))
                                            @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add')])
                                        @elseif ($row->type == 'relationship')
                                            <?php if ($row->display_name == 'User'): ?>
                                                <input type="hidden" name="user_id" value="{{ $dataTypeContent->{$row->field} ?? old($row->field) ?? $options->default ?? Auth::user()->id }}" />
                                            <?php else: ?>
                                                @include('voyager::formfields.relationship', ['options' => $row->details])
                                            <?php endif ?>
                                        @else
                                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                        @endif

                                        @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                            {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                        @endforeach
                                        @if ($errors->has($row->field))
                                            @foreach ($errors->get($row->field) as $error)
                                                <span class="help-block">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>

                                <?php endif ?>
                            @endforeach
                <input type="hidden" class="hiddenAnswers" name="answers" value="{{ $dataTypeContent->answers }}" />
                <input type="hidden" class="hiddencorrect" name="correct_answer" value="{{ $dataTypeContent->correct_answer }}" />

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();

            

            $(document).on('click', '.check', function() {
                $('.check').not(this).prop('checked', false);
            });

    

            $('.add').on('click',  function(e) {
                e.preventDefault();
                var $this = $(this),
                     countLength = parseInt($('.all_answers:last input.check').val()) + 1,
                     rowAdd = `
                    <div class="form-group all_answers">
                        <label for="name">Option</label>
                        <input required type="text" class="form-control" name="answers_break" placeholder="Answers">
                        <button type="button" style="float: right;margin-top: 12px;" class="btn btn-danger remove">Remove</button>
                        <input type="checkbox" class="check" name="check" value="`+countLength+`" /> Correct Answer
                    </div>
                `;

                $(rowAdd).insertAfter($(".all_answers:last"));
            });

          $(document).on('click', '.remove', function(e){                
                e.preventDefault();
                $(this).parent('.all_answers').remove();                        

          }); 

          $('.panel-footer button[type=submit]').on('click',  function(e) {
              e.preventDefault();
                var $this = $(this);

            if ($('input.check').is(":checked") != true) {
                alert('Please check the correct answer');

            } else {

                  var answers = $('input[name=answers_break]'),
                    value = `[`;

                 $.each(answers, function(index, val) {
                    var option = $(val).val();
                    value += `{"id":"`+(parseInt(index)+1)+`","option":"`+ option +`"},`;
                 });

                 var newValue = value.slice(0, -1);
                 newValue += `]`;


                $('.hiddenAnswers').val(newValue);
                $('.hiddencorrect').val($('input.check:checked').val());
                $('.form-edit-add').submit();

            }

             
          });


        });

    </script>
@stop
