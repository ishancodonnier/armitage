<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $pagetitle }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @if (request()->route()->uri() != '/')
                        <li class="breadcrumb-item active">{{ $pagetitle }}</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>
