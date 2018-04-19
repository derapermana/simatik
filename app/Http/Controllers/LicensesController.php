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
use App\License;
use Log;

class LicensesController extends Controller
{

    public $page_title = 'Lisensi';
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
        return view('licenses.index', $data);
    }

    public function getDataTable(Request $request)
    {
        if(Auth::user()->isSuperUser() || Auth::user()->isSuperView()) {
            if ($request->id == 9999 || $request->id == null) {
                $licenses = Institution::scopeCompanyables(License::with('institution'))->get();
            } else {
                $licenses = Institution::scopeCompanyables(License::with('institution'))->where('institution_id', $request->id)->get();
            }
        } else {
            $licenses = Institution::scopeCompanyables(License::with('institution'))->get();
        }
        return Datatables::of($licenses)
        ->addColumn('institution', function($licenses) {
            return $licenses->institution->name;
        })
        ->addColumn('action', function($licenses) {
            $action = "<span style='white-space: nowrap;'>";
            if (Gate::allows('license.r')) {
                $action .= "<a href='".route('licenses.read', ['id' => $licenses->id])."' class='btn btn-icon-only btn-circle blue'><i class='fa fa-eye'></i></a>";
            }
            if (Gate::allows('license.e')) {
                $action .= "<a href='".route('licenses.edit', ['id' => $licenses->id])."' class='btn btn-icon-only btn-circle yellow'><i class='fa fa-edit'></i></a>";
            }
            if (Gate::allows('license.d')) {
                $action .= "<a href='#' data-target='.modal-delete' data-toggle='modal' data-id='".$licenses->id."' class='btn btn-icon-only btn-circle red btn-delete'><i class='fa fa-trash'></i></a>";
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
        $license = new License();
        if (Auth::user()->isSuperUser()) {
            $people = Person::all();
        } else {
            $people = Person::where('institution_id', Auth::user()->institution_id)->orderBy('name')->get();
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Tambah Lisensi',
            'people'    => $people,
            'item'    => $license,
        ];
        return view('licenses.edit', $data);
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
            'person_id' => 'required',
            'name' => 'required|max:255',
            'type'  => 'required', 
            'manufacture' => 'required',
            'active_term'  => 'nullable|date',
            'end_term'  => 'nullable|date',
            'price'  => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('licenses/add')
                        ->withErrors($validator)
                        ->withInput();
        }

        $license = new License();
        $license->institution_id    = Institution::getIdForCurrentUser($request->input('institution_id'));
        $license->person_id         = $request->input('person_id');
        $license->name              = $request->input('name');
        $license->type              = $request->input('type');
        $license->manufacture       = $request->input('manufacture');
        $license->distributor       = $request->input('distributor');
        $license->distributor_address   = $request->input('distributor_address');
        $license->order_no   = $request->input('order_no');
        $license->order_date   = $request->input('order_date');
        $license->enduser_name   = $request->input('enduser_name');
        $license->active_term   = $request->input('active_term');
        $license->end_term   = $request->input('end_term');
        $license->qty   = $request->input('qty');
        $license->sku   = $request->input('sku');
        $license->serial_number   = $request->input('serial_number');
        $license->price   = $request->input('price');
        $license->notes   = $request->input('notes');
        $license->user_id = Auth::user()->id;
        if ($license->save()) {
            Log::info('User: '.Auth::user()->id. '->Create License: '. $license->id);
            flash()->overlay('Berhasil disimpan', 'Notification');
            return redirect('licenses');
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
        $license = License::findOrFail($id);
        $this->authorize('view', $license);
        if (Auth::user()->isSuperUser()) {
            $people = Person::all();
        } else {
            $people = Person::where('institution_id', Auth::user()->institution_id)->get();
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Detail Lisensi',
            'people'    => $people,
            'item'    => $license,
        ];
        return view('licenses.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $license = License::findOrFail($id);
        $this->authorize('update', $license);
        if (Auth::user()->isSuperUser()) {
            $people = Person::all();
        } else {
            $people = Person::where('institution_id', Auth::user()->institution_id)->orderBy('name')->get();
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Update Lisensi',
            'people'    => $people,
            'item'    => $license,
        ];
        return view('licenses.edit', $data);
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
            'person_id' => 'required',
            'name' => 'required|max:255',
            'type'  => 'required', 
            'manufacture' => 'required',
            'active_term'  => 'nullable|date',
            'end_term'  => 'nullable|date',
            'price'  => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('licenses/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $license = License::findOrFail($id);
        $this->authorize('update', $license);
        $license->institution_id    = Institution::getIdForCurrentUser($request->input('institution_id'));
        $license->person_id         = $request->input('person_id');
        $license->name              = $request->input('name');
        $license->type              = $request->input('type');
        $license->manufacture       = $request->input('manufacture');
        $license->distributor       = $request->input('distributor');
        $license->distributor_address   = $request->input('distributor_address');
        $license->order_no   = $request->input('order_no');
        $license->order_date   = $request->input('order_date');
        $license->enduser_name   = $request->input('enduser_name');
        $license->active_term   = $request->input('active_term');
        $license->end_term   = $request->input('end_term');
        $license->qty   = $request->input('qty');
        $license->sku   = $request->input('sku');
        $license->serial_number   = $request->input('serial_number');
        $license->price   = $request->input('price');
        $license->notes   = $request->input('notes');
        $license->user_id = Auth::user()->id;
        if ($license->save()) {
            Log::info('User: '.Auth::user()->id. '->Update License: '. $license->id);
            flash()->overlay('Berhasil disimpan', 'Notification');
            return redirect('licenses');
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
            return redirect('licenses')
                        ->withErrors($validator)
                        ->withInput();
        }
        $license = License::findOrFail($request->input('id'));
        $this->authorize('delete', $license);
        if ($license->delete()) {
            Log::info('User: '.Auth::user()->id. '->Delete License: '. $license->id);
            flash()->overlay('Berhasil dihapus', 'Notification');
            return redirect('licenses');
        }
    }
}
