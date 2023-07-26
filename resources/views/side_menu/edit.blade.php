@extends('layout.main')
@section('head-css-script')
    <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                        <form id="side_menu_update_form" method="POST"
                            action="{{ route('side.menu.update', ['id' => $side_menu->id]) }}"
                            enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">

                                        <div class="form-group">
                                            <label for="title">Select Side Menu Option</label>
                                            <div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="category_option" name="category_type"
                                                        value="0" @if ($side_menu->category_type == 0) checked @endif>
                                                    <label for="category_option">
                                                        Category
                                                    </label>
                                                </div>

                                                <div class="icheck-primary d-inline ml-3">
                                                    <input type="radio" name="category_type" id="item_option"
                                                        value="1" @if ($side_menu->category_type == 1) checked @endif>
                                                    <label for="item_option">
                                                        Item
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div id="append_select_fields">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                @if ($side_menu->category_id != 0 && $side_menu->item_id == 0)
                                                    <input type="hidden" name="item_id" value="0">
                                                    <label for="category_id">Category</label>
                                                    <select class="form-control select2bs4 custom_select_field"
                                                        name="category_id" id="category_id">
                                                        <option value="">Please Select Category</option>
                                                        @foreach ($category as $cg)
                                                            <option @if ($side_menu->category_id == $cg->id) selected @endif
                                                                value="{{ $cg->id }}">{{ $cg->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="hidden" name="category_id" value="0">
                                                    <label for="item_id">Item</label>
                                                    <select class="form-control select2bs4 custom_select_field"
                                                        name="item_id" id="item_id">
                                                        <option value="" selected>Please Select Item</option>
                                                        @foreach ($item as $im)
                                                            <option @if ($side_menu->item_id == $im->id) selected @endif
                                                                value="{{ $im->id }}"> {{ $im->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="append_name_and_img_fields">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sidemenu_name">Name</label>
                                                <input type="text" name="sidemenu_name" class="form-control" required id="sidemenu_name" placeholder="Enter Side Menu Name" value="{{ $side_menu->sidemenu_name }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div style="display:grid;">
                                                    <label for="sidemenu_images">Image</label>
                                                    <small style="color: red; margin-top: -0.8rem; margin-bottom: 0.7rem;">If Image is not selected than the selected {{ $side_menu->category_id != 0 && $side_menu->item_id == 0 ? 'Category' : 'Item'  }}  Image will be taken</small>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="sidemenu_images" id="sidemenu_images">
                                                    <label class="custom-file-label" for="sidemenu_images"> Choose Image </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">

                                        <div class="form-group">
                                            <label for="title">Status</label>

                                            <div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="active" name="is_active" value="1"
                                                        checked>
                                                    <label for="active">
                                                        Active
                                                    </label>
                                                </div>

                                                <div class="icheck-danger d-inline ml-3">
                                                    <input type="radio" name="is_active" id="inactive" value="0">
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

                                @if ($side_menu->sidemenu_images)
                                <div class="row">
                                    <div style="display: grid;">
                                        <img width="200px" height="200px" src="{{ env('IMAGES_PATH') . 'sidemenu_images/' . $side_menu->sidemenu_images }}">
                                        <span>{{ $side_menu->sidemenu_images }}</span>
                                    </div>
                                </div>
                            @endif

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
    <script>
        $(document).on('change', '.custom_select_field', function() {
            $('#append_name_and_img_fields').html('');
            var selectedText = $(this).find('option:selected').text().trim();

            var item_category = $('input[type="radio"][name="category_type"]:checked').val() == 0 ? 'Category' :
                'Item';

            var html =
                `<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sidemenu_name">Name</label>
                                    <input type="text" name="sidemenu_name" class="form-control" required id="sidemenu_name" placeholder="Enter Side Menu Name" value="` + selectedText + `">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div style="display:grid;">
                                        <label for="sidemenu_images">Image</label>
                                        <small style="color: red; margin-top: -0.8rem; margin-bottom: 0.7rem;">If Image is not selected than the selected ` +
                item_category + ` Image will be taken</small>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="sidemenu_images" id="sidemenu_images">
                                        <label class="custom-file-label" for="sidemenu_images"> Choose Image </label>
                                    </div>
                                </div>
                            </div>
                        </div>`;

            $('#append_name_and_img_fields').html(html)
        });

        $(function() {
            bsCustomFileInput.init();

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });


            $('input[type="radio"][name="category_type"]').on('change', function() {
                var selectedValue = $('input[type="radio"][name="category_type"]:checked').val();

                $('#append_select_fields').html('');
                $('#append_name_and_img_fields').html('');

                var html = `<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">`;
                if (selectedValue == 0) {
                    html += `<input type="hidden" name="item_id" value="0">
                    <label for="category_id">Category</label>
                    <select class="form-control select2bs4 custom_select_field" name="category_id" id="category_id">
                        <option value="" selected>Please Select Category</option>
                        @foreach ($category as $cg)
                            <option value="{{ $cg->id }}">{{ $cg->title }} </option>
                        @endforeach
                    </select>`;
                } else {
                    html += `<input type="hidden" name="category_id" value="0">
                    <label for="item_id">Item</label>
                    <select class="form-control select2bs4 custom_select_field" name="item_id" id="item_id">
                        <option value="" selected>Please Select Item</option>
                        @foreach ($item as $im)
                            <option value="{{ $im->id }}"> {{ $im->title }} </option>
                        @endforeach
                    </select>`;
                }
                html += `</div>
                        </div>
                    </div>`;

                $('#append_select_fields').html(html);


                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });
            });

            $('#side_menu_update_form').validate({
                rules: {
                    "category_type": "required",
                    "is_active": "required",
                    "category_id": "required",
                    "item_id": "required",
                    "sidemenu_name": "required",
                },
                messages: {
                    "category_type": "Please Select Side Menu",
                    "is_active": "Please Select Status",
                    "category_id": "Please Select Category",
                    "item_id": "Please Select Item",
                    "sidemenu_name": "Please Enter Side Menu Name",
                },
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
    </script>
@endsection
