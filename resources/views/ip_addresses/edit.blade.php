@extends('default')

@section('css')
    <link href="{!! asset('assets') !!}/global/plugins/bootstrap-tagsinput/src/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <form class="form form-horizontal" method="post" action="{{ \Request::url() }}">
        <div class="form-body">
            @csrf
            @include('partials.edit.institution')
            <div class="form-group {{ $errors->has('ip_address') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="ip_address">Alamat IP</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="ip_address" id="ip_address" value="{{ Input::old('ip_address', $item->ip_address) }}" required>
                    <span class="help-block">
                        Tanpa http://
                    @if ($errors->has('ip_address'))
                        <span class="help-block">
                        <strong>{{ $errors->first('ip_address') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            @include('partials.edit.notes')
        </div>
        @include('partials.edit.submit')
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
