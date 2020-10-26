<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SliderModel;
use Storage;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response() -> json([
            'slider' => SliderModel::where('del', '0')->orderBy('id', 'asc')->get()
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
        if(Auth::check())
        {
            if($request->post('name') != '' && 
            $request->post('description') != '' &&
            ($request->post('image') != '' || $request->hasFile('image')))
            {
                $slide = new SliderModel();
                $slide->name = $request->post('name');
                $slide->description = $request->post('description');
                $slide->del = '0';
                if($request->hasFile('image'))
                {
                    $path = $request->file('image')->store('img/sider', 'public');
                    $url = explode('/', $path);
                    $slide->image = $url[2];
                }
                else
                {
                    $content = file_get_contents($request->post('image'));
                    $name = basename($request->post('image'));
                    Storage::put('\public\img\sider\\'.$name, $content);
                    $slide->image = $name;
                }

                $slide->save();
                return response() -> json([
                    'slider' => $slide
                ]);
            }
            else
            {
                return response() -> json([
                    'message' => "Не удалось сгенерировать объект, проверте правильность введённых данных"
                ]);
            }
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
            $message;
            if($request->post('name') != '' && 
            $request->post('description') != '')
            {
                $slide = SliderModel::where('id', $id)->first();
                $slide->name = $request->post('name');
                $slide->description = $request->post('description');
                $slide->del = '0';
                if($request->hasFile('image'))
                {
                    $path = $request->file('image')->store('img/sider', 'public');
                    $url = explode('/', $path);
                    $slide->image = $url[2];
                }
                if($request->post('image') != '')
                {
                    // try
                    // {
                        $content = file_get_contents($request->post('image'));
                        $name = basename($request->post('image'));
                        Storage::put('\public\img\sider\\'.$name, $content);
                        $slide->image = $name;
                    // }
                    // catch(Exception $e)
                    // {
                    //     $message = $e;
                    // }
                    
                }

                $slide->save();
                return response() -> json([
                    'slider' => $slide,
                ]);
            }
            else
            {
                return response() -> json([
                    'message' => "Не удалось сгенерировать объект, проверте правильность введённых данных"
                ]);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request)
    {
        if(Auth::check())
        {
            $slide = SliderModel::where('id', $request->id)->first();
            $slide->del = 0;
            $slide->save();
        }
    }

    public function destroy($id)
    {
        if(Auth::check())
        {
            $slide = SliderModel::where('id', $id)->first();
            $slide->del = 1;
            $slide->save();
        }
    }
}
