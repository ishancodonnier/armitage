@extends('layout.main')
@section('head-css-script')
    <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/toastr/toastr.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #image_title_1-error {
            margin-left: 20px;
        }

        @media only screen and (max-width: 767px) {

            .category_row,
            .image_row,
            .new_category_button_row {
                gap: 10px;
            }
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @include('flash')
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $pagetitle }}</h3>
                        </div>
                        <form id="item_create_form" method="POST" action="{{ route('item.store') }}"
                            enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid @enderror" required
                                                id="title" placeholder="Enter Title" value="{{ old('title') }}">
                                            @error('title')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website">Website</label>
                                            <input type="url" name="website"
                                                class="form-control @error('website') is-invalid @enderror" id="website"
                                                placeholder="Enter Website" value="{{ old('website') }}">
                                            @error('website')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <label for="main_category_id">Category</label>
                                                <div class="float-right">
                                                    <div class="row flex-nowrap" style="gap: 10px;">
                                                        <div class="col-6">
                                                            <button type="button" id="add_new_category"
                                                                class="btn btn-info btn-block"><i class="fa fa-plus"></i>
                                                                New</button>
                                                        </div>
                                                        <div class="col-6">
                                                            <button type="button" id="add_new_category_row"
                                                                class="btn btn-success btn-block"><i class="fa fa-plus"></i>
                                                                Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body category_container">
                                                <div class="row category_row">
                                                    <div class="col-md-4">
                                                        <select class="form-control select2bs4 category_id"
                                                            name="category_id[1]" style="width: 100%;">
                                                            <option value="" selected="selected">Please Select
                                                                Category
                                                            </option>
                                                            @foreach ($category as $cg)
                                                                <option value="{{ $cg->id }}">{{ $cg->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <span class="error invalid-feedback"
                                                                style="display: block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 add_sub_category_on_change">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row new_category_button_row">
                                                            <div class="col-md-8 add_new_sub_category_button">
                                                                <button type="button"
                                                                    class="btn btn-success btn-block change_select_add_new_sub_category">
                                                                    <i class="fa fa-plus"></i> Add New Sub Category
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <label for="images">Images</label>
                                                <div class="float-right">
                                                    <div class="row flex-nowrap" style="gap: 10px;">
                                                        <div class="col-12">
                                                            <button type="button" id="add_new_image"
                                                                class="btn btn-success btn-block"><i class="fa fa-plus"></i>
                                                                Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="image_container">

                                                    <div class="row image_row">
                                                        <div class="col-md-5">
                                                            <div class="custom-file">
                                                                <input type="file" accept="image/*"
                                                                    class="custom-file-input" name="item_image[]"
                                                                    id="item_image_1">
                                                                <label class="custom-file-label" for="item_image_1">Choose
                                                                    Image</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" name="image_title[]"
                                                                class="form-control" id="image_title_1"
                                                                placeholder="Enter Image Title">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <label for="description">Description</label>
                                            </div>
                                            <div class="card-body">
                                                <textarea id="description" required name="description" placeholder="Enter Description here"></textarea>
                                                @error('title')
                                                    <span class="error invalid-feedback"
                                                        style="display: block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Status</label>
                                            <div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="active" name="status" value="1"
                                                        checked>
                                                    <label for="active">
                                                        Active
                                                    </label>
                                                </div>
                                                <div class="icheck-danger d-inline">
                                                    <input type="radio" name="status" id="inactive" value="0">
                                                    <label for="inactive">
                                                        Inactive
                                                    </label>
                                                </div>
                                            </div>
                                            @error('status')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer-script')
    <script src="{{ asset('asset/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        const rowNumbers = [1];
        const base_url = "{{ url('/') }}";

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $('#description').summernote({
            height: 200,
        });

        $(document).on("change", ".category_id", function() {
            var category_id = $(this).val();
            var row = $(this).closest('.category_row');
            var row_index = rowNumbers[row.index()];

            $.ajax({
                url: base_url + "/item/show-sub-category/" + category_id,
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                },
                cache: false,
                contentType: false,
                processData: false,
                async: true,
                error: function() {},
                success: function(response) {
                    if (response.status) {
                        var html =
                            `<select class="form-control select2bs4 sub_category_id" name="sub_category_id[` +
                            row_index + `]" style="width: 100%;">
                                        <option value="" selected="selected">Please Select Sub Category</option>`;
                        $.each(response.data, function(key, value) {
                            html += `<option value="` + value.id + `">` + value.title +
                                `</option>`;
                        });
                        html += `</select>`;

                        row.find('.add_sub_category_on_change').html(html);

                        $('.select2bs4').select2({
                            theme: 'bootstrap4'
                        })
                    } else {
                        toastr.options.progressBar = true;
                        toastr.error(response.msg);
                    }
                },
                error: function(err) {
                    toastr.options.progressBar = true;
                    toastr.error(err.responseJSON.message);
                },
            });
        });

        $('#add_new_category_row').on('click', function() {
            var rowCount = $('.category_container .category_row').length + 1;
            if (inArray(rowCount, rowNumbers)) {
                rowCount = rowCount + 1;
            }
            rowNumbers.push(rowCount);
            var html = `<div class="row category_row mt-3">
                            <div class="col-md-4">
                                <select class="form-control select2bs4 category_id"
                                    name="category_id[` + rowCount + `]" style="width: 100%;">
                                    <option value="" selected="selected">Please Select
                                        Category
                                    </option>
                                    @foreach ($category as $cg)
                                        <option value="{{ $cg->id }}">{{ $cg->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="error invalid-feedback"
                                        style="display: block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 add_sub_category_on_change">
                            </div>
                            <div class="col-md-4">
                                <div class="row new_category_button_row">
                                    <div class="col-md-8 add_new_sub_category_button">
                                        <button type="button" class="btn btn-success btn-block change_select_add_new_sub_category">
                                            <i class="fa fa-plus"></i> Add New Sub Category
                                        </button>
                                    </div>

                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-danger btn-block remove_category">
                                            <i class="fa fa-times"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>`;

            $('.category_container').append(html)

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        $(document).on('click', '.remove_category', function(event) {
            var row = $(this).closest('.category_row');
            var row_index = row.index();
            rowNumbers.splice(row_index, 1);
            $(this).closest('.category_row').remove();
        });

        $('#add_new_category').on('click', function() {

            var rowCount = $('.category_container .category_row').length + 1;
            if (inArray(rowCount, rowNumbers)) {
                rowCount = rowCount + 1;
            }
            rowNumbers.push(rowCount);

            var html = `<div class="row category_row mt-3">
                            <div class="col-md-4">
                                <input type="text" name="new_category[` + rowCount + `]" class="form-control" required
                                    id="new_category" placeholder="Enter New Category" value="{{ old('new_category') }}">
                            </div>

                            <div class="col-md-4 add_sub_category_text">

                            </div>

                            <div class="col-md-4">
                                <div class="row new_category_button_row">
                                    <div class="col-8 add_new_sub_category_button">
                                        <button type="button" class="btn btn-success btn-block add_new_sub_category">
                                            <i class="fa fa-plus"></i> Add Sub Category
                                        </button>
                                    </div>

                                    <div class="col-4">
                                        <button type="button" class="btn btn-danger btn-block remove_category">
                                            <i class="fa fa-times"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>`;

            $('.category_container').append(html)
        });

        $(document).on('click', '.add_new_sub_category', function() {
            var row = $(this).closest('.category_row');
            var row_index = rowNumbers[row.index()];
            var text = row.find('.add_sub_category_text')
            var button = row.find('.add_new_sub_category_button');

            var html = `<input type="text" name="new_sub_category[` + row_index + `]" class="form-control" required
            id="new_sub_category" placeholder="Enter New Sub Category" value="{{ old('new_sub_category') }}">`;

            var html_button = `<button type="button" class="btn btn-danger btn-block remove_new_sub_category_text">
                                    <i class="fa fa-times"></i> Remove Sub Category
                                </button>`;

            button.html(html_button);
            text.append(html);
        });

        $(document).on('click', '.change_select_add_new_sub_category', function() {
            var row = $(this).closest('.category_row');
            var row_index = rowNumbers[row.index()];
            var text = row.find('.add_sub_category_on_change')
            var button = row.find('.add_new_sub_category_button');

            var html = `<input type="text" name="new_sub_category[` + row_index + `]" class="form-control" required
            id="new_sub_category" placeholder="Enter New Sub Category" value="{{ old('new_sub_category') }}">`;

            var html_button = `<button type="button" class="btn btn-danger btn-block remove_change_new_sub_category_text">
                                    <i class="fa fa-times"></i> Remove Sub Category
                                </button>`;

            button.html(html_button);
            text.html(html);
        });

        $(document).on('click', '.remove_new_sub_category_text', function() {
            var row = $(this).closest('.category_row');
            var text = row.find('.add_sub_category_text')
            var button = row.find('.add_new_sub_category_button');
            var html_button = `<button type="button" class="btn btn-success btn-block add_new_sub_category">
                                    <i class="fa fa-plus"></i> Add Sub Category
                                </button>`;

            button.html(html_button);
            text.html('');
        });

        $(document).on('click', '.remove_change_new_sub_category_text', function() {
            var row = $(this).closest('.category_row');
            var text = row.find('.add_sub_category_on_change')
            var button = row.find('.add_new_sub_category_button');
            var html_button = `<button type="button" class="btn btn-success btn-block change_select_add_new_sub_category">
                                    <i class="fa fa-plus"></i> Add Sub Category
                                </button>`;

            button.html(html_button);
            text.html('');
        });

        $('#add_new_image').on('click', function() {
            var rowCount = $('.image_container .image_row').length + 1;

            var html = `<div class="row image_row mt-3">
                            <div class="col-md-5">
                                <div class="custom-file">
                                    <input type="file" accept="image/*" class="custom-file-input" name="item_image[]"
                                        id="item_image_` + rowCount + `">
                                    <label class="custom-file-label" for="item_image_` + rowCount + `">Choose
                                        Image</label>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <input type="text" name="image_title[]" class="form-control"
                                    id="image_title_` + rowCount + `" placeholder="Enter Image Title">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-block remove_image">
                                    <i class="fa fa-times"></i> Remove
                                </button>
                            </div>
                        </div>`;

            $('.image_container').append(html);

            bsCustomFileInput.init();
        });

        $(document).on('click', '.remove_image', function(event) {
            $(this).closest('.image_row').remove();
        });

        $(function() {
            var rowCount = $('.category_container .category_row').length + 1;
            var validationRules = {
                "title": "required",
                "description": "required",
                "item_image[]": "required",
                "status": "required"
            };

            var validation_messages = {
                "title": "Please Enter Title",
                "description": "Please Enter Description",
                "item_image[]": "Please Select Item Image",
                "status": "Please Select Status"
            };

            for (var i = 1; i <= rowCount; i++) {
                validationRules["category_id[" + i + "]"] = "required";
                validationRules["new_category[" + i + "]"] = "required";
                validation_messages["category_id[" + i + "]"] = 'Please Select Category'
                validationRules["new_category[" + i + "]"] = "Please Enter Category";
            }

            $('#item_create_form').validate({
                rules: validationRules,
                messages: validation_messages,
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

        });

        $(function() {
            bsCustomFileInput.init();
        });

        function inArray(needle, haystack) {
            var length = haystack.length;
            for (var i = 0; i < length; i++) {
                if (haystack[i] == needle) return true;
            }
            return false;
        }
    </script>
@endsection
