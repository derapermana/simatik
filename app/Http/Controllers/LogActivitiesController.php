<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Input;
use Auth;
use DataTables;
use Gate;
use Validator;

class LogActivitiesController extends Controller
{

    public $page_title = 'Log Aktivitas';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = [
            'App\Person',
            'App\Application',
            'App\License',
            'App\Server',
            'App\Subdomain',
            'App\User',
        ];
        $data = [
            'page_title'    => $this->page_title,
            'models'        => $models,
        ];
        return view('logs.index', $data);
    }

    public function getDataTable(Request $request)
    {
        $activities = Activity::orderBy('created_at')->get();
        return Datatables::of($activities)
            ->addColumn('subject', function($activities) {
                return $activities->subject;
            })
            ->addColumn('causer', function($activities) {
                return $activities->causer;
            })
            ->addColumn('desc', function($activities) {
                return $activities->changes();
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
