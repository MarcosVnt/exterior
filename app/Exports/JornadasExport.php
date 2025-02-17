<?php

namespace App\Exports;

use App\Jornada;
use Maatwebsite\Excel\Concerns\FromCollection;

class JornadasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Jornada::all();
    }
}
