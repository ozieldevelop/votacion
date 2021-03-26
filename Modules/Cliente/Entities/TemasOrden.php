<?php

namespace Modules\Cliente\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Cliente\Entities\ViewSuscriptores;

class TemasOrden extends Model
{
    use HasFactory;

    protected $fillable = [ 'id', 'titulo', 'slug', 'parent_id', 'order'];
    protected $table = 'ordp_temas';

    public $timestamps = false;

    /**
     * [buildMenu construye el html]
     *
     * @method    buildMenu
     *
    */
    public function buildTema($tema, $parentid = 0)
    { 
        
        $result = null;
      
        foreach ($tema as $item) {
            
            if ($item->parent_id === $parentid) { 
                $result .= "
                <li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
                <div class='dd-handle nested-list-handle'>
                    <span class='glyphicon glyphicon-move'></span>
                </div>
                <div class='nested-list-content'>
                    {$item->titulo}
                    <div class='pull-right'>
                        <a href='#editModal' class='label label-primary nt-15 edit_toggle' data-toggle='modal' rel='{$item}'>
                            Editar <i class='fa fa-edit' aria-hidden='true'></i>
                            </a>
                        </a> |
                        <a href='#deleteModal' class='label label-danger nt-15 delete_toggle' data-toggle='modal' rel='{$item->id}'>
                            <span class='label label-danger nt-15'>Eliminar  <i class='fa fa-trash' aria-hidden='true'></i></span>
                        </a>
                    </div>
                </div>".$this->buildTema($tema, $item->id) . "</li>"; 
            }
        }
        return $result  ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
    }

    public function buildTemaSuscriptores($tema, $parentid = 0)
    { 
        
        $result = null;

        foreach ($tema as $item) {

            
            //orderby('id_suscriptor', 'asc')->get();
            
            if ($item->parent_id === $parentid) { 
                
                $result .= "
                <li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
                    <div class='dd-handle nested-list-handle'>
                        <span class='glyphicon glyphicon-move'></span>
                    </div>
                    <div class='nested-list-content'>
                        {$item->titulo}
                        <div class='pull-right'>
                            <a href='#editModal' class='label label-success nt-15 edit_toggle' data-toggle='modal' rel='{$item}'>
                                Agregar suscriptores <i class='fa fa-edit' aria-hidden='true'></i>
                                </a>
                            </a>
                        </div>
                    </div><!-- Poner aqui -->";
                    if($items_subs = ViewSuscriptores::where('id_tema', $item->id)->get() ){

                        foreach ($items_subs as $itemsub) {
                            $result .="
                
                                <li class='dd-item nested-list-item' data-order='{}' data-id='$itemsub->id_suscriptor'>
                                    <div class='nested-list-content-subscriptores'>
                                        $itemsub->CLDOC - $itemsub->NOMBRE

                                        <div class='pull-right'>
                                            <a href='".route('orden.suscriptores.tiempo', [$itemsub->id_suscriptor, $itemsub->CLDOC])."' class='label label-warning nt-15'>
                                                Tiempo <i class='fa fa-clock-o'></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            ";//url('ordenpab/suscriptores/tiempo/'.$itemsub->id_suscriptor.'/'.$itemsub->CLDOC)
                        }
                    }
                    $result .= $this->buildTemaSuscriptores($tema, $item->id).
                "</li>"; 
            }
        }
        return $result  ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
    }

    /**
     * [getHTML obtiene el html de la funcion buildTema()]
     *
     * @method    getHTML
     */
    public function getHTML($items, $change = 0){

        return ($change != 0) ? $this->buildTemaSuscriptores($items) : $this->buildTema($items);
    }

    protected static function newFactory()
    {
        return \Modules\Cliente\Database\factories\TemasOrdenFactory::new();
    }
}
