<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Auth;
use DataTables;
use Gate;
use Validator;
use App\Person;
use App\Institution;
use Log;

class PersonsController extends Controller
{
    public $page_title = 'Pengelola TIK';
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
        return view('people.index', $data);
    }

    public function getDataTable(Request $request)
    {
        if(Auth::user()->isSuperUser()  || Auth::user()->isSuperView()) {
            if ($request->id == 9999 || $request->id == null ) {
                $people = Institution::scopeCompanyables(Person::with('institution'))->get();
            } else {
                $people = Institution::scopeCompanyables(Person::with('institution'))->where('institution_id', $request->id)->get();
            }
        } else {
            $people = Institution::scopeCompanyables(Person::with('institution'))->get();
        }
        return Datatables::of($people)
        ->addColumn('institution', function($people) {
            return $people->institution->name;
        })
        ->addColumn('action', function($people) {
            $action = "<span style='white-space: nowrap;'>";
            if (Gate::allows('person.r')) {
                $action .= "<a href='".route('persons.read', ['id' => $people->id])."' class='btn btn-icon-only btn-circle blue'><i class='fa fa-eye'></i></a>";
            }
            if (Gate::allows('person.e')) {
                $action .= "<a href='".route('persons.edit', ['id' => $people->id])."' class='btn btn-icon-only btn-circle yellow'><i class='fa fa-edit'></i></a>";
            }
            if (Gate::allows('person.d')) {
                $action .= "<a href='#' data-target='.modal-delete' data-toggle='modal' data-id='".$people->id."' class='btn btn-icon-only btn-circle red btn-delete'><i class='fa fa-trash'></i></a>";
            }
            $action .="</span>";
            return $action;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $person = new Person();
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Tambah Pengelola TIK',
            'item'    => $person,
        ];
        return view('people.edit', $data);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:people,email,NULL,id,deleted_at,NULL',
            'jabatan' => 'required',
            'status'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('persons/add')
                        ->withErrors($validator)
                        ->withInput();
        }

        $Person = new Person();
        $Person->institution_id = Institution::getIdForCurrentUser($request->input('institution_id'));
        $Person->name = $request->input('name');
        $Person->email = $request->input('email');
        $Person->jabatan = $request->input('jabatan');
        $Person->status = $request->input('status');
        if ($request->has('nip')) {
            $Person->nip = $request->input('nip');
        }
        if ($request->has('expertises')) {
            $Person->expertises = $request->input('expertises');
        }
        $Person->user_id = Auth::user()->id;

        if ($Person->save()) {
            Log::info('User: '.Auth::user()->id. '->Create Person: '. $Person->id);
            flash()->overlay('Berhasil disimpan', 'Notification');
            return redirect('persons');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $person = Person::findOrFail($id);
        $this->authorize('view', $person);
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Detail Pengelola TIK',
            'item'    => $person,
        ];
        return view('people.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::findOrFail($id);
        $this->authorize('update', $person);
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Ubah Pengelola TIK',
            'item'    => $person,
        ];
        return view('people.edit', $data);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:people,email,'.$id.',id,deleted_at,NULL',
            'jabatan' => 'required',
            'status'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('persons/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $Person = Person::findOrFail($id);
        $this->authorize('update', $Person);
        $Person->institution_id = Institution::getIdForCurrentUser($request->input('institution_id'));
        $Person->name = $request->input('name');
        $Person->email = $request->input('email');
        $Person->jabatan = $request->input('jabatan');
        $Person->status = $request->input('status');
        if ($request->has('nip')) {
            $Person->nip = $request->input('nip');
        }
        if ($request->has('expertises')) {
            $Person->expertises = $request->input('expertises');
        }
        $Person->user_id = Auth::user()->id;
        if ($Person->update()) {
            Log::info('User: '.Auth::user()->id. '->Update Person: '. $Person->id);
            flash()->overlay('Berhasil diubah', 'Notification');
            return redirect('persons');
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
            return redirect('persons')
                        ->withErrors($validator)
                        ->withInput();
        }
        $Person = Person::findOrFail($request->input('id'));
        $this->authorize('delete', $Person);
        if ($Person->delete()) {
            Log::info('User: '.Auth::user()->id. '->Delete Person: '. $Person->id);
            flash()->overlay('Berhasil dihapus', 'Notification');
            return redirect('persons');
        }
    }
}
