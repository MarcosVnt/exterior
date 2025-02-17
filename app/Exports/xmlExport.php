<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;


class xmlExport implements FromArray,WithHeadings
{
    protected $invoices;

    public function __construct(array $invoices)
    {
       //dd($invoices[0]);
        $this->invoices = $invoices[0];
    }

    public function array(): array
    {
        return $this->invoices;
    }

    public function headings(): array
    {
        return [
            'Codigo Proveedor',
            'Nombre Fiscal - Comercial',
            'Codigo Articulo',
            'Descripcion Articulo',
            'Ancho',
            'Longitud',
            'm2',
            'precio',
            'unidad',
            'dto',
            'Precio FInal',
            'Notas',
            'Coste Unitario',
            'Fecha',
            'NºDocumento',
            'Oferta',
            'compos',
            'Tipo Unidad',
            'Precio Compra',
            'serie'

        ];
    }
}