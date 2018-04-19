<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
    <label class="control-label col-md-3" for="email">Email</label>
    <div class="col-md-4">
        <input type="email" class="form-control" name="email" id="email" value="{{ Input::old('email', $item->email) }}" required {{ (Auth::user()->isSuperView() ? 'disabled' : '') }}>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>
