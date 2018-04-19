<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Auth;
use DataTables;
use Gate;
use Validator;
use App\Server;
use App\Institution;
use App\Person;
use Log;

class ServersController extends Controller
{
    public $page_title = 'Server';
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
        return view('servers.index', $data);
    }

    public function getDataTable(Request $request)
    {
        if(Auth::user()->isSuperUser() || Auth::user()->isSuperView()) {
            if ($request->id == 9999 || $request->id == null) {
                $servers = Institution::scopeCompanyables(Server::with('institution'))->get();
            } else {
                $servers = Institution::scopeCompanyables(Server::with('institution'))->where('institution_id', $request->id)->get();
            }
        } else {
            $servers = Institution::scopeCompanyables(Server::with('institution'))->get();
        }
        return Datatables::of($servers)
            ->addColumn('institution', function($servers) {
                return $servers->institution->name;
            })
            ->addColumn('action', function($servers) {
                $action = "<span style='white-space: nowrap;'>";
                if (Gate::allows('server.r')) {
                    $action .= "<a href='".route('servers.read', ['id' => $servers->id])."' class='btn btn-icon-only btn-circle blue'><i class='fa fa-eye'></i></a>";
                }
                if (Gate::allows('server.e')) {
                    $action .= "<a href='".route('servers.edit', ['id' => $servers->id])."' class='btn btn-icon-only btn-circle yellow'><i class='fa fa-edit'></i></a>";
                }
                if (Gate::allows('person.d')) {
                    $action .= "<a href='#' data-target='.modal-delete' data-toggle='modal' data-id='".$servers->id."' class='btn btn-icon-only btn-circle red btn-delete'><i class='fa fa-trash'></i></a>";
                }
                $action .="</span>";
                return $action;
            })
            ->editColumn('location', function($servers) {
                switch ($servers->location) {
                    case 'pustekkom_ciputat' :
                        $location = 'Pustekkom, Data Center Ciputat';
                        break;
                    case 'pustekkom_senayan' :
                        $location = 'Pustekkom, Data Center Senayan Gd. C Lt. 2';
                        break;
                    case 'pustekkom_sby' :
                        $location = 'Pustekkom, Data Center Sidoarjo';
                        break;
                    case 'idc_d3' :
                        $location = 'IDC Duren 3';
                        break;
                    default:
                        $location = $servers->location;
                }
                return $location;
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
        $server = new Server();
        if (Auth::user()->isSuperUser()) {
            $people = Person::all();
        } else {
            $people = Person::where('institution_id', Auth::user()->institution_id)->get();
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Tambah Server',
            'item'    => $server,
            'people'  => $people,
        ];
        return view('servers.edit', $data);
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
            'type' => 'required',
            'manufacture' => 'required_unless:type,cloud',
            'model'  => 'required_unless:type,cloud',
            'location2'  => 'required_if:location,lain-lain',
            'price' => 'numeric',
            'disk' => 'numeric',
            'memory' => 'numeric',
        ]);

        $validator->sometimes('location', 'required', function($input) {
           return $input->type != 'cloud' && $input->location != 'lain-lain';
        });

        if ($validator->fails()) {
            return redirect('servers/add')
                ->withErrors($validator)
                ->withInput();
        }

        $server = new Server();
        $server->institution_id    = Institution::getIdForCurrentUser($request->input('institution_id'));
        $server->person_id         = $request->input('person_id');
        $server->bmn_code              = $request->input('bmn_code');
        $server->type              = $request->input('type');
        $server->manufacture       = $request->input('manufacture');
        $server->model       = $request->input('model');
        $server->purchase_date   = $request->input('purchase_date');
        $server->termination_date   = $request->input('termination_date');
        $server->barcode   = $request->input('barcode');
        $server->serial_number   = $request->input('serial_number');
        $server->processor   = $request->input('processor');
        $server->memory   = $request->input('memory');
        $server->disk   = $request->input('disk');
        $server->price   = $request->input('price');
        if($request->input('location') == 'lain-lain') {
            $server->location = $request->input('location2');
        } else {
            $server->location = $request->input('location');
        }
        $server->user_id = Auth::user()->id;
        if ($server->save()) {
            Log::info('User: '.Auth::user()->id. '->Create Server: '. $server->id);
            flash()->overlay('Berhasil disimpan', 'Notification');
            return redirect('servers');
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
        $server = Server::findOrFail($id);
        $this->authorize('view', $server);
        if (Auth::user()->isSuperUser()) {
            $people = Person::all();
        } else {
            $people = Person::where('institution_id', Auth::user()->institution_id)->get();
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Edit Server',
            'item'    => $server,
            'people'  => $people,
        ];
        return view('servers.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $server = Server::findOrFail($id);
        $this->authorize('update', $server);
        if (Auth::user()->isSuperUser()) {
            $people = Person::all();
        } else {
            $people = Person::where('institution_id', Auth::user()->institution_id)->get();
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Edit Server',
            'item'    => $server,
            'people'  => $people,
        ];
        return view('servers.edit', $data);
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
            'type' => 'required',
            'manufacture' => 'required_unless:type,cloud',
            'model'  => 'required_unless:type,cloud',
            'location2'  => 'required_if:location,lain-lain',
            'price' => 'numeric',
            'disk' => 'numeric',
            'memory' => 'numeric',
        ]);

        $validator->sometimes('location', 'required', function($input) {
            return $input->type != 'cloud' && $input->location != 'lain-lain';
        });

        if ($validator->fails()) {
            return redirect('servers/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }

        $server = Server::findOrFail($id);
        $this->authorize('update', $server);
        $server->institution_id    = Institution::getIdForCurrentUser($request->input('institution_id'));
        $server->person_id         = $request->input('person_id');
        $server->bmn_code              = $request->input('bmn_code');
        $server->type              = $request->input('type');
        $server->manufacture       = $request->input('manufacture');
        $server->model       = $request->input('model');
        $server->purchase_date   = $request->input('purchase_date');
        $server->termination_date   = $request->input('termination_date');
        $server->barcode   = $request->input('barcode');
        $server->serial_number   = $request->input('serial_number');
        $server->processor   = $request->input('processor');
        $server->memory   = $request->input('memory');
        $server->disk   = $request->input('disk');
        $server->price   = $request->input('price');
        if($request->input('location') == 'lain-lain') {
            $server->location = $request->input('location2');
        } else {
            $server->location = $request->input('location');
        }
        $server->user_id = Auth::user()->id;
        if ($server->save()) {
            Log::info('User: '.Auth::user()->id. '->Update Server: '. $server->id);
            flash()->overlay('Berhasil disimpan', 'Notification');
            return redirect('servers');
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
            return redirect('servers')
                ->withErrors($validator)
                ->withInput();
        }
        $server = Server::findOrFail($request->input('id'));
        $this->authorize('delete', $server);
        if ($server->delete()) {
            Log::info('User: '.Auth::user()->id. '->Delete Server: '. $server->id);
            flash()->overlay('Berhasil dihapus', 'Notification');
            return redirect('licenses');
        }
    }
}
