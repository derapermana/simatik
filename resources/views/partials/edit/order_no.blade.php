<div class="form-group {{ $errors->has('order_no') ? ' has-error' : '' }}">
	<label class="control-label col-md-3" for="order_no">Order No.</label>
	<div class="col-md-4">
		<input type="text" class="form-control" name="order_no" id="order_no" value="{{ Input::old('order_no', $item->order_no) }}" {{ (Auth::user()->isSuperView() ? 'disabled' : '') }}>
        @if ($errors->has('order_no'))
            <span class="help-block">
                <strong>{{ $errors->first('order_no') }}</strong>
            </span>
        @endif
	</div>
</div>
