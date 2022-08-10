<?php

namespace App\Exports;

use App\Models\CreateLetter;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CreateLetterExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{

        return [

            'نام',
            'فامیلی',
        ];
    }


    public function collection()
    {
        return  DB::table('letter')->select('name','last_name')->get();


    }


}
