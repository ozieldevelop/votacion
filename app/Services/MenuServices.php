<?php
namespace App\Services;
use Auth;
use DB;
class MenuServices {

  private $menuData = array(
    'items' => array(),
    'parents' => array()
  );

  public function __construct(  ){
    // $menu = $this->getMenu($rol);
	//ddd("eds");

    $this->menuArray();
  }


  /**
   * @param $menu
   * Recorre el resultado de la bd y llena el arreglo $menuData
   */
  private function menuArray(){
    $modules = DB::select('SELECT * FROM vt_menu_rol WHERE user_id = ? GROUP BY module_id', [ Auth::user()->id ]);
	//
    //$roles = Auth::user()->roles;
    $data = DB::select('SELECT * FROM vt_menu_rol WHERE user_id = 1  GROUP BY permission_id ', [Auth::user()->id]);
    // dd($data);
    $tmpModule = null;
    $tmpMenu = null;
    $current_menu = "";

    foreach ($modules as $key => $module) {
      $tmpModule = (array)$module;
      
      foreach ($data as $menu_key => $val) {
        if($module->module_id === $val->module_id){
          if($val->slave_id === "0"){
            $tmpModule['menu'][$menu_key] = (array)$val;
            $current_menu = $menu_key;
          } else {
            $tmpModule['menu'][$current_menu]['submenu'][] = (array)$val;
          }
        }
      }
      $tmpMenu[] = $tmpModule;
    }

    return $tmpMenu;
  }

  /**
     * @param $parentId
     * @param $menuData
     * @return string
     * Construye el menu en html
     */
    private function generaMenu($menuData)
    {
      try {
        $html = "";
        if(count($menuData)>0){
        foreach ($menuData as $key => $module) {
          // Parte inicial del menu
          // $html .= '<li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href="#"><i class="' . $module['icon'] . '"></i>' . $module['module_name'] . '</a>';
		  $html .= '<li class="has-submenu"><a href="#"><i class="' . $module['icon'] . '"></i> ' . $module['module_name'] . ' <i class="mdi mdi-chevron-down mdi-drop"></i></a>';
		  // Si es modulo accede

            //dd($module);


							
            if(isset($module['menu'])){
              // crea estructura inicial del menu
              //$html .='<ul class="nav-dropdown-items">';
              // se recorren los menu
              foreach ($module['menu'] as $subkey => $menu) {
				
                // si tiene un submenu
                if(isset($menu['submenu'])){
				 //dd($menu['submenu'][0]);
                  //$html .= '<li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href="'. url($menu['submenu'][0]['route']) .'"><i class="icon-arrow-right "></i>'. $menu['submenu'][0]['permission_name'] .'</a>';

                  $html .='<ul class="submenu megamenu"><li><ul>';
                  foreach ($menu['submenu'] as $subkey => $submenu) {
                    //$html .= '<li class="nav-item"><a class="nav-link" href="'. url($submenu['route']) .'">    <i class="fa fa-circle"></i>'. $submenu['permission_name'] .'</a></li>';
					$html .= '<li><a href="'. url($submenu['route']) .'">'. $submenu['permission_name'] .'</a></li>';
                  }
                  $html .= '</ul>';
                } else {
                  //$html .= '<li class="nav-item"><a class="nav-link" href="'. url($menu['route']) .'"><i class="icon-arrow-right "></i>'. $menu['permission_name'] .'</a></li>';
                }
                $html .= '</li>';
              }
              $html .= '</ul>';
            }
          $html .= '</li>';
        }
        }
      } catch (\Exception $e) {
        dd($e);
      }


      // print '<code>'. htmlspecialchars($html) .'</code>';
      // die();
      return $html;
    }

    public function gen($pId){
        return $this->generaMenu($pId, $this->menuData);
    }

    public function init()
    {
      //
      return $this->generaMenu($this->menuArray());
    }


}