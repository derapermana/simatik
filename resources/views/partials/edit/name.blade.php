<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
	<label class="control-label col-md-3" for="name">Nama {{ $ext_name or '' }}</label>
	<div class="col-md-4">
		<input type="text" class="form-control" name="name" id="name" value="{{ Input::old('name', $item->name) }}" required {{ (Auth::user()->isSuperView() ? 'disabled' : '') }}>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
	</div>
</div>
