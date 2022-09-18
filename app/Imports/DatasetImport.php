<?php

namespace App\Imports;

use App\Dataset;
use App\NamaDataset;
use Maatwebsite\Excel\Concerns\ToModel;

class DatasetImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $row['id_data'] = NamaDataset::orderBy('created_at', 'DESC')->first()->id;
        return new Dataset([
            'id_dataset' => $row['id_data'],
            'diterimaBulanStlhLulus' => $row[0],
            'nim' => $row[1], 
            'nama' => $row[2],
            'jenisKelamin' => $row[3],
            'ipkPredikat' => $row[4],
            'fakultas' => $row[5], 
            'kemampuanBahasaInggris' => $row[6], 
            'pengetahuanDiluarBidang' => $row[7],  
            'keterampilanKomputer' => $row[8],
            'pengalamanMagang' => $row[9], 
            'jenisPekerjaan'  => $row[10]
        ]);
    }
}
