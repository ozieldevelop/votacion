<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sistema\Entities\eventoModel;
use Modules\Sistema\Entities\aspiranteModel;
use Modules\Sistema\Entities\votantesModel;
use Modules\Sistema\Entities\votosModel;
use Modules\Sistema\Entities\vtaspiranteModel;
use Modules\Cliente\Entities\files_up_Model;
use App\Services\GeneralHelper;
use App\Models\Votantes;
use Modules\Cliente\Entities\adjuntos_Model;
use DB;
use Auth;
use Illuminate\Contracts\Session\Session;
use Config;
use Illuminate\Support\Facades\Mail;
use Validator;
use Storage;
use Response;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

//Use Model ornde de la palabra
use Modules\Cliente\Entities\TemasOrden;
use Modules\Cliente\Entities\TemasSuscriptores;
use Modules\Cliente\Entities\ViewSuscriptores;
use Modules\Cliente\Entities\TimeTrack;


class OrdenPalabraController extends Controller
{

    public function index()
    {
        return view('cliente::ordenpalabra.dashboard');
    }

    public function create(){

        $items = TemasOrden::orderby('order', 'asc')->get();

        $tema = new TemasOrden;
        $tema = $tema->getHTML($items);

        return view('cliente::ordenpalabra.create', compact('tema', 'items'));
    }

    public function store(Request $request){

        try {
            $tema = new TemasOrden;
        
            $tema->titulo = $request->titulo;
            $tema->slug = Str::slug($tema->titulo, '-');
            $tema->order = TemasOrden::max('order')+1;

            $tema->created_at = Carbon::parse()->now();
            $tema->touch();
            //Save
            $tema->save();
            
            return redirect()->route('orden.create')->with('created', 'El Tema: '.$tema->titulo.' - Se ha creado el tema correctamente');

        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Tema Duplicado');
        }        
    }

    public function postIndex(Request $request){

        $source = $request->source;
        $destination = $request->destination;
        
        //Busca por ID
        $item = TemasOrden::find($source);
        
        $item->parent_id = $destination;
        $item->created_at = DB::raw('created_at');
        $item->updated_at = Carbon::parse()->now();
        $item->touch();

        //Save
        $item->save();
        
        $ordering = json_decode($request->order);
        $rootOrdering = json_decode($request->rootOrder);
        
        
        if($ordering){
            foreach($ordering as $order => $item_id){
                if($itemToOrder = TemasOrden::find($item_id)){
                    $itemToOrder->order = $order;
                    $itemToOrder->save();
                }
            }
        }
        else {
            foreach($rootOrdering as $order => $item_id){
                if($itemToOrder = TemasOrden::find($item_id)){
                    $itemToOrder->order = $order;
                    $itemToOrder->save();
                }
            }
        }
        return 'Se ha guardado Correctamente';
    }

    public function postEdit(Request $request){

        $id = $request->id;
        
        $item = TemasOrden::find($id);
        $item = TemasOrden::where('id', $id)->first();
        $item->titulo = $request->titulo;
        $item->slug = Str::slug($item->titulo, '-');
        $item->parent_id = $request->parent_id;
        $item->created_at = DB::raw('created_at');
        $item->updated_at = Carbon::parse()->now();
        $item->touch();
        $item->save();
        
        return redirect()->route('orden.create')->with('updated', 'El Tema: '. $item->titulo.' - ha sido actualizado');
    }

    public function postDelete(Request $request){

        $id = $request->id;
        $items = TemasOrden::where('parent_id', $id)->get()->each(function($item){
            $item->parent_id = '';
            $item->save();
        });

        $item = TemasOrden::findOrFail($id);
        $item->delete();
        return redirect()->route('orden.create')->with('deleted', 'El Tema: '. $item->titulo.' - ha sido Eliminado');
    }

    public function suscriptoresHome(){

        $items = TemasOrden::orderby('order', 'asc')->get();
        
        //Get a clientes 
        $datacliente = DB::table('data_clientes')->get();

        $tema = new TemasOrden;
        $tema = $tema->getHTML($items, 1);

        return view('cliente::ordenpalabra.suscriptores', compact('tema', 'items', 'datacliente'));
    }

    public function suscriptoresAdd(Request $request){

        $suscriptores = $request->suscriptores;
        $subrel = new TemasSuscriptores;
        
        try {
            foreach($suscriptores as $cldoc){
                $data = [
                    'parent_id' => $request->id,
                    'children_id' => $request->parent_id,
                    'cldoc' => $cldoc
                ];
                $subrel->insert($data);
            }

            $message = redirect()->route('orden.suscriptores')->with('created', 'Se ha guardado correctamente');
        } catch (QueryException $e) {
            $message = redirect()->back()->with('error', 'No se puede agregar varias veces al mismo tema');
        }
        
        return $message;
    }

    public function suscriptoresDelete(Request $request, $subsId){

        $item = TemasSuscriptores::findOrFail($subsId);
        $item->delete();

        return redirect()->route('orden.suscriptores')->with('deleted', 'Eliminado correctamente');
    }

    public function trackTime(Request $request, $subsId, $cldocId){

        //Obtengo los id de la subscripcion
        $datasubs = TemasSuscriptores::where('id', $subsId)
                    ->where('cldoc', $cldocId)
                    ->first();

        //Procedo a verificar que metodo se utilizo -> Route::any();
        switch ($request->method()) {
            
            case 'POST':

                $tracking = new TimeTrack;
                $tracking->id_subs = $datasubs['id'];
                $tracking->id_tema = $subsId;
                $tracking->parent_id = $datasubs['children_id'];
                $tracking->cldoc = $datasubs['cldoc'];
                $tracking->duracion = $request->duracion;
                $tracking->save();

                $request->session()->flush();

                //Establece las sessiones
                $request->session()->put('duracion', $request->duracion);
                $request->session()->put('start_time', date('Y-m-d H:i:s'));

                $end_time = date('Y-m-d H:i:s', strtotime('+'.session()->get('duracion').'minutes', strtotime(session()->get('start_time') ) ) );

                $request->session()->put('end_time', $end_time);
        
                return redirect()->route('orden.suscriptores.tiempo', [ $datasubs['id'], $datasubs['cldoc'] ]);
            break;
            
            case 'GET':

                //Set End Time
                //$sEndTime = null;

                //Obtener el tiempo mas actual
                $datatrack = TimeTrack::where('id_subs', $subsId)->where('cldoc', $cldocId)->orderBy('id', 'DESC')->take(1)->first();

                if($datatrack){
                    
                    //Obtengo la duracion
                    $duracion = $datatrack['duracion'];
                    $sEndTime = (session()->has('end_time')) ? session()->get('end_time'): null;
                }
                else {
                    $sEndTime = null;
                }
            break;
        }

        //return $datasubs;
        return view('cliente::ordenpalabra.tracktime', compact('subsId', 'cldocId', 'sEndTime'));
    }

    public function trakingTime(Request $request){

        $form_time = date('Y-m-d H:i:s');
        $to_time = $request->end_time;

        $timefirst = strtotime($form_time);
        $timesecond = strtotime($to_time);

        $diferenceinseconds = $timesecond-$timefirst + 3;

        if($diferenceinseconds < 0){
            //$request->session()->flush();
            $gmdate = '00:00:00';
        }else{
            $gmdate = gmdate('H:i:s', $diferenceinseconds);
        }

        return $gmdate;
    }
}
