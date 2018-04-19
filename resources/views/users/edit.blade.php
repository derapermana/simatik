@extends('default')

@section('css')

@endsection

@section('content')

    <form class="form form-horizontal" method="post" action="{{ \Request::url() }}">
        <div class="form-body">
            @csrf
            @include('partials.edit.institution')
            @include('partials.edit.name')
            @include('partials.edit.email')
            <div class="form-group {{ $errors->has('isactive') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="isactive">Is Active</label>
                <div class="col-md-4">
                    <select name="isactive" id="isactive" class="form-control" required>
                        <option value="0" {{ (Input::old('isactive', $item->isactive) == '0' ? 'selected' : '') }}>Tidak Aktif</option>
                        <option value="1" {{ (Input::old('isactive', $item->isactive) == '1' ? 'selected' : '') }}>Aktif</option>
                    </select>
                    @if ($errors->has('isactive'))
                        <span class="help-block">
                            <strong>{{ $errors->first('isactive') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label col-md-3" for="isactive">Password</label>
                <div class="col-md-4">
                    <input type="password" name="password" class="form-control">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <!-- Groups -->
            <div class="form-group{{ $errors->has('groups') ? ' has-error' : '' }}">
                <label class="col-md-3 control-label" for="groups"> Group User</label>
                <div class="col-md-5">

                    @if ((Config::get('app.lock_passwords') || (!Auth::user()->isSuperUser())))

                        @if (count($userGroups->keys()) > 0)
                            <ul>
                                @foreach ($groups as $id => $group)
                                    {!! ($userGroups->keys()->contains($id) ? '<li>'.e($group).'</li>' : '') !!}
                                @endforeach
                            </ul>
                        @endif

                        <span class="help-block">Only superadmins may edit group memberships.</p>
                        @else
                            <div class="controls">
                                <select
                                name="groups[]"
                                id="groups[]"
                                multiple="multiple"
                                class="form-control">

                                @foreach ($groups as $id => $group)
                                    <option value="{{ $id }}"
                                    {{ ($userGroups->keys()->contains($id) ? ' selected="selected"' : '') }}>
                                    {{ $group }}
                                </option>
                            @endforeach
                        </select>

                        <span class="help-block">

                        </span>
                    </div>
                @endif

            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Hak Akses Pengguna</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    @if (!Auth::user()->isSuperUser())
                        <p class="alert alert-warning">Only superadmins may grant a user superadmin access.</p>
                    @endif
                </div>
                <table class="table table-striped permissions">
                    <thead>
                        <tr class="permissions-row">
                            <th class="col-md-5"><span class="line"></span>Permission</th>
                            <th class="col-md-1"><span class="line"></span>Grant</th>
                            <th class="col-md-1"><span class="line"></span>Deny</th>
                            <th class="col-md-1"><span class="line"></span>Inherit</th>
                        </tr>
                    </thead>
                    @foreach ($permissions as $area => $permissionsArray)
                        @if (count($permissionsArray) == 1)
                            <tbody class="permissions-group">
                                <?php $localPermission = $permissionsArray[0] ?>
                                <tr class="header-row permissions-row">
                                    <td class="col-md-5 tooltip-base permissions-item"
                                    data-toggle="tooltip"
                                    data-placement="right"
                                    data-container="body"
                                    title="{{ $localPermission['note'] }}">
                                    <h4>{{ $area . ': ' . $localPermission['label'] }}</h4>
                                </td>
                                <td class="col-md-1 permissions-item">
                                    @if (($localPermission['permission'] == 'superuser') && (!Auth::user()->isSuperUser()))
                                        {{ Form::radio('permission['.$localPermission['permission'].']', '1',$userPermissions[$localPermission['permission'] ] == '1',['disabled'=>"disabled"]) }}
                                    @else
                                        {{ Form::radio('permission['.$localPermission['permission'].']', '1',$userPermissions[$localPermission['permission'] ] == '1',['value'=>"grant"]) }}
                                    @endif

                                </td>
                                <td class="col-md-1 permissions-item">
                                    @if (($localPermission['permission'] == 'superuser') && (!Auth::user()->isSuperUser()))
                                        {{ Form::radio('permission['.$localPermission['permission'].']', '-1',$userPermissions[$localPermission['permission'] ] == '-1',['disabled'=>"disabled"]) }}
                                    @else
                                        {{ Form::radio('permission['.$localPermission['permission'].']', '-1',$userPermissions[$localPermission['permission'] ] == '-1',['value'=>"deny"]) }}
                                    @endif

                                </td>
                                <td class="col-md-1 permissions-item">
                                    @if (($localPermission['permission'] == 'superuser') && (!Auth::user()->isSuperUser()))
                                        {{ Form::radio('permission['.$localPermission['permission'].']','0',$userPermissions[$localPermission['permission'] ] == '0',['disabled'=>"disabled"] ) }}
                                    @else
                                        {{ Form::radio('permission['.$localPermission['permission'].']','0',$userPermissions[$localPermission['permission'] ] == '0',['value'=>"inherit"] ) }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    @else
                        <tbody class="permissions-group">
                            <tr class="header-row permissions-row">
                                <td class="col-md-5 header-name">
                                    <h3>{{ $area }}</h3>
                                </td>
                                <td class="col-md-1 permissions-item">
                                    {{ Form::radio("$area", '1',false,['value'=>"grant"]) }}
                                </td>
                                <td class="col-md-1 permissions-item">
                                    {{ Form::radio("$area", '-1',false,['value'=>"deny"]) }}
                                </td>
                                <td class="col-md-1 permissions-item">
                                    {{ Form::radio("$area", '0',false,['value'=>"inherit"] ) }}
                                </td>
                            </tr>
                            @foreach ($permissionsArray as $index => $permission)
                                <tr class="permissions-row">
                                    @if ($permission['display'])
                                        <td
                                        class="col-md-5 tooltip-base permissions-item"
                                        data-toggle="tooltip"
                                        data-placement="right"
                                        title="{{ $permission['note'] }}"
                                        >
                                        {{ $permission['label'] }}
                                    </td>
                                    <td class="col-md-1 permissions-item">
                                        @if (($permission['permission'] == 'superuser') && (!Auth::user()->isSuperUser()))
                                            {{ Form::radio('permission['.$permission['permission'].']', '1', $userPermissions[$permission['permission'] ] == '1', ["value"=>"grant", 'disabled'=>'disabled']) }}
                                        @else
                                            {{ Form::radio('permission['.$permission['permission'].']', '1', $userPermissions[ $permission['permission'] ] == '1', ["value"=>"grant"]) }}
                                        @endif
                                    </td>
                                    <td class="col-md-1 permissions-item">
                                        @if (($permission['permission'] == 'superuser') && (!Auth::user()->isSuperUser()))
                                            {{ Form::radio('permission['.$permission['permission'].']', '-1', $userPermissions[$permission['permission'] ] == '-1', ["value"=>"deny", 'disabled'=>'disabled']) }}

                                        @else
                                            {{ Form::radio('permission['.$permission['permission'].']', '-1', $userPermissions[$permission['permission'] ] == '-1', ["value"=>"deny"]) }}
                                        @endif
                                    </td>
                                    <td class="col-md-1 permissions-item">
                                        @if (($permission['permission'] == 'superuser') && (!Auth::user()->isSuperUser()))
                                            {{ Form::radio('permission['.$permission['permission'].']', '0', $userPermissions[$permission['permission']] =='0', ["value"=>"inherit", 'disabled'=>'disabled']) }}
                                        @else
                                            {{ Form::radio('permission['.$permission['permission'].']', '0', $userPermissions[$permission['permission']] =='0', ["value"=>"inherit"]) }}
                                        @endif
                                    </td>

                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            @endforeach
        </table>
    </div>
</div>
</div>
@include('partials.edit.submit')
</form>


@endsection

@section('js')
    <script>
    $(document).ready(function(){
        $('#institution_id').select2();
    });
    </script>
@endsection
