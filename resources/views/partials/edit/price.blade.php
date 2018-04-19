<div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
	<label class="control-label col-md-3" for="price">Biaya</label>
	<div class="col-md-4">
		<input type="text" class="form-control" name="price" id="price" value="{{ Input::old('price', $item->price) }}" {{ (Auth::user()->isSuperView() ? 'disabled' : '') }}>
        @if ($errors->has('price'))
            <span class="help-block">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
        @endif
	</div>
</div>
