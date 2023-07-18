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
                        <form id="sub_category_create_form" method="POST" action="{{ route('sub.category.store') }}"
                            enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">

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
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="category_image">Image</label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('category_image') is-invalid @enderror "
                                                    name="category_image" id="category_image">
                                                <label class="custom-file-label" for="category_image">Choose Image</label>
                                            </div>
                                            @error('category_image')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <label for="category_id">Category</label>
                                                <div class="float-right">
                                                    <button type="button" id="add_new_category"
                                                        class="btn btn-success btn-block"><i class="fa fa-plus"></i>
                                                        Add</button>
                                                </div>
                                            </div>
                                            <div class="card-body add_category">
                                                <div class="row">
                                                    <select class="form-control select2bs4" name="category_id[]"
                                                        id="category_id">
                                                        <option value="" selected>Please Select Category</option>
                                                        @foreach ($category as $cg)
                                                            <option value="{{ $cg->id }}">{{ $cg->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
    <script>
        $(function() {
            bsCustomFileInput.init();

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $('#add_new_category').click(function() {
                var html = `<div class="row mt-3">
                    <div class="col-md-10">
                        <select class="form-control select2bs4" name="category_id[]"
                            id="category_id">
                            <option value="" selected>Please Select Main Category</option>
                            @foreach ($category as $cg)
                                <option value="{{ $cg->id }}">{{ $cg->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-block remove_category">
                            <i class="fa fa-times"></i> Remove
                        </button>
                    </div>
                </div>`;

                $('.add_category').append(html)

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                });
            });

            $('#sub_category_create_form').validate({
                rules: {
                    "title": "required",
                    // "category_image": "required",
                    "category_id[]": "required",
                    "status": "required"
                },
                messages: {
                    "title": "Please Enter Title",
                    // "category_image": "Please Select Category Image",
                    "category_id[]": "Please Select Main Category",
                    "status": "Please Select Status"
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

        $(document).on('click', '.remove_category', function(event) {
            $(this).closest('.row').remove();

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@endsection
