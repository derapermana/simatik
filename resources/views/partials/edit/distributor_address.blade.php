<div class="form-group {{ $errors->has('distributor_address') ? ' has-error' : '' }}">
	<label class="control-label col-md-3" for="distributor_address">Alamat Distributor</label>
	<div class="col-md-4">
		<input type="text" class="form-control" name="distributor_address" id="distributor_address" value="{{ Input::old('distributor_address', $item->distributor_address) }}" {{ (Auth::user()->isSuperView() ? 'disabled' : '') }}>
        @if ($errors->has('distributor_address'))
            <span class="help-block">
                <strong>{{ $errors->first('distributor_address') }}</strong>
            </span>
        @endif
	</div>
</div>
