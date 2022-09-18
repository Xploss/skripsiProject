<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\User;
use Auth;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $mahasiswa = Mahasiswa::paginate(25);

        $halaman = 'mahasiswa';
        //return view('mahasiswa.index', compact('mahasiswa','halaman'));

        /*$prediksi = array();

        foreach($mahasiswa as $ms){
            $client = Http::withBasicAuth('admin','94k0z4007')->get('http://desktop-qo1l6ph:8080/api/rest/process/procTrain?nim='. $ms->nim)->json();
            $prediksi[] = $client[0]['prediction(diterimaBulanStlhLulus)'];
        }*/
        //$client = Http::withBasicAuth('admin','94k0z4007')->get('http://desktop-qo1l6ph:8080/api/rest/process/procTrainList?')->json();
        
        //$prediksi = $client[0]['prediction(diterimaBulanStlhLulus)'];
        //echo $prediksi;
        return view('mahasiswa.index', compact(['mahasiswa','halaman']));
    }

    public function export() 
    {
        return Excel::download(new MahasiswaExport, 'prediksiMasaTungguKerja.xlsx');
    }
    public function cari(Request $request)
    {
        $halaman = 'mahasiswa';
        $search = trim($request->input('search'));
        $prediksi = trim($request->input('prediksi'));
        $fakultas = trim($request->input('fakultas'));
        $namaAtauNim = trim($request->input('namaAtauNim'));
        if (! empty($search)) {
            $this->validate($request, [
                'namaAtauNim' => 'required'
            ]);

            $query = Mahasiswa::where($namaAtauNim, 'LIKE', '%' . $search . '%');
            (! empty($prediksi)) ? $query->where('prediksi', $prediksi ) : '';
            (! empty($fakultas)) ? $query->where('fakultas', $fakultas ) : '';
            $mahasiswa = $query->paginate(25);
            $paging = (! empty($prediksi)) ? $mahasiswa->appends(['prediksi' => $prediksi]) : '';
            $paging = (! empty($fakultas)) ? $mahasiswa->appends(['fakultas' => $fakultas]) : '';
            $paging = (! empty($namaAtauNim)) ? $mahasiswa->appends(['namaAtauNim' => $namaAtauNim]) : '';
            $paging = (! empty($search)) ? $mahasiswa->appends(['search' => $search]) : '';
            $cek = false;
            $page = true;
            return view('mahasiswa.index', compact('halaman','mahasiswa', 'cek','page', 'search', 'namaAtauNim', 'fakultas', 'prediksi'));
        }
        if (! empty($prediksi) && ! empty($fakultas)) {
            $query = Mahasiswa::where([
                ['prediksi', $prediksi],
                ['fakultas', $fakultas]
            ] );
            $mahasiswa = $query->paginate(25);
            $paging = (! empty($prediksi)) ? $mahasiswa->appends(['prediksi' => $prediksi]) : '';
            $paging = (! empty($fakultas)) ? $mahasiswa->appends(['fakultas' => $fakultas]) : '';
            $cek = false;
            $page = true;
            return view('mahasiswa.index', compact('halaman','mahasiswa', 'cek','page', 'search', 'namaAtauNim', 'fakultas', 'prediksi'));
        }
        if (! empty($prediksi)) {
            $query = Mahasiswa::where('prediksi', $prediksi);
            $mahasiswa = $query->paginate(25);
            $paging = (! empty($prediksi)) ? $mahasiswa->appends(['prediksi' => $prediksi]) : '';
            $cek = false;
            $page = true;
            return view('mahasiswa.index', compact('halaman','mahasiswa', 'cek','page', 'search', 'namaAtauNim', 'fakultas', 'prediksi'));
        }
        if (! empty($fakultas)) {
            $query = Mahasiswa::where('fakultas', $fakultas);
            $mahasiswa = $query->paginate(25);
            $paging = (! empty($fakultas)) ? $mahasiswa->appends(['fakultas' => $fakultas]) : '';
            $cek = false;
            $page = true;
            return view('mahasiswa.index', compact('halaman','mahasiswa', 'cek','page', 'search', 'namaAtauNim', 'fakultas', 'prediksi'));
        }
        return redirect('mahasiswa');
       }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $halaman = 'mahasiswa';
        return view('mahasiswa.create', compact('halaman'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $halaman = 'mahasiswa';
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

        if($validator->fails()){
            return redirect('mahasiswa/create')
                ->withInput()
                ->withErrors($validator);
        }
        
        Mahasiswa::Create($request->all());

        return redirect('mahasiswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $halaman = 'mahasiswa';

        return view('mahasiswa.show', compact('mahasiswa','halaman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($mahasiswa)
    {
        $halaman = 'mahasiswa'; 
        
        return view('mahasiswa.edit', compact('mahasiswa','halaman'));
    }
        
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Mahasiswa $mahasiswa, $request)
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

        if($validator->fails()){
            return redirect('mahasiswa/edit')
                ->withInput()
                ->withErrors($validator);
        }

        $mahasiswa->update($request->all());
        return redirect('mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect('mahasiswa');
    }
}
