<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;    
use Validator;
use App\Mahasiswa;
use App\User;
use Auth;
use Illuminate\Support\Facades\Http;

class PrediksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('mahasiswa');
    }
    public function index()
    {
        $halaman = 'prediksi'; 

        $mahasiswa = Mahasiswa::firstWhere('nim',Auth::user()->nim);
        
        if (!$mahasiswa) {
            return $this->create();
        }

        return view('prediksi.index', compact('mahasiswa','halaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $halaman = 'prediksi';

        $mahasiswa = User::where('nim',Auth::user()->nim)->first();
        return view('prediksi.create', compact('halaman','mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$halaman = 'mahasiswa';

        //$request->ipk = str_replace(',', '.', $request->ipk);
        if ($request->ipk <= 2.75) {
            $request->merge(['ipkPredikat' => 'Memuaskan']);
        } elseif ($request->ipk <= 3.5) {
            $request->merge(['ipkPredikat' => 'Sangat Memuaskan']);
        } else {
            $request->merge(['ipkPredikat' => 'Pujian']);
            //$request->ipkPredikat = "Pujian";
        }

        $validator = Validator::make($request->all(),[
            'ipk'   =>  'required|numeric|between:2,4.00',
            'kemampuanBahasaInggris'    =>  'required',
            'pengetahuanDiluarBidang'   =>  'required',
            'keterampilanKomputer'      =>  'required',
            'pengalamanMagang'          =>  'required',
            'jenisPekerjaan'            =>  'required',
        ]);

        if($validator->fails()){
            return redirect('prediksi/create')
                ->withInput()
                ->withErrors($validator);
        }
        Mahasiswa::Create($request->all());

        $mahasiswa = Mahasiswa::firstWhere('nim',Auth::user()->nim);

        $client = Http::withBasicAuth('admin','94k0z4007')->get('http://desktop-qo1l6ph:8080/api/rest/process/procTrain?nim='. $mahasiswa->nim)->json();
        
        $prediksi = $client[0]['prediction(diterimaBulanStlhLulus)'];

        $mahasiswa->prediksi = $prediksi;

        $mahasiswa->save();
        
		Session::flash('flash_message','Data Prediksi Berhasil Disimpan');
        //Mahasiswa::Create($request->all());

        return redirect('prediksi');
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
    public function edit($mahasiswa)
    {
        $halaman = 'prediksi'; 

        $mahasiswa = Mahasiswa::firstWhere('nim',Auth::user()->nim);
        
        return view('prediksi.edit', compact('mahasiswa','halaman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        if ($request->ipk <= 2.75) {
            $request->merge(['ipkPredikat' => 'Memuaskan']);
        } elseif ($request->ipk <= 3.5) {
            $request->merge(['ipkPredikat' => 'Sangat Memuaskan']);
        } else {
            $request->merge(['ipkPredikat' => 'Pujian']);
            //$request->ipkPredikat = "Pujian";
        }

        $validator = Validator::make($request->all(),[
            'ipk'   =>  'required|numeric|between:1,4.00',
            'kemampuanBahasaInggris'    =>  'required',
            'pengetahuanDiluarBidang'   =>  'required',
            'keterampilanKomputer'      =>  'required',
            'pengalamanMagang'          =>  'required',
            'jenisPekerjaan'            =>  'required',
        ]);

        $data = Mahasiswa::firstWhere('nim',Auth::user()->nim);
        if($validator->fails()){
            return redirect('prediksi/'.$data->nim.'/edit')
                ->withInput()
                ->withErrors($validator);
        }
        $data->update($request->all());

        $client = Http::withBasicAuth('admin','94k0z4007')->get('http://desktop-qo1l6ph:8080/api/rest/process/procTrain?nim='. Auth::user()->nim)->json();
        
        $prediksi = $client[0]['prediction(diterimaBulanStlhLulus)'];

        $data->prediksi = $prediksi;

        $data->save();
		Session::flash('flash_message','Data Prediksi Berhasil Disimpan');
        return redirect('prediksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
