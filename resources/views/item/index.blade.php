@extends('layout.main')
@section('head-css-script')
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
        .description{
            white-space: nowrap;
            width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @include('flash')
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold" style="font-size: 30px">Items List</h3>
                            <a href="{{ route('item.create') }}" class="btn btn-success float-right">Create Item</a>
                        </div>

                        <div class="card-body">
                            <table id="item_list" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="20%">Title</th>
                                        <th width="13%">Category</th>
                                        <th width="13%">Sub Category</th>
                                        <th width="34%">Description</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                @foreach ($item->categories as $cat)
                                                {{ $cat->title }}
                                                @if(!$loop->last)
                                                ,
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($item->subCategories as $sub)
                                                {{ $sub->category->title .':'. $sub->title }}
                                                @if(!$loop->last)
                                                ,
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="description">
                                                    {{ $item->description }}
                                                </div>
                                            </td>
                                            <td>{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <a href="{{ route('item.edit', ['id' => $item->id]) }}"
                                                    class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>

                                                @if($item->is_delete)
                                                    <a href="{{ route('item.restore', ['id' => $item->id]) }}" class="btn btn-info">
                                                        <i class="fa fa-undo"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('item.destroy', ['id' => $item->id]) }}"
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
            $("#item_list").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#item_list_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
