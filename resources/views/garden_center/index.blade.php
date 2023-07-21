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
                            <h3 class="card-title font-weight-bold" style="font-size: 30px">Garden Center List</h3>
                            <a href="{{ route('garden.center.create') }}" class="btn btn-success float-right">Create Garden Center</a>
                        </div>

                        <div class="card-body">
                            <table id="item_list" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="2%">#</th>
                                        <th width="18%" >Name</th>
                                        <th width="15%" >Address</th>

                                        <th width="10%" >City</th>
                                        <th width="10%" >State</th>
                                        <th width="10%" >Zipcode</th>

                                        <th width="15%" >Website</th>

                                        <th width="10%" >Status</th>
                                        <th width="10%" >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($garden_center as $gc)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $gc->garden_name }}</td>
                                            <td>{{ $gc->address }}</td>
                                            <td>{{ $gc->city }}</td>
                                            <td>{{ $gc->states_relation->iso2 . '-' . $gc->states_relation->name }}</td>
                                            <td>{{ $gc->zipcode }}</td>
                                            <td>{{ $gc->webside }}</td>
                                            <td>{{ $gc->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <a href="{{ route('garden.center.edit', ['id' => $gc->garden_center_id ]) }}"
                                                    class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>

                                                @if($gc->is_delete)
                                                    <a href="{{ route('garden.center.restore', ['id' => $gc->garden_center_id ]) }}" class="btn btn-info">
                                                        <i class="fa fa-undo"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('garden.center.destroy', ['id' => $gc->garden_center_id ]) }}"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this garden center?');"><i
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
                "responsive": true, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#item_list_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
