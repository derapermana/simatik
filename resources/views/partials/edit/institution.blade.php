@if (\App\Institution::isCurrentUserAuthorized())
<div class="form-group {{ $errors->has('institution_id') ? ' has-error' : '' }}">
    <label class="control-label col-md-3" for="institution_id">Unit Kerja</label>
    <div class="col-md-4">
        <select name="institution_id" id="institution_id" class="form-control" required {{ (Auth::user()->isSuperView() ? 'disabled' : '') }}>
            <option value="">--Pilih Unit Kerja--</option>
            @foreach('App\Institution'::all() as $institution)
                <option value="{{ $institution->id }}" {{ (Input::old('institution_id', $item->institution_id) == $institution->id ? 'selected' : '') }}>{{ $institution->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('status'))
            <span class="help-block">
                <strong>{{ $errors->first('status') }}</strong>
            </span>
        @endif
    </div>
</div>
@endif
