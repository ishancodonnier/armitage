@extends('layout.main')
@section('head-css-script')
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @include('flash')
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold" style="font-size: 30px">Category List</h3>
                            <a href="{{ route('category.create') }}" class="btn btn-success float-right">Create
                                Category</a>
                        </div>

                        <div class="card-body">
                            <table id="category_list" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Title</th>
                                        <th>Main Category</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $cg)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cg->title }}</td>
                                            <td>
                                                @foreach ($cg->main_category as $cmg)
                                                    {{ $cmg->title }}
                                                    @if(!$loop->last)
                                                    ,
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $cg->image }}</td>
                                            <td>{{ $cg->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <a href="{{ route('category.edit', ['id' => $cg->id]) }}"
                                                    class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>

                                                @if($cg->is_delete)
                                                    <a href="{{ route('category.restore', ['id' => $cg->id]) }}" class="btn btn-info">
                                                        <i class="fa fa-undo"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('category.destroy', ['id' => $cg->id]) }}"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this category?');"><i
                                                            class="far fa-trash-alt"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer-script')
    <script src="{{ asset('asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#category_list").DataTable({
                "responsive": true, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#category_list_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
