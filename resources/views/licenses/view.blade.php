@extends('default')

@section('css')
    <link href="{!! asset('assets') !!}/global/plugins/bootstrap-tagsinput/src/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('assets') !!}/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>

@endsection

@section('content')
    <h1>Try Git</h1>
    <form class="form form-horizontal" method="post" action="{{ \Request::url() }}">
        <div class="form-body">
            @csrf
            @include('partials.edit.institution')
            @include('partials.edit.name')
            @include('partials.edit.person')
            <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="type">Tipe Lisensi</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="type" id="type" value="{{ Input::old('type', $item->type) }}" disabled>
                    @if ($errors->has('type'))
                        <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            @include('partials.edit.manufacture')
            @include('partials.edit.distributor')
            @include('partials.edit.distributor_address')
            @include('partials.edit.order_no')
            @include('partials.edit.order_date')
            <div class="form-group {{ $errors->has('enduser_name') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="enduser_name">Lisensi Atas Nama</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="enduser_name" id="enduser_name" value="{{ Input::old('enduser_name', $item->enduser_name) }}" disabled>
                    @if ($errors->has('enduser_name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('enduser_name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('active_term') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="active_term">Tanggal Aktif</label>
                <div class="col-md-4">
                    <input data-provide="datepicker" class="form-control datepicker" data-date-format="yyyy-mm-dd" name="active_term" id="active_term" value="{{ Input::old('active_term', $item->active_term) }}" disabled>
                    @if ($errors->has('active_term'))
                        <span class="help-block">
                        <strong>{{ $errors->first('active_term') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('end_term') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="end_term">Tanggal Kadaluarsa</label>
                <div class="col-md-4">
                    <input data-provide="datepicker" class="form-control datepicker" data-date-format="yyyy-mm-dd" name="end_term" id="end_term" value="{{ Input::old('end_term', $item->end_term) }}" disabled>
                    @if ($errors->has('end_term'))
                        <span class="help-block">
                        <strong>{{ $errors->first('end_term') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('qty') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="qty">Jumlah Lisensi</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="qty" id="qty" value="{{ Input::old('qty', $item->qty) }}" disabled>
                    @if ($errors->has('qty'))
                        <span class="help-block">
                        <strong>{{ $errors->first('qty') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('sku') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="sku">Stock Keeping Unit (SKU)</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="sku" id="sku" value="{{ Input::old('sku', $item->sku) }}" disabled>
                    @if ($errors->has('sku'))
                        <span class="help-block">
                        <strong>{{ $errors->first('sku') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('serial_number') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="serial_number">Serial Number/ Activation Number</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="serial_number" id="serial_number" value="{{ Input::old('serial_number', $item->serial_number) }}" disabled>
                    @if ($errors->has('serial_number'))
                        <span class="help-block">
                        <strong>{{ $errors->first('serial_number') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            @include('partials.edit.price')
            @include('partials.edit.notes')

        </div>
    </form>

@endsection

@section('js')
    <script src="{!! asset('assets') !!}/global/plugins/bootstrap-tagsinput/src/bootstrap-tagsinput.js" type="text/javascript"></script>
    <script type="text/javascript" src="{!! asset('assets') !!}/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <script>
        $(document).ready(function(){
            $('#institution_id').select2();
            $('.datepicker').datepicker();
        });
    </script>
@endsection
