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
            .image_row {
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
                        <form id="garden_center_create_form" method="POST" action="{{ route('item.store') }}"
                            enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="garden_name">Garden Name</label>
                                            <input type="text" name="garden_name"
                                                class="form-control @error('garden_name') is-invalid @enderror" required
                                                id="garden_name" placeholder="Enter Garden Name" value="{{ old('garden_name') }}">
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
                                                placeholder="Enter Website" value="{{ old('webside') }}">
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
                                                placeholder="Enter Email" value="{{ old('email') }}">
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
                                                class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number"
                                                placeholder="Enter Phone/Mobile Number" value="{{ old('mobile_number') }}">
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
                                                placeholder="Enter Latitude" value="{{ old('latitude') }}">
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
                                                placeholder="Enter Longitude" value="{{ old('longitude') }}">
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
                                            <textarea class="form-control" style="height: 100px;" name="address" id="address" placeholder="Enter Address"></textarea>
                                            @error('address')
                                                <span class="error invalid-feedback"
                                                    style="display: block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">City</label>
                                            <input type="text" name="city" id="city" class="form-control" placeholder="Enter City">
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
                                                    <option value="{{ $st->id }}">
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
                                                placeholder="Enter Zipcode" value="{{ old('zipcode') }}">
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
                                                    <option value="{{ $rg->id }}">
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
                                                                    class="custom-file-input" name="garden_image[]"
                                                                    id="garden_image_1">
                                                                <label class="custom-file-label" for="garden_image_1">Choose
                                                                    Image</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="text" name="garden_image_title[]"
                                                                class="form-control" id="garden_image_title_1"
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

        $(function() {
            var validationRules = {
                "garden_name": "required",
                "webside": "required",
                // "email": "required",
                "mobile_number": "required",
                "latitude": "required",
                "longitude": "required",
                "address": "required",
                "city": "required",
                "state": "required",
                "zipcode": "required",
                "region": "required",
                "description": "required",
                "garden_image[]": "required",
                "status": "required"
            };

            var validation_messages = {
                "garden_name": "Please Enter Garden Name",
                "webside": "Please Enter Website",
                // "email": "Please Enter Email",
                "mobile_number": "Please Enter Phone/Mobile Number",
                "latitude": "Please Enter Latitude",
                "longitude": "Please Enter Longitude",
                "address": "Please Enter Address",
                "city": "Please Enter City",
                "state": "Please Select State",
                "zipcode": "Please Enter Zipcode",
                "region": "Please Select Region",
                "description": "Please Enter Description",
                "garden_image[]": "Please Select Item Image",
                "status": "Please Select Status"
            };

            $('#garden_center_create_form').validate({
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
