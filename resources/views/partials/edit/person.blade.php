
<div class="form-group {{ $errors->has('person_id') ? ' has-error' : '' }}">
    <label class="control-label col-md-3" for="person_id">Pengelola TIK</label>
    <div class="col-md-4">
        <select name="person_id" id="person_id" class="form-control" {{ (Auth::user()->isSuperView() ? 'disabled' : '') }}>
            <option value="">--Pilih Pengelola TIK--</option>
            @foreach($people as $person)
                <option value="{{ $person->id }}" {{ (Input::old('person_id', $item->person_id) == $person->id ? 'selected' : '') }}>{{ $person->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('person_id'))
            <span class="help-block">
                <strong>{{ $errors->first('person_id') }}</strong>
            </span>
        @endif
    </div>
</div>

