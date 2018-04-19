@extends('default')

@section('css')
    <link href="{!! asset('assets') !!}/global/plugins/bootstrap-tagsinput/src/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <form class="form form-horizontal" method="post" action="{{ \Request::url() }}">
        <div class="form-body">
            @csrf
            @include('partials.edit.institution')
            @include('partials.edit.name')
            <div class="form-group {{ $errors->has('ip_address') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="ip_address">Alamat IP</label>
                <div class="col-md-4">
                    {{--<select name="ip_address_id" class="form-control" id="ip_address_id">--}}
                    {{--<option value="">--Pilih IP Address--</option>--}}
                    {{--@foreach($ip_addresses as $ip_address)--}}
                    {{--<option value="{{ $ip_address->id }}" {{ (Input::old('ip_address_id', $item->ip_address_id) == $ip_address->id ? 'selected' : '') }}>{{ $ip_address->ip_address }}</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                    <input type="text" name="ip_address" value="{{ Input::old('ip_address', $item->ip_address) }}" class="form-control" disabled>
                    <span class="help-block">
                        @if ($errors->has('ip_address'))
                            <span class="help-block">
                        <strong>{{ $errors->first('ip_address') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="type">Tipe Aplikasi</label>
                <div class="col-md-4">
                    <select name="type" class="form-control" id="type" disabled>
                        <option value="">--Tipe Aplikasi--</option>
                        <option value="internal" {{ (Input::old('type', $item->type) == 'internal' ? 'selected' : '') }}>Internal</option>
                        <option value="eksternal" {{ (Input::old('type', $item->type) == 'eksternal' ? 'selected' : '') }}>Eksternal</option>
                    </select>
                    <span class="help-block">
                        @if ($errors->has('type'))
                            <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('environment') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="environment">Host</label>
                <div class="col-md-4">
                    <select name="environment" class="form-control" id="environment" disabled>
                        <option value="">--Tipe Host--</option>
                        <option value="hosting" {{ (Input::old('environment', $item->environment) == 'hosting' ? 'selected' : '') }}>Hosting</option>
                        <option value="cloud" {{ (Input::old('environment', $item->environment) == 'cloud' ? 'selected' : '') }}>Cloud</option>
                        <option value="colocation" {{ (Input::old('environment', $item->environment) == 'colocation' ? 'selected' : '') }}>Colocation</option>
                    </select>
                    <span class="help-block">
                        @if ($errors->has('type'))
                            <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            @include('partials.edit.person')
            @include('partials.edit.price')
            <div class="form-group {{ $errors->has('desc') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="desc">Deskripsi Aplikasi</label>
                <div class="col-md-4">
                    <textarea name="desc" id="desc" class="form-control" disabled>
                        {{ Input::old('desc', $item->desc) }}
                    </textarea>
                    <span class="help-block">
                        @if ($errors->has('desc'))
                            <span class="help-block">
                        <strong>{{ $errors->first('desc') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('technologies') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="technologies">Teknologi yang digunakan</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="technologies" id="technologies" value="{{ Input::old('technologies', $item->technologies) }}" data-role="tagsinput" disabled>
                    @if ($errors->has('technologies'))
                        <span class="help-block">
                        <strong>{{ $errors->first('technologies') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('isactive') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="isactive">Status</label>
                <div class="col-md-4">
                    <select name="isactive" class="form-control" id="isactive" disabled>
                        <option value="">--Status Aplikasi--</option>
                        <option value="0" {{ (Input::old('isactive', $item->isactive) == '0' ? 'selected' : '') }}>Tidak Aktif</option>
                        <option value="1" {{ (Input::old('isactive', $item->isactive) == '1' ? 'selected' : '') }}>Aktif</option>
                    </select>
                    <span class="help-block">
                        @if ($errors->has('isactive'))
                            <span class="help-block">
                        <strong>{{ $errors->first('isactive') }}</strong>
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
    <script>
        $(document).ready(function(){
            $('#institution_id').select2();
        });
    </script>
@endsection
