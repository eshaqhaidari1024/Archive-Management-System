<?php

namespace App\Imports;
use App\Models\CreateLetter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CreateLetterImport implements ToCollection,ToModel,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }

    public function model(array $row)
    {

        return new CreateLetter([
            'name'=>$row['name'],
            'last_name'=>$row['last_name'],

        ]);
    }
}
