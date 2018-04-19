@extends('default')

@section('css')
    <link href="{!! asset('assets') !!}/global/plugins/bootstrap-tagsinput/src/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('assets') !!}/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
@endsection

@section('content')

    <form class="form form-horizontal" method="post" action="{{ \Request::url() }}">
        <div class="form-body">
            @csrf
            @include('partials.edit.institution')
            @include('partials.edit.person')
            <div class="form-group {{ $errors->has('bmn_code') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="bmn_code">Kode BMN</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="bmn_code" id="bmn_code" value="{{ Input::old('bmn_code', $item->bmn_code) }}" disabled>
                    @if ($errors->has('bmn_code'))
                        <span class="help-block">
                        <strong>{{ $errors->first('bmn_code') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="type">Tipe Server</label>
                <div class="col-md-4">
                    <select name="type" id="type" class="form-control" disabled>
                        <option value="">--Pillih Tipe Server--</option>
                        <option value="cloud" {{ (Input::old('type', $item->type) == 'cloud' ? 'selected' : '') }}>Cloud Server</option>
                        <option value="rack_mount" {{ (Input::old('type', $item->type) == 'rack_mount' ? 'selected' : '') }}>Rack Mount</option>
                        <option value="blade" {{ (Input::old('type', $item->type) == 'blade' ? 'selected' : '') }}>Blade Server</option>
                        <option value="pc_tower" {{ (Input::old('type', $item->type) == 'pc_tower' ? 'selected' : '') }}>PC Tower</option>
                    </select>
                    @if ($errors->has('type'))
                        <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('manufacture') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="manufacture">Merk</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="manufacture" id="manufacture" value="{{ Input::old('manufacture', $item->manufacture) }}" disabled>
                    @if ($errors->has('manufacture'))
                        <span class="help-block">
                        <strong>{{ $errors->first('manufacture') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('model') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="model">Model</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="model" id="model" value="{{ Input::old('model', $item->model) }}" disabled>
                    @if ($errors->has('model'))
                        <span class="help-block">
                        <strong>{{ $errors->first('model') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('purchase_date') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="purchase_date">Tanggal Pembelian</label>
                <div class="col-md-4">
                    <input data-provide="datepicker" class="form-control datepicker" data-date-format="yyyy-mm-dd" name="purchase_date" id="purchase_date" value="{{ Input::old('purchase_date', $item->purchase_date) }}" disabled>
                    @if ($errors->has('purchase_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('purchase_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('termination_date') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="termination_date">Tanggal Penghapusan</label>
                <div class="col-md-4">
                    <input data-provide="datepicker" class="form-control datepicker" data-date-format="yyyy-mm-dd" name="termination_date" id="termination_date" value="{{ Input::old('termination_date', $item->termination_date) }}" disabled>
                    @if ($errors->has('termination_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('termination_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('barcode') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="barcode">Barcode</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="barcode" id="barcode" value="{{ Input::old('barcode', $item->barcode) }}" disabled>
                    @if ($errors->has('barcode'))
                        <span class="help-block">
                        <strong>{{ $errors->first('barcode') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('serial_number') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="serial_number">Serial Number</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="serial_number" id="serial_number" value="{{ Input::old('serial_number', $item->serial_number) }}" disabled>
                    @if ($errors->has('serial_number'))
                        <span class="help-block">
                        <strong>{{ $errors->first('serial_number') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('processor') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="processor">Processor</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="processor" id="processor" value="{{ Input::old('processor', $item->processor) }}" disabled>
                    @if ($errors->has('processor'))
                        <span class="help-block">
                        <strong>{{ $errors->first('processor') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('memory') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="memory">Memory (MB)</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="memory" id="memory" value="{{ Input::old('memory', $item->memory) }}" disabled>
                    @if ($errors->has('memory'))
                        <span class="help-block">
                        <strong>{{ $errors->first('memory') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('disk') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="disk">Disk (Storage)(MB)</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="disk" id="disk" value="{{ Input::old('disk', $item->disk) }}" disabled>
                    @if ($errors->has('disk'))
                        <span class="help-block">
                        <strong>{{ $errors->first('disk') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            @include('partials.edit.price')
            <div class="form-group {{ $errors->has('location') || $errors->has('location2') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="location">Lokasi</label>
                <div class="col-md-4">
                    <select name="location" id="location" class="form-control" disabled>
                        <option value="">--Pillih Lokasi Server--</option>
                        <option value="pustekkom_ciputat" {{ (Input::old('location', $item->location) == 'pustekkom_ciputat' ? 'selected' : '') }}>Pustekkom, Data Center Ciputat</option>
                        <option value="pustekkom_senayan" {{ (Input::old('location', $item->location) == 'pustekkom_senayan' ? 'selected' : '') }}>Pustekkkom, Data Center Senayan Gd. C Lt. 2</option>
                        <option value="pustekkom_sby" {{ (Input::old('location', $item->location) == 'pustekkom_sby' ? 'selected' : '') }}>Pustekkom, Data Center Sidoarjo</option>
                        <option value="idc_d3" {{ (Input::old('location', $item->location) == 'idc_d3' ? 'selected' : '') }}>IDC Duren 3</option>
                        <option value="lain-lain" {{ (Input::old('location', $item->location) == 'lain-lain' ? 'selected' : '') }}>Lain-lain</option>
                    </select>
                    <br>
                    <input id="location2" class="form-control" name="location2" value="{{ Input::old('location', $item->location) }}" disabled />
                    @if ($errors->has('location') || $errors->has('location2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                            <strong>{{ $errors->first('location2') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
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
