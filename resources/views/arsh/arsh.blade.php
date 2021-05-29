@extends('front.template')
@section('content')
<div class="container-fluid content-header p-1 mt-4 ">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                 <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="card card-primary card-outline shadow-5-strong">
                        <div class="card-body box-profile">
                            <div class="form-group">
                                <label>Language</label>
                                <select id="select_language" name="b" class="select2bs4" style="width: 100%;">
                                    <option value="0">--- Select ---</option>
                                    @foreach($allLanguages as $language)
                                    <option value="{{ $language->id }} ">{{ $language->language_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Granth</label>
                                <select id="select_granth" name="b" class="select2bs4" style="width: 100%;">
                                    <option value="0">--- Select ---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chapter</label>
                                <select id="select_chapter" name="b" class="select2bs4" style="width: 100%;">
                                    <option value="0">--- Select ---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9" id="arsh_details">
                    <div class="card card-warning card-outline shadow-5-strong">                              
                        <div class="card-header mb-0">
                             <h1 class=" box-title fw-bolder  text-center shadow-5-strong p-3  
                             pt-3 mt-0  border border-warning  bg-danger rounded-top ">आर्ष ग्रंथ</h1>
                             <hr>
                            <h3 class="box-title"> chapter name </h3>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane">
                                    <div class="post">
                                        <div class="">
                                            <h3 class="username">
                                                <a href="javascript:void(0);">shlok title</a>
                                            </h3>
                                            <span class="description">Posted On -
                                            </span>
                                        </div>
                                        <hr />
                                        <p>
                                            description
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class=" container container-fluid p-5 mt-5">
    <div>
        <div>

        </div>
    </div>
    
</div>
<div class=" container container-fluid p-5 mt-5">
    
</div>
<div class=" container container-fluid p-4">
    
</div>
<script>
    $(document).ready(function () {
        var default_option = '<option value="0">--- Select ---</option>';
        var loading_option = '<option value="0">Loading...</option>';
        $('#select_language').change(function () {
            var language_id = $(this).val();
            if (language_id != 0) {
                $.ajax({
                    url: '{{ url("/aarshgranth/granths")}}/' + language_id,
                    dataType: 'json',
                    beforeSend: function () {
                        $('#select_granth').html(loading_option);
                    },
                    success: function (resp) {

                            var _options = default_option;
                            $.each(resp.granths, function (key, value) {
                                _options += '<option value="' + value.id + '">' + value.arshbook_title + '</option>';
                            });
                            $('#select_granth').html(_options);
                            $('#select_granth').select2({
                                theme: 'bootstrap4'
                            });

                    }
                });
            } else {
                $('#select_chapter').html(default_option);
                $('#select_granth').html(default_option);
            }
        });

        $('#select_granth').change(function () {
            var granths_id = $(this).val();
            if (granths_id != 0) {
                $.ajax({
                    url: '{{ url("/aarshgranth/chapters")}}/' + granths_id,
                    dataType: 'json',
                    beforeSend: function () {
                        $('#select_chapter').html(loading_option);
                    },
                    success: function (resp) {

                            var _options = default_option;
                            $.each(resp.chapters, function (key, value) {
                                _options += '<option value="' + value.id + '">' + value.arshchapter_no + '</option>';
                            });
                            $('#select_chapter').html(_options);
                            $('#select_chapter').select2({
                                theme: 'bootstrap4'
                            });

                    }
                });
            } else {
                $('#select_chapter').html(default_option);
            }
        });

        $('#select_chapter').change(function () {
            var chapter_id = $(this).val();
            if (chapter_id != 0) {
                $.ajax({
                    url: '{{ url("/aarshgranth/chapter")}}/' + chapter_id,
                    dataType: 'html',
                    beforeSend: function () {
                        $('#arsh_details').html("Loading...");
                    },
                    success: function (resp) {                        
                        $('#arsh_details').html(resp);
                    }
                });
            }
        });
    });
</script>

@endsection
