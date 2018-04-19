<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Auth;
use DataTables;
use Gate;
use Validator;
use App\Institution;
use App\Subdomain;
use App\Application;
use Log;

class SubdomainsController extends Controller
{
    public $page_title = 'Subdomain';
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
        return view('subdomains.index', $data);
    }

    public function getDataTable(Request $request)
    {
        if(Auth::user()->isSuperUser() || Auth::user()->isSuperView()) {
            if ($request->id == 9999 || $request->id == null) {
                $subdomains = Institution::scopeCompanyables(Subdomain::with('institution'))->get();
            } else {
                $subdomains = Institution::scopeCompanyables(Subdomain::with('institution'))->where('institution_id', $request->id)->get();
            }
        } else {
            $subdomains = Institution::scopeCompanyables(Subdomain::with('institution'))->get();
        }
        return Datatables::of($subdomains)
            ->addColumn('institution', function($subdomains) {
                return $subdomains->institution->name;
            })
            ->addColumn('action', function($subdomains) {
                $action = "<span style='white-space: nowrap;'>";
                if (Gate::allows('subdomain.r')) {
                    $action .= "<a href='".route('subdomains.read', ['id' => $subdomains->id])."' class='btn btn-icon-only btn-circle blue'><i class='fa fa-eye'></i></a>";
                }
                if (Gate::allows('subdomain.e')) {
                    $action .= "<a href='".route('subdomains.edit', ['id' => $subdomains->id])."' class='btn btn-icon-only btn-circle yellow'><i class='fa fa-edit'></i></a>";
                }
                if (Gate::allows('subdomain.d')) {
                    $action .= "<a href='#' data-target='.modal-delete' data-toggle='modal' data-id='".$subdomains->id."' class='btn btn-icon-only btn-circle red btn-delete'><i class='fa fa-trash'></i></a>";
                }
                $action .="</span>";
                return $action;
            })
            ->editColumn('status', function ($subdomains) {
                return ($subdomains->status == '0' ? 'Tidak Aktif' : 'Aktif');
            })
            ->addColumn('application', function($subdomains) {
                if ($subdomains->application) {
                    return $subdomains->application->name;
                } else {
                    return "";
                }
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
        $subdomain = new Subdomain();
        if (Auth::user()->isSuperUser()) {
            $applications = Application::doesntHave('subdomain')->get();
        } else {
            $institution = Auth::user()->institution;
            $applications = $institution->applications()->doesntHave('subdomain')->get();
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Tambah Subdomain',
            'item'    => $subdomain,
            'applications' => $applications,
        ];
        return view('subdomains.edit', $data);
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
            'subdomain_address' => 'required|regex:(.kemdikbud.go.id)|unique:subdomains,subdomain_address',
            'status'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('subdomains/add')
                ->withErrors($validator)
                ->withInput();
        }

        $subdomain= new Subdomain();
        $subdomain->institution_id = Institution::getIdForCurrentUser($request->input('institution_id'));
        if (strpos($request->input('subdomain_address'), 'http://')) {
            $subdomain = str_replace('http://','',$request->input('subdomain'));
        } else {
            $subdomain->subdomain_address = $request->input('subdomain_address');
        }
        $subdomain->status = $request->input('status');
        $subdomain->notes = $request->input('notes');
        $subdomain->application_id = $request->input('application_id');
        $subdomain->user_id = Auth::user()->id;

        if ($subdomain->save()) {
            Log::info('User: '.Auth::user()->id. '->Create Subdomain: '. $subdomain->id);
            flash()->overlay('Berhasil disimpan', 'Notification');
            return redirect('subdomains');
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
        $subdomain = Subdomain::findOrFail($id);
        $this->authorize('view', $subdomain);
        if (Auth::user()->isSuperUser()) {
            $applications = Application::doesntHave('subdomain')->get();
        } else {
            $institution = Auth::user()->institution;
            $applications = $institution->applications()->doesntHave('subdomain')->get();
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Detail Subdomain',
            'item'    => $subdomain,
            'applications' => $applications,
        ];
        return view('subdomains.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subdomain = Subdomain::findOrFail($id);
        $this->authorize('update', $subdomain);
        if (Auth::user()->isSuperUser()) {
            $applications = Application::doesntHave('subdomain')->get();
        } else {
            $institution = Auth::user()->institution;
            $applications = $institution->applications()->doesntHave('subdomain')->get();
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Update Subdomain',
            'item'    => $subdomain,
            'applications' => $applications,
        ];
        return view('subdomains.edit', $data);
//        return gethostbyname('dera.google.com');

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
            'subdomain_address' => 'required|regex:(.kemdikbud.go.id)|unique:subdomains,subdomain_address,'.$id,
            'status'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('subdomains/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }

        $subdomain = Subdomain::findOrFail($id);
        $this->authorize('update', $subdomain);
        $subdomain->institution_id = Institution::getIdForCurrentUser($request->input('institution_id'));
        if (strpos($request->input('subdomain_address'), 'http://') === false) {
            $subdomain->subdomain_address = $request->input('subdomain_address');
        } else {
            $subdomain->subdomain_address = str_replace('http://','',$request->input('subdomain_address'));
        }
        $subdomain->status = $request->input('status');
        $subdomain->notes = $request->input('notes');
        $subdomain->application_id = $request->input('application_id');
        $subdomain->user_id = Auth::user()->id;

        if ($subdomain->update()) {
            Log::info('User: '.Auth::user()->id. '->Update Subdomain: '. $subdomain->id);
            flash()->overlay('Berhasil disimpan', 'Notification');
            return redirect('subdomains');
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
            return redirect('subdomains')
                ->withErrors($validator)
                ->withInput();
        }
        $subdomain = Subdomain::findOrFail($request->input('id'));
        $this->authorize('delete', $subdomain);
        if ($subdomain->delete()) {
            Log::info('User: '.Auth::user()->id. '->Delete Subdomain: '. $subdomain->id);
            flash()->overlay('Berhasil dihapus', 'Notification');
            return redirect('subdomains');
        }
    }

}
