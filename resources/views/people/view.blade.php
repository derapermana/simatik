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
            @include('partials.edit.email')
            <div class="form-group {{ $errors->has('jabatan') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="jabatan">Jabatan</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ Input::old('jabatan', $item->jabatan) }}" disabled>
                    @if ($errors->has('jabatan'))
                        <span class="help-block">
                        <strong>{{ $errors->first('jabatan') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="status">Status</label>
                <div class="col-md-4">
                    <select name="status" id="status" class="form-control" disabled>
                        <option value="">--Pilih Status--</option>
                        <option value="pns" {{ (Input::old('status', $item->status) == 'pns' ? 'selected' : '') }}>PNS</option>
                        <option value="honorer" {{ (Input::old('status', $item->status) == 'honorer' ? 'selected' : '') }}>Honorer</option>
                        <option value="lain" {{ (Input::old('status', $item->status) == 'lain' ? 'selected' : '') }}>Lain-lain</option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('nip') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="nip">NIP</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="nip" id="nip" value="{{ Input::old('nip', $item->nip) }}" disabled>
                    @if ($errors->has('nip'))
                        <span class="help-block">
                        <strong>{{ $errors->first('nip') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('expertises') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="nip">Kompetensi</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="expertises" id="expertises" value="{{ Input::old('expertises', $item->expertises) }}" data-role="tagsinput" disabled>
                    <span class="help-block">
                    <strong>Gunakan tanda "," untuk mengisi lebih dari satu</strong>
                </span>
                    @if ($errors->has('expertises'))
                        <span class="help-block">
                        <strong>{{ $errors->first('expertises') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
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
