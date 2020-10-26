<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteModel;
use Storage;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response() -> json([
            'site' => SiteModel::latest()->get()
        ]);
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
        if(Auth::check())
        {
            $info = SiteModel::where("id", $id)->first();
            if($request->post('titel') != '')
            {
                $info->titel = $request->post('titel');
            }
            if(filter_var($request->post('email'), FILTER_VALIDATE_EMAIL))
            {
                $info->email = $request->post('email');
            }
            if($request->post('footer_text') != '')
            {
                $info->footer_text = $request->post('footer_text');
            }
            if($request->hasFile('logo'))
            {
                $path = $request->file('logo')->store('img', 'public');
                $info->logo = $path;
            }
            else if($request->post('logo') != '')
            {
                $content = file_get_contents($request->post('logo'));
                $name = basename($request->post('logo'));
                Storage::put('\public\img\\'.$name, $content);
                $info->logo = 'img\\'.$name;
            }

            $info->save();

            // return $request->image;
            return response() -> json([
                'site' => SiteModel::latest()->get()
            ]);
        }

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
