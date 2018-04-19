<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Auth;
use DataTables;
use Gate;
use Validator;
use App\Helpers\Helper;
use App\User;
use App\Institution;
use App\Group;

class UsersController extends Controller
{
    public $page_title = 'Users';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'page_title'    => $this->page_title,
        ];
        return view('users.index', $data);
    }

    public function getDataTable()
    {
        $users = User::all();
        return Datatables::of($users)
        ->addColumn('institution', function($users) {
            return $users->institution->name;
        })
        ->addColumn('action', function($users) {
            $action = "<span style='white-space: nowrap;'>";
            if (Gate::allows('user.e')) {
                $action .= "<a href='".route('users.edit', ['id' => $users->id])."' class='btn btn-icon-only btn-circle yellow'><i class='fa fa-edit'></i></a>";
            }
            if (Gate::allows('user.d')) {
                $action .= "<a href='#' data-target='.modal-delete' data-toggle='modal' data-id='".$users->id."' class='btn btn-icon-only btn-circle red btn-delete'><i class='fa fa-trash'></i></a>";
            }
            $action .="</span>";
            return $action;
        })
        ->editColumn('isactive', function($users) {
            return ($users->isactive == '1' ? '<span class="glyphicon glyphicon-ok-circle"></span>' : '<span class="glyphicon glyphicon-ban-circle"></span>');
        })
        ->rawColumns(['action', 'isactive'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $groups = Group::pluck('name', 'id');

        if (Input::old('groups')) {
            $userGroups = Group::whereIn('id', Input::old('groups'))->pluck('name', 'id');
        } else {
            $userGroups = collect();
        }

        $permissions = config('permissions');
        $userPermissions = Helper::selectedPermissionsArray($permissions, Input::old('permissions', array()));
        $permissions = $this->filterDisplayable($permissions);
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Tambah User',
            'item'          => $user,
            'groups'        => $groups,
            'userGroups'    => $userGroups,
            'permissions'   => $permissions,
            'userPermissions'   => $userPermissions,
        ];
        return view('users.edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('users/add')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->institution_id = Institution::getIdForCurrentUser($request->input('institution_id'));
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->isactive = $request->input('isactive');

        $permissions_array = $request->input('permission');

        if (!Auth::user()->isSuperUser()) {
            unset($permissions_array['superuser']);
        }

        $user->permissions =  json_encode($permissions_array);

        if ($user->save()) {
            if ($request->has('groups')) {
                $user->groups()->sync($request->input('groups'));
            } else {
                $user->groups()->sync(array());
            }
            flash('Pengguna berhasil disimpan')->success();
            return redirect('users');
        }
    }

    /**
    * Returns a view that displays the edit user form
    *
    * @author [A. Gianotto] [<snipe@snipe.net>]
    * @since [v1.0]
    * @param int $id
    * @return View
    */

    private function filterDisplayable($permissions) {
        $output = null;
        foreach($permissions as $key=>$permission) {
                $output[$key] = array_filter($permission, function($p) {
                    return $p['display'] === true;
                });
            }
        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $permissions = config('permissions');
        $user->permissions = $user->decodePermissions();
        $userPermissions = Helper::selectedPermissionsArray($permissions, $user->permissions);
        $permissions = $this->filterDisplayable($permissions);
        $groups = Group::pluck('name', 'id');
        $userGroups = $user->groups()->pluck('name', 'id');
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Edit User',
            'item'          => $user,
            'groups'        => $groups,
            'userGroups'    => $userGroups,
            'permissions'   => $permissions,
            'userPermissions'   => $userPermissions,
        ];
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permissions = $request->input('permissions', array());
        app('request')->request->set('permissions', $permissions);

        $user = User::findOrFail($id);

        $orig_permissions_array = $user->decodePermissions();

        if (is_array($orig_permissions_array)) {
            if (array_key_exists('superuser', $orig_permissions_array)) {
                $orig_superuser = $orig_permissions_array['superuser'];
            } else {
                $orig_superuser = '0';
            }
        } else {
            $orig_superuser = '0';
        }

        if (Auth::user()->isSuperUser()) {
            if ($request->has('groups')) {
                $user->groups()->sync($request->input('groups'));
            } else {
                $user->groups()->sync(array());
            }
        }

        if ($request->input('password') != null){
            $user->password = bcrypt($request->input('password'));
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect('users/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->isactive = $request->input('isactive');
        $user->institution_id = Institution::getIdForCurrentUser($request->input('institution_id'));
        $permissions_array = $request->input('permission');

        if (!Auth::user()->isSuperUser()) {
            unset($permissions_array['superuser']);
            $permissions_array['superuser'] = $orig_superuser;
        }


        $user->permissions =  json_encode($permissions_array);

        if ($user->update()) {
            flash('Pengguna berhasil diupate')->success();
            return redirect('users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('users')
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = User::findOrFail($request->input('id'));
        if ($user->isSuperUser()) {
            flash()->overlay('User tidak boleh dihapus', 'Notification');
            return redirect('users');
        }
        if ($user->delete()) {
            flash()->overlay('Berhasil dihapus', 'Notification');
            return redirect('users');
        }
    }

    public function getProfile()
    {
        $user = Auth::user();
        $this->authorize('view',$user);
        $data = [
            'item' => $user,
            'page_title' => 'Profil',
        ];
        return view('users.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        if ($validator->fails()) {
            return redirect('profile')
                ->withErrors($validator)
                ->withInput();
        }
        $this->authorize('update',$user);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->input('password') != null){
            $user->password = bcrypt($request->input('password'));
        }
        if ($user->update()) {
            flash('Profile berhasil diupate')->success();
            return redirect('home');
        }


    }
}
