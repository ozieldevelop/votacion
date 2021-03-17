<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Cliente\Entities\Propuesta;

class PropuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Propuesta::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $propuesta = new Propuesta;

        $propuesta->titulo          = $request->propuesta["titulo"];
        $propuesta->detalle         = $request->propuesta["detalle"];
        $propuesta->user_id         = $request->propuesta["user_id"];
        $propuesta->user_name       = $request->propuesta['user_name'];
        $propuesta->secunda_asoc    = $request->propuesta["secunda_asoc"];
        $propuesta->secunda_id      = $request->propuesta["secunda_asoc_id"];

        $propuesta->save();

        return response()->json($propuesta, 201);
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
        $propuesta = Propuesta::findOrFail($id);
        
        if ($request->exists('estado')) {
            
            $propuesta->estado = $request->estado;
        }

        if($request->exists('like')) {
            $request->like == 1 ? $propuesta->aprovaciones += 1 : $propuesta->desaprovaciones += 1;
        } 

        $propuesta->save();

        return response()->json($propuesta, 200);        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propuesta = Propuesta::findOrFail($id);

        if ($propuesta->delete()) {
            return response()->json("Propuesta Eliminada!", 200);
        }
    }
}
