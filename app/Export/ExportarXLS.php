<?php

namespace App\Export;

use Maatwebsite\Excel\Concerns\FromArray;

class ExportarXLS implements FromArray
{

    protected $rows;
  
    public function __construct($objeto)
    {
       $this->rows = $objeto;
       // dd($objeto);
    }

    public function array():array
    {
       return $this->rows;
    }
}


?>