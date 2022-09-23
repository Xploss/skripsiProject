<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dataset;
use App\NamaDataset;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DatasetImport;
use Illuminate\Support\Facades\Http;
use Session;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataset = Dataset::select('id_dataset',)
                        ->selectRaw('SUM(CASE WHEN diterimaBulanStlhLulus="Cepat" THEN 1 ELSE 0 END) AS cepat, SUM(CASE WHEN diterimaBulanStlhLulus="Lama" THEN 1 ELSE 0 END) AS lama')
                        ->groupBy('id_dataset')
                        ->orderBy('id_dataset','DESC')
                        ->get();

        $value = array();
        $deviasi = array();
        foreach($dataset as $data){
            $client = Http::withBasicAuth('admin','94k0z4007')->get('http://DESKTOP-QO1L6PH:8080/api/rest/process/performaDataset?id_dataset='. $data->id_dataset)->json();
            $value[] = round($client['Value']*100,2);
            $deviasi[] = round($client['Standard Deviation']*100,2);
        }

        $client = Http::withBasicAuth('admin','94k0z4007')->get('http://DESKTOP-QO1L6PH:8080/api/rest/process/performanceData?')->json();
        $valueTraining = round($client['Value']*100,2);
        $deviasiTraining = round($client['Standard Deviation']*100,2);

        return view('dataset.index', compact('dataset', 'value', 'deviasi', 'valueTraining', 'deviasiTraining'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo NamaDataset::orderBy('created_at', 'DESC')->first()->id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function import_excel(Request $request)
    {
        // validasi
		$this->validate($request, [
            'namaData' => 'required',
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
        //echo "hai";
		// menangkap file excel

        
		$file = $request->file('file');
        NamaDataset::Create(['namaData' => $file->getClientOriginalName()]);
        //NamaDataset::Create(['namaData' => $request->namaData]);

		// membuat nama file unik
		/*$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_training',$nama_file);*/
 
		// import data
		//Excel::import(new TrainingImport, public_path('/file_training/'.$nama_file));
        Excel::import(new DatasetImport, $file);
		// notifikasi dengan session
		Session::flash('flash_message','Data Training Berhasil Diimport');
 
		// alihkan halaman kembali
		return redirect('training');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataset = NamaDataset::findOrFail($id);
        $dataset->delete();
        return redirect('dataset');
    }
}
