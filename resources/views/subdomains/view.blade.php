@extends('default')

@section('css')
    <link href="{!! asset('assets') !!}/global/plugins/bootstrap-tagsinput/src/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <form class="form form-horizontal" method="post" action="{{ \Request::url() }}">
        <div class="form-body">
            @csrf
            @include('partials.edit.institution')
            <div class="form-group {{ $errors->has('subdomain_address') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="subdomain_address">Alamat Subdomain</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="subdomain_address" id="subdomain_address" value="{{ Input::old('subdomain_address', $item->subdomain_address) }}" disabled>
                    @if ($errors->has('subdomain_address'))
                        <span class="help-block">
                        <strong>{{ $errors->first('subdomain_address') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('application_id') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="application_id">Aplikasi</label>
                <div class="col-md-4">
                    <select name="application_id" id="application_id" class="form-control" disabled>
                        <option value="">--Pilih Aplikasi--</option>
                        @foreach($applications as $application)
                            <option value="{{ $application->id }}" {{ (Input::old('application_id', $item->application_id) == '0' ? 'selected' : '') }}>{{ $application->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="status">Status</label>
                <div class="col-md-4">
                    <select name="status" id="status" class="form-control" disabled>
                        <option value="">--Pillih Status Subdomain--</option>
                        <option value="0" {{ (Input::old('status', $item->status) == '0' ? 'selected' : '') }}>Tidak Aktif</option>
                        <option value="1" {{ (Input::old('status', $item->status) == '1' ? 'selected' : '') }}>Aktif</option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
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
