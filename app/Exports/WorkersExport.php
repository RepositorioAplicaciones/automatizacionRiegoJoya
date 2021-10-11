<?php

namespace App\Exports;

use App\Models\Worker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

//Exporta un archivo excel, segun el modelo escogido

class WorkersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Worker::all();
    }

    public function headings(): array
    {
        return ["id", "name", "age", "sex", "DNI", "area_id", "roster_id", "fecha_subida", "fecha_bajada", "created_at", "updated_at",];
    }
    
}
