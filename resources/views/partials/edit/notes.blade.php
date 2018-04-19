<div class="form-group {{ $errors->has('notes') ? ' has-error' : '' }}">
	<label class="control-label col-md-3" for="notes">Catatan</label>
	<div class="col-md-4">
        <textarea class="form-control" name="notes" id="notes" {{ (Auth::user()->isSuperView() ? 'disabled' : '') }}>
                {{ Input::old('notes', $item->notes) }}
        </textarea>
        @if ($errors->has('notes'))
            <span class="help-block">
                <strong>{{ $errors->first('notes') }}</strong>
            </span>
        @endif
	</div>
</div>
