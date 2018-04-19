@extends('default')

@section('css')
    <link href="{!! asset('assets') !!}/global/plugins/bootstrap-tagsinput/src/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <form class="form form-horizontal" method="post" action="{{ \Request::url() }}">
        <div class="form-body">
            @csrf
            @include('partials.edit.name')
            @include('partials.edit.email')
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="isactive">Password</label>
                <div class="col-md-4">
                    <input type="password" name="password" class="form-control">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
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
