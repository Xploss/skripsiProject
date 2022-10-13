<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NamaDataset extends Model
{
    protected $table = "namadataset";

    protected $fillable = ["namaData", "akurasi", "deviasi"];
    /**
     * Get all of the dataset f NamaDataset
     *
     * @return \Illuminate\App\Dataset\Haid_dataset
     */
    public function dataset()
    {
        return $this->hasMany('App\Dataset', 'id_dataset');
    }
}
