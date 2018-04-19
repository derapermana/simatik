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
use App\Ip_address;

class IP_AddressesController extends Controller
{
    public $page_title = 'IP Address';
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
        return view('ip_addresses.index', $data);
    }

    public function getDataTable()
    {
        $ip_addresses = Institution::scopeCompanyables(Ip_address::with('institution'))->get();
        return Datatables::of($ip_addresses)
            ->addColumn('institution', function($ip_addresses) {
                return $ip_addresses->institution->name;
            })
            ->addColumn('action', function($ip_addresses) {
                $action = "<span style='white-space: nowrap;'>";
                if (Gate::allows('ip_address.e')) {
                    $action .= "<a href='".route('ip_addresses.edit', ['id' => $ip_addresses->id])."' class='btn btn-icon-only btn-circle yellow'><i class='fa fa-edit'></i></a>";
                }
                if (Gate::allows('ip_address.d')) {
                    $action .= "<a href='#' data-target='.modal-delete' data-toggle='modal' data-id='".$ip_addresses->id."' class='btn btn-icon-only btn-circle red btn-delete'><i class='fa fa-trash'></i></a>";
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
        $ip_address = new Ip_address();
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Tambah Alamat IP',
            'item'    => $ip_address,
        ];
        return view('ip_addresses.edit', $data);
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
            'ip_address' => 'required|ip|unique:ip_addresses,ip_address',
        ]);

        if ($validator->fails()) {
            return redirect('ip_addresses/add')
                ->withErrors($validator)
                ->withInput();
        }

        $ip_address= new Ip_address();
        $ip_address->institution_id = Institution::getIdForCurrentUser($request->input('institution_id'));
        if (strpos($request->input('ip_address'), 'http://')) {
            $ip_address = str_replace('http://','',$request->input('ip_address'));
        } else {
            $ip_address->ip_address = $request->input('ip_address');
        }
        $ip_address->notes = $request->input('notes');
        $ip_address->user_id = Auth::user()->id;

        if ($ip_address->save()) {
            flash()->overlay('Berhasil disimpan', 'Notification');
            return redirect('ip_addresses');
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
        $ip_address = Ip_address::findOrFail($id);
        $this->authorize('update', $ip_address);
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Ubah Alamat IP',
            'item'    => $ip_address,
        ];
        return view('ip_addresses.edit', $data);
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
            'ip_address' => 'required|ip|unique:ip_addresses,ip_address,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect('ip_addresses/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }

        $ip_address = Ip_address::findOrFail($id);
        $this->authorize('update', $ip_address);
        $ip_address->institution_id = Institution::getIdForCurrentUser($request->input('institution_id'));
        if (strpos($request->input('ip_address'), 'http://')) {
            $ip_address = str_replace('http://','',$request->input('ip_address'));
        } else {
            $ip_address->ip_address = $request->input('ip_address');
        }
        $ip_address->notes = $request->input('notes');
        $ip_address->user_id = Auth::user()->id;

        if ($ip_address->update()) {
            flash()->overlay('Berhasil disimpan', 'Notification');
            return redirect('ip_addresses');
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
            return redirect('ip_addresses')
                ->withErrors($validator)
                ->withInput();
        }
        $ip_address = Ip_address::findOrFail($request->input('id'));
        $this->authorize('delete', $ip_address);
        if ($ip_address->delete()) {
            flash()->overlay('Berhasil dihapus', 'Notification');
            return redirect('ip_addresses');
        }
    }
}
