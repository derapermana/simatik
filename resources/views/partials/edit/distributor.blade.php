<div class="form-group {{ $errors->has('distributor') ? ' has-error' : '' }}">
	<label class="control-label col-md-3" for="distributor">Distributor</label>
	<div class="col-md-4">
		<input type="text" class="form-control" name="distributor" id="distributor" value="{{ Input::old('distributor', $item->distributor) }}" {{ (Auth::user()->isSuperView() ? 'disabled' : '') }}>
        @if ($errors->has('distributor'))
            <span class="help-block">
                <strong>{{ $errors->first('distributor') }}</strong>
            </span>
        @endif
	</div>
</div>
