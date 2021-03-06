<?php

namespace App\Exports;

use App\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengaduanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'mesin_id',
            'lokasi_id',
            'user_id',
            'foto',
            'status',
            'keterangan',
        ];
    }
    public function collection()
    {
        return Pengaduan::query()->get(['mesin_id', 'lokasi_id', 'user_id', 'foto', 'status', 'keterangan']);
    }
}
