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
                        <form id="sub_category_edit_form" method="POST" action="{{ route('sub.category.update', ['id' => $sub_category->id]) }}"
                            enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid @enderror" required
                                                id="title" placeholder="Enter Title" value="{{ old('title') ?? $sub_category->title }}">
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
                                            <label for="category_id">Category</label>

                                            <select class="form-control select2bs4" name="category_id" style="width: 100%;">
                                                <option value="">Please Select Category</option>
                                                @foreach ($category as $cg)
                                                    <option  value="{{ $cg->id }}" @if ($sub_category->category_id == $cg->id) selected @endif >{{ $cg->title }}</option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
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
                                                    class="custom-file-input @error('sub_category_image') is-invalid @enderror "
                                                    name="sub_category_image" id="sub_category_image">
                                                <label class="custom-file-label" for="sub_category_image">Choose Image</label>
                                            </div>
                                            @error('sub_category_image')
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

                                @if($sub_category->image)
                                    <div class="row">
                                        <div style="display: grid;">
                                            <img width="200px" height="200px" src="{{ '../../images/sub_category_images/' . $sub_category->image }}">
                                            <span>{{ $sub_category->image }}</span>
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
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $(function() {
            $('#sub_category_edit_form').validate({
                rules: {
                    title: {
                        required: true
                    },
                    category_id: {
                        required: true
                    },
                    // sub_category_image: {
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
                    category_id: {
                        required: "Please Select Category"
                    },
                    // sub_category_image: {
                    //     required: "Please Select Sub Category Image"
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
