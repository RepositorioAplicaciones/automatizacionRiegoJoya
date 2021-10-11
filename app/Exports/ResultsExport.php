<?php

namespace App\Exports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

//Exporta un archivo excel, segun el modelo escogido

class ResultsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Result::all();
    }

    public function headings(): array
    {
        return ["id", "worker_id", "oxygen_saturation", "temperature", "date", "created_at", "updated_at", ];
    }
}
