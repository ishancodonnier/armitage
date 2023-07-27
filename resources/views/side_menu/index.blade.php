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
                            <h3 class="card-title font-weight-bold" style="font-size: 30px">Side Menu List</h3>
                            <a href="{{ route('side.menu.create') }}" class="btn btn-success float-right">Create
                                Side Menu</a>
                        </div>

                        <div class="card-body">
                            <table id="category_list" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Item</th>
                                        {{-- <th>Side Menu</th> --}}
                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($side_menu as $side)
                                        <tr>
                                            <td>{{ $side->sidemenu_name }}</td>
                                            <td>{{ $side->category != null ? $side->category->title : '' }}</td>
                                            <td>{{ $side->item != null ? $side->item->title : '' }}</td>
                                            <td>
                                                {{-- <a href="{{ route('side.menu.edit', ['id' => $side->id]) }}" class="btn btn-success">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a> --}}

                                                @if ($side->sidemenu_type == 0 && !($side->category_id == 0 && $side->item_id == 0 && $side->category_type == 3))
                                                    <a href="{{ route('side.menu.delete', ['id' => $side->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this from the side menu?');">
                                                        <i class="far fa-trash-alt"></i>Delete
                                                    </a>

                                                    @if ($side->is_active)
                                                        <a href="{{ route('side.menu.destroy', ['id' => $side->id]) }}" class="btn btn-danger">
                                                            <i class="fa fa-times"></i> InActive
                                                        </a>
                                                    @else
                                                        <a href="{{ route('side.menu.restore', ['id' => $side->id]) }}" class="btn btn-info">
                                                            <i class="fa fa-check"></i> Active
                                                        </a>
                                                    @endif
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
                "responsive": true,
                "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#category_list_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
