@extends('layout.main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-warning"><i class="fas fa-list"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Number of Main Category</span>
                            <span class="info-box-number">{{ $main_category }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-info"><i class="fas fa-th-large"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Number of Category</span>
                            <span class="info-box-number">{{ $category }}</span>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-success"><i class="fas fa-leaf"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Number of Items</span>
                            <span class="info-box-number">{{ $item }}</span>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-danger"><i class="fas fa-map-marker"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Number of Garden Center</span>
                            <span class="info-box-number">{{ $garden_center }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
