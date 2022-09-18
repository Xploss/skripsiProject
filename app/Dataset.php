<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $table = "dataset";

    protected $fillable = [
        'id_dataset',
        'diterimaBulanStlhLulus',
        'nim', 
        'nama',
        'jenisKelamin',
        'ipkPredikat',
        'fakultas', 
        'kemampuanBahasaInggris', 
        'pengetahuanDiluarBidang',  
        'keterampilanKomputer',
        'pengalamanMagang', 
        'jenisPekerjaan'];

    public function namaDataset()
    {
        return $this->belongsTo('App\NamaDataset', 'id_dataset');
    }
}
