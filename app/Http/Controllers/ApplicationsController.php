<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Input;
use Auth;
use DataTables;
use Gate;
use Validator;
use App\Application;
use App\Institution;
use App\Person;
use App\Ip_address;
use App\Subdomain;
use Log;

class ApplicationsController extends Controller
{
    public $page_title = 'Aplikasi';
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
        return view('applications.index', $data);
    }

    public function getDataTable(Request $request)
    {
        if(Auth::user()->isSuperUser() || Auth::user()->isSuperView()) {
            if ($request->id == 9999 || $request->id == null) {
                $applications = Institution::scopeCompanyables(Application::with('institution'))->get();
            } else {
                $applications = Institution::scopeCompanyables(Application::with('institution'))->where('institution_id', $request->id)->get();
            }
        } else {
            $applications = Institution::scopeCompanyables(Application::with('institution'))->get();
        }
        return Datatables::of($applications)
            ->addColumn('institution', function($applications) {
                return $applications->institution->name;
            })
            ->addColumn('action', function($applications) {
                $action = "<span style='white-space: nowrap;'>";
                if (Gate::allows('person.r')) {
                    $action .= "<a href='".route('applications.read', ['id' => $applications->id])."' class='btn btn-icon-only btn-circle blue'><i class='fa fa-eye'></i></a>";
                }
                if (Gate::allows('person.e')) {
                    $action .= "<a href='".route('applications.edit', ['id' => $applications->id])."' class='btn btn-icon-only btn-circle yellow'><i class='fa fa-edit'></i></a>";
                }
                if (Gate::allows('person.d')) {
                    $action .= "<a href='#' data-target='.modal-delete' data-toggle='modal' data-id='".$applications->id."' class='btn btn-icon-only btn-circle red btn-delete'><i class='fa fa-trash'></i></a>";
                }
                $action .="</span>";
                return $action;
            })
            ->editColumn('subdomains', function($applications) {
                if($applications->subdomain) {
                    return $applications->subdomain->subdomain_address;
                } else {
                    return "";
                }
            })
            ->editColumn('person', function($applications) {
                if ($applications->person) {
                    return $applications->person->name;
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
        $application = new Application();
        if (Auth::user()->isSuperUser()) {
            $people = Person::all();
            $subdomains = Subdomain::all();
            $ip_addresses = Ip_address::all();
        } else {
            $institution = Auth::user()->institution;
            $people = $institution->people;
            $subdomains = $institution->subdomains;
            $ip_addresses = $institution->ip_addresses;
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Tambah Aplikasi',
            'item'    => $application,
            'people'    => $people,
            'subdomains' => $subdomains,
            'ip_addresses' => $ip_addresses,
            'ext_name'  => 'Aplikasi',
        ];
        return view('applications.edit', $data);
//        $institution = Auth::user()->institution;
//        return $institution->ip_addresses;
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
            'type' => 'required',
            'environment' => 'required',
            'person_id'  => 'required',
            'desc'  => 'required',
            'isactive'  => 'required',
            'ip_address' => 'required_unless:environment,hosting',
            'price' => 'numeric',
        ]);

        if ($validator->fails()) {
            return redirect('applications/add')
                ->withErrors($validator)
                ->withInput();
        }

        $application = new Application();
        $application->institution_id = Institution::getIdForCurrentUser($request->input('institution_id'));
        $application->name = $request->input('name');
        $application->ip_address = $request->input('ip_address');
        $application->desc = $request->input('desc');
        $application->notes = $request->input('notes');
        $application->type = $request->input('type');
        $application->technologies = $request->input('technologies');
        $application->person_id = $request->input('person_id');
        $application->isactive = $request->input('isactive');
        $application->environment = $request->input('environment');
        $application->price = $request->input('price');
        if ($request->has('techonlogies')) {
            $application->technologies = $request->input('technologies');
        }
        $application->user_id = Auth::user()->id;

        if ($application->save()) {
            Log::info('User: '.Auth::user()->id. '->Create Application: '. $application->id);
            flash()->overlay('Berhasil disimpan', 'Notification');
            return redirect('applications');
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
        $application = Application::findOrFail($id);
        $this->authorize('view', $application);
        if (Auth::user()->isSuperUser()) {
            $people = Person::all();
            $subdomains = Subdomain::all();
            $ip_addresses = Ip_address::all();
        } else {
            $institution = Auth::user()->institution;
            $people = $institution->people;
            $subdomains = $institution->subdomains;
            $ip_addresses = $institution->ip_addresses;
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Detail Aplikasi',
            'item'    => $application,
            'people'    => $people,
            'subdomains' => $subdomains,
            'ip_addresses' => $ip_addresses,
            'ext_name'  => 'Aplikasi',
        ];
        return view('applications.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = Application::findOrFail($id);
        $this->authorize('update', $application);
        if (Auth::user()->isSuperUser()) {
            $people = Person::all();
            $subdomains = Subdomain::all();
            $ip_addresses = Ip_address::all();
        } else {
            $institution = Auth::user()->institution;
            $people = $institution->people;
            $subdomains = $institution->subdomains;
            $ip_addresses = $institution->ip_addresses;
        }
        $data = [
            'page_title'    => $this->page_title,
            'page_subtitle' => 'Edit Aplikasi',
            'item'    => $application,
            'people'    => $people,
            'subdomains' => $subdomains,
            'ip_addresses' => $ip_addresses,
            'ext_name'  => 'Aplikasi',
        ];
        return view('applications.edit', $data);
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
            'type' => 'required',
            'environment' => 'required',
            'person_id'  => 'required',
            'desc'  => 'required',
            'isactive'  => 'required',
            'ip_address' => 'required_unless:environment,hosting',
            'price' => 'numeric',
        ]);

        if ($validator->fails()) {
            return redirect('applications/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }

        $application = Application::findOrFail($id);
        $this->authorize('update', $application);
        $application->institution_id = Institution::getIdForCurrentUser($request->input('institution_id'));
        $application->name = $request->input('name');
        $application->ip_address = $request->input('ip_address');
        $application->desc = $request->input('desc');
        $application->notes = $request->input('notes');
        $application->type = $request->input('type');
        $application->technologies = $request->input('technologies');
        $application->person_id = $request->input('person_id');
        $application->isactive = $request->input('isactive');
        $application->environment = $request->input('environment');
        $application->price = $request->input('price');
        if ($request->has('techonlogies')) {
            $application->technologies = $request->input('technologies');
        }
        $application->user_id = Auth::user()->id;

        if ($application->save()) {
            Log::info('User: '.Auth::user()->id. '->Update Application: '. $application->id);
            flash()->overlay('Berhasil disimpan', 'Notification');
            return redirect('applications');
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
        $application = Application::findOrFail($request->input('id'));
        $this->authorize('delete', $application);
        if ($application->delete()) {
            Log::info('User: '.Auth::user()->id. '->Delete Application: '. $application->id);
            flash()->overlay('Berhasil dihapus', 'Notification');
            return redirect('persons');
        }
    }
}
