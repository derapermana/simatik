<div class="form-group {{ $errors->has('manufacture') ? ' has-error' : '' }}">
	<label class="control-label col-md-3" for="name">Manufaktur</label>
	<div class="col-md-4">
		<input type="text" class="form-control" name="manufacture" id="manufacture" value="{{ Input::old('manufacture', $item->manufacture) }}" {{ (Auth::user()->isSuperView() ? 'disabled' : '') }}>
        @if ($errors->has('manufacture'))
            <span class="help-block">
                <strong>{{ $errors->first('manufacture') }}</strong>
            </span>
        @endif
	</div>
</div>
