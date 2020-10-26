<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlantsModel;
use Storage;
use Illuminate\Support\Facades\Auth;

class PlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response() -> json([
            'plants' => PlantsModel::where('del', '0')->get(),
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
            ($request->post('image') != '' || $request->hasFile('image')))
            {
                $plant = new PlantsModel();
                $plant->name = $request->post('name');
                $plant->del = '0';
                if($request->hasFile('image'))
                {
                    $path = $request->file('image')->store('img/plants', 'public');
                    $url = explode('/', $path);
                    $plant->image = $url[2];
                }
                else
                {
                    $content = file_get_contents($request->post('image'));
                    $name = basename($request->post('image'));
                    Storage::put('\public\img\plants\\'.$name, $content);
                    $plant->image = $name;
                }

                $plant->save();
                return response() -> json([
                    'plant' => $plant
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
            if($request->post('name') != '')
            {
                $message;
                $plant = PlantsModel::where('id', $id)->first();
                $plant->name = $request->post('name');
                $plant->del = '0';
                if($request->hasFile('image'))
                {
                    $path = $request->file('image')->store('img/plants', 'public');
                    $url = explode('/', $path);
                    $plant->image = $url[2];
                }
                if($request->post('image') != 0)
                {
                        $content = file_get_contents($request->post('image'));
                        $name = basename($request->post('image'));
                        Storage::put('\public\img\plants\\'.$name, $content);
                        $plant->image = $name;
                }

                $plant->save();
                return response() -> json([
                    'plant' => $plant,
                ]);
            }
            else
            {
                return response() -> json([
                    'message' => "Не удалось обновить объект, проверте правильность введённых данных"
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
            $plant = PlantsModel::where('id', $request->id)->first();
            $plant->del = 0;
            $plant->save();
            return true;
        }
    }


    public function destroy($id)
    {
        if(Auth::check())
        {
            $plant = PlantsModel::where('id', $id)->first();
            $plant->del = 1;
            $plant->save();
            return true;
        }
    }
}
