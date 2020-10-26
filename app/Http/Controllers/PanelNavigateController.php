<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\SiteModel;

use Illuminate\Http\Request;

class PanelNavigateController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            return view("admin_panel.index");
        }
        else
        {
            return redirect('/auth');
        }
    }

    public function slider()
    {
        if(Auth::check())
        {
            return view("admin_panel.slider");
        }
        else
        {
            return redirect('/auth');
        }
    }

    public function plants()
    {
        if(Auth::check())
        {
            return view("admin_panel.plants_reader");
        }
        else
        {
            return redirect('/auth');
        }
    }

    public function auth()
    {
        if(Auth::check())
        {
            return redirect('/panel');
        }
        else
        {
            return view("admin_panel.admin_auth");
        }
    }

    public function home()
    {
        return view("layouts.home", ['info' => SiteModel::find('1')]);
    }
}
