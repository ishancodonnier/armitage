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
        #garden_image_title_1-error {
            margin-left: 20px;
        }

        @media only screen and (max-width: 767px) {
            .image_row{
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
                        <form id="item_edit_form" method="POST"
                            action="{{ route('garden.center.update', ['id' => $garden_center->garden_center_id]) }}"
                            enctype="multipart/form-data">@csrf


                            <div class="card-body">


                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="garden_name">Garden Name</label>
                                            <input type="text" name="garden_name"
                                                class="form-control @error('garden_name') is-invalid @enderror" required
                                                id="garden_name" placeholder="Enter Garden Name"
                                                value="{{ old('garden_name') ?? $garden_center->garden_name }}">
                                            @error('garden_name')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="webside">Website</label>
                                            <input type="url" name="webside"
                                                class="form-control @error('webside') is-invalid @enderror" id="webside"
                                                placeholder="Enter Website" value="{{ old('webside') ?? $garden_center->webside }}">
                                            @error('webside')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                placeholder="Enter Email" value="{{ old('email') ?? $garden_center->email }}">
                                            @error('email')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile_number">Phone/Mobile Number</label>
                                            <input type="text" name="mobile_number"
                                                class="form-control @error('mobile_number') is-invalid @enderror"
                                                id="mobile_number" placeholder="Enter Phone/Mobile Number"
                                                value="{{ old('mobile_number') ?? $garden_center->mobile_number }}">
                                            @error('mobile_number')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="latitude">Latitude</label>
                                            <input type="text" name="latitude"
                                                class="form-control @error('latitude') is-invalid @enderror" id="latitude"
                                                placeholder="Enter Latitude" value="{{ old('latitude') ?? $garden_center->latitude }}">
                                            @error('latitude')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="longitude">Longitude</label>
                                            <input type="text" name="longitude"
                                                class="form-control @error('longitude') is-invalid @enderror" id="longitude"
                                                placeholder="Enter Longitude" value="{{ old('longitude') ?? $garden_center->longitude }}">
                                            @error('longitude')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" style="height: 100px;" name="address" id="address" placeholder="Enter Address">{{ old('address') ?? $garden_center->address }}</textarea>
                                            @error('address')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">City</label>
                                            <input type="text" name="city" id="city" class="form-control"
                                                placeholder="Enter City" value="{{ old('city') ?? $garden_center->city }}">
                                            @error('address')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select class="form-control select2bs4" name="state" id="state">
                                                <option value="">Please Select State</option>
                                                @foreach ($states as $st)
                                                    <option value="{{ $st->id }}" @if($garden_center->state == $st->id) selected @endif >
                                                        @if ($st->country_id == 0)
                                                            {{ $st->name }}
                                                        @else
                                                            {{ $st->iso2 . ' - ' . $st->name }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('state')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="zipcode">Zipcode</label>
                                            <input type="text" name="zipcode"
                                                class="form-control @error('zipcode') is-invalid @enderror" id="zipcode"
                                                placeholder="Enter Zipcode" value="{{ old('zipcode') ?? $garden_center->zipcode }}">
                                            @error('zipcode')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="region">Region</label>
                                            <select class="form-control select2bs4" name="region" id="region">
                                                <option value="">Please Select Region</option>
                                                @foreach ($region as $rg)
                                                    <option value="{{ $rg->id }}" @if($garden_center->region == $rg->id) selected @endif>
                                                        {{ $rg->region_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('region')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
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
                                                                class="btn btn-success btn-block"><i
                                                                    class="fa fa-plus"></i>
                                                                Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="image_container">

                                                    @if (count($garden_center->garden_center_image) > 0)
                                                        @foreach ($garden_center->garden_center_image as $key => $image)
                                                            @if ($loop->first)
                                                                <div class="row image_row">
                                                                @else
                                                                    <div class="row image_row mt-3">
                                                            @endif
                                                            <div class="col-md-5">
                                                                <input type="text" readonly class="form-control"
                                                                    name="garden_image[]" value="{{ $image->image }}"
                                                                    id="garden_image_1">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <input type="text" name="garden_image_title[]"
                                                                    class="form-control" value="{{ $image->caption }}"
                                                                    id="garden_image_title_1" placeholder="Enter Image Title">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-block remove_saved_image"
                                                                    data-garden_image_id="{{ $image->garden_center_image_id }}">
                                                                    <i class="fa fa-times"></i> Remove
                                                                </button>
                                                            </div>
                                                </div>
                                                @endforeach
                                            @else
                                                <div class="row image_row">
                                                    <div class="col-md-5">
                                                        <div class="custom-file">
                                                            <input type="file" accept="image/*"
                                                                class="custom-file-input" name="garden_image[]"
                                                                id="garden_image_1">
                                                            <label class="custom-file-label" for="garden_image_1">Choose
                                                                Image</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <input type="text" name="garden_image_title[]" class="form-control"
                                                            id="garden_image_title_1" placeholder="Enter Image Title">
                                                    </div>
                                                </div @endif
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
                                            <textarea id="description" required name="description" placeholder="Enter Description here">{{ old('description') ?? $garden_center->description }}</textarea>
                                            @error('description')
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
                                                    @if ($garden_center->status == 1) checked @endif>
                                                <label for="active">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" name="status" id="inactive" value="0"
                                                    @if ($garden_center->status == 0) checked @endif>
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

                            <div class="row" style="gap: 20px;">
                                @foreach ($garden_center->garden_center_image as $garden_image)
                                    <div style="display: grid;">
                                        <img width="200px" height="200px"
                                            src="{{ env('IMAGES_PATH') . 'center_garden_images/' . $garden_image->image }}">
                                        <span>{{ $garden_image->image }}</span>
                                    </div>
                                @endforeach
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

        $('#add_new_image').on('click', function() {
            var rowCount = $('.image_container .image_row').length + 1;

            var html = `<div class="row image_row mt-3">
                            <div class="col-md-5">
                                <div class="custom-file">
                                    <input type="file" accept="image/*" class="custom-file-input" name="garden_image[]"
                                        id="garden_image_` + rowCount + `">
                                    <label class="custom-file-label" for="garden_image_` + rowCount + `">Choose
                                        Image</label>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <input type="text" name="garden_image_title[]" class="form-control"
                                    id="garden_image_title_` + rowCount + `" placeholder="Enter Image Title">
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


        $('.remove_saved_image').on('click', function() {
            var garden_image_id = $(this).data('garden_image_id');
            var garden_center_id = "{{ $garden_center->id }}";

            Swal.fire({
                title: 'Are you sure?',
                text: "Are you sure you wanted to delete this image permanently?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: base_url + "/garden-center/delete-image-from-garden-center/" + garden_center_id + "/" +
                            garden_image_id,
                        type: "POST",
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: true,
                        success: function(response) {
                            if (response.status) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your image has been deleted successfully.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
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
                }
            });
        });





        $(function() {
            var rowCount = $('.category_container .category_row').length + 1;
            var validationRules = {
                "title": "required",
                "description": "required",
                "garden_image[]": "required",
                "status": "required"
            };

            var validation_messages = {
                "title": "Please Enter Title",
                "description": "Please Enter Description",
                "garden_image[]": "Please Select Item Image",
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
