<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institution;
use App\User;
use App\Person;
use App\License;
use App\Application;
use Auth;
use App\Server;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'page_title' => 'Dashboard',
            'people'    => Institution::scopeCompanyables(Person::with('institution'))->get(),
            'licenses'    => Institution::scopeCompanyables(License::with('institution'))->get(),
            'applications'    => Institution::scopeCompanyables(Application::with('institution'))->get(),
            'servers'    => Institution::scopeCompanyables(Server::with('institution'))->get(),
        ];
        return view('home', $data);
    }
}
