@if ($message = Session::get('success'))
<div class="alert alert-block" style="color: #23923d; background-color: #c3ebcd; border-color: #23923d; width: 100%;">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-block" style="color: #b41010; background-color: #ebc3c3; border-color: #b41010; width: 100%;">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-block" style="color: #fffb18; background-color: #f8f6b5; border-color: #fffb18; width: 100%;">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-block" style="color: #1bd2df; background-color: #c3e6eb; border-color: #1bd2df; width: 100%;">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>
@endif


{{-- @if ($errors->any())
<div class="alert " style="color: #b41010; background-color: #ebc3c3; border-color: #b41010; width: 100%;">
	<button type="button" class="close" data-dismiss="alert">×</button>
	Please check the form below for errors
</div>
@endif --}}
