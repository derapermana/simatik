<div class="form-group {{ $errors->has('order_date') ? ' has-error' : '' }}">
	<label class="control-label col-md-3" for="order_date">Order Date</label>
	<div class="col-md-4">
		<input data-provide="datepicker" class="form-control datepicker" data-date-format="yyyy-mm-dd" name="order_date" id="order_date" value="{{ Input::old('order_date', $item->order_date) }}" {{ (Auth::user()->isSuperView() ? 'disabled' : '') }}>
        @if ($errors->has('order_date'))
            <span class="help-block">
                <strong>{{ $errors->first('order_date') }}</strong>
            </span>
        @endif
	</div>
</div>
