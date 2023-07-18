@extends('layout.main')
@section('head-css-script')
    <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
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
                        <form id="main_category_edit_form" method="POST"
                            action="{{ route('main.category.update', ['id' => $main_category->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid @enderror" required
                                                id="title" placeholder="Enter Title"
                                                value="{{ old('title') ?? $main_category->title }}">
                                            @error('title')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prompt_date">Image</label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('main_category_image') is-invalid @enderror " name="main_category_image"
                                                    id="main_category_image">
                                                <label class="custom-file-label" for="main_category_image">Choose file</label>
                                            </div>
                                            @error('main_category_image')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
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
                                                        @if ($main_category->status == 1) checked @endif>
                                                    <label for="active">
                                                        Active
                                                    </label>
                                                </div>

                                                <div class="icheck-danger d-inline">
                                                    <input type="radio" name="status" id="inactive" value="0"
                                                        @if ($main_category->status == 0) checked @endif>
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

                                @if ($main_category->image)
                                    <div class="row">
                                        <div style="display: grid;">
                                            <img width="200px" height="200px" src="{{ '../../images/main_category_images/' . $main_category->image }}">
                                            <span>{{ $main_category->image }}</span>
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
    <script>
        $(function() {
            $('#main_category_edit_form').validate({
                rules: {
                    title: {
                        required: true
                    },
                    // main_category_image: {
                    //     required: true
                    // },
                    status: {
                        required: true
                    }
                },
                messages: {
                    title: {
                        required: "Please Enter Title",
                    },
                    // main_category_image: {
                    //     required: "Please Select Main Category Image"
                    // },
                    status: {
                        required: "Please Select Status"
                    }
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

        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
