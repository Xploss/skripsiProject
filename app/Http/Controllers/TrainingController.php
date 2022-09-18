<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use Session;
use DB;
use Illuminate\Support\Facades\Storage; 
use App\Imports\TrainingImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Filesystem\Filesystem;
use Validator;


class TrainingController extends Controller
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
        $halaman = 'training';
        $training = Training::paginate(25);

        $bar = Training::select('fakultas')
                        ->selectRaw('SUM(CASE WHEN diterimaBulanStlhLulus="Cepat" THEN 1 ELSE 0 END) AS Cepat, SUM(CASE WHEN diterimaBulanStlhLulus="Lama" THEN 1 ELSE 0 END) AS Lama')
                        ->groupBy('fakultas')
                        ->get();

        if ($training->isEmpty()) {
            $cek = $training->isEmpty();
        }else{
            $cek = false;
        }
        
        $page = true;
        return view('training.index', compact('halaman','training', 'cek','page', 'bar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function cari(Request $request)
    {
        $halaman = 'training';
        $bar = Training::select('fakultas')
                        ->selectRaw('SUM(CASE WHEN diterimaBulanStlhLulus="Cepat" THEN 1 ELSE 0 END) AS Cepat, SUM(CASE WHEN diterimaBulanStlhLulus="Lama" THEN 1 ELSE 0 END) AS Lama')
                        ->groupBy('fakultas')
                        ->get();
        $search = trim($request->input('search'));
        $masaTunggu = trim($request->input('masaTunggu'));
        $fakultas = trim($request->input('fakultas'));
        $namaAtauNim = trim($request->input('namaAtauNim'));
        if (! empty($search)) {
            $this->validate($request, [
                'namaAtauNim' => 'required'
            ]);

            $query = Training::where($namaAtauNim, 'LIKE', '%' . $search . '%');
            (! empty($masaTunggu)) ? $query->where('diterimaBulanStlhLulus', $masaTunggu ) : '';
            (! empty($fakultas)) ? $query->where('fakultas', $fakultas ) : '';
            $training = $query->paginate(25);
            $paging = (! empty($masaTunggu)) ? $training->appends(['masaTunggu' => $masaTunggu]) : '';
            $paging = (! empty($fakultas)) ? $training->appends(['fakultas' => $fakultas]) : '';
            $paging = (! empty($namaAtauNim)) ? $training->appends(['namaAtauNim' => $namaAtauNim]) : '';
            $paging = (! empty($search)) ? $training->appends(['search' => $search]) : '';
            $cek = false;
            $page = true;
            return view('training.index', compact('halaman','training', 'cek','page', 'search', 'namaAtauNim', 'fakultas', 'masaTunggu', 'bar'));
        }
        if (! empty($masaTunggu) && ! empty($fakultas)) {
            $query = Training::where([
                ['diterimaBulanStlhLulus', $masaTunggu],
                ['fakultas', $fakultas]
            ] );
            $training = $query->paginate(25);
            $paging = (! empty($masaTunggu)) ? $training->appends(['masaTunggu' => $masaTunggu]) : '';
            $paging = (! empty($fakultas)) ? $training->appends(['fakultas' => $fakultas]) : '';
            $cek = false;
            $page = true;
            return view('training.index', compact('halaman','training', 'cek','page', 'search', 'namaAtauNim', 'fakultas', 'masaTunggu', 'bar'));
        }
        if (! empty($masaTunggu)) {
            $query = Training::where('diterimaBulanStlhLulus', $masaTunggu);
            $training = $query->paginate(25);
            $paging = (! empty($masaTunggu)) ? $training->appends(['masaTunggu' => $masaTunggu]) : '';
            $cek = false;
            $page = true;
            return view('training.index', compact('halaman','training', 'cek','page', 'search', 'namaAtauNim', 'fakultas', 'masaTunggu', 'bar'));
        }
        if (! empty($fakultas)) {
            $query = Training::where('fakultas', $fakultas);
            $training = $query->paginate(25);
            $paging = (! empty($fakultas)) ? $training->appends(['fakultas' => $fakultas]) : '';
            $cek = false;
            $page = true;
            return view('training.index', compact('halaman','training', 'cek','page', 'search', 'namaAtauNim', 'fakultas', 'masaTunggu', 'bar'));
        }
        return redirect('training');
       }
    
    public function import_excel(Request $request)
    {
        // validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
        //echo "hai";
		// menangkap file excel
		$file = $request->file('file');
 
        

		// membuat nama file unik
		/*$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_training',$nama_file);*/
 
		// import data
		//Excel::import(new TrainingImport, public_path('/file_training/'.$nama_file));
        Excel::import(new TrainingImport, $file);
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

    public function delete(){
        
        echo "halo";
        Training::where('nim', 'like', '%%')->delete();
        $file = new Filesystem;
        $file->cleanDirectory('file_training');
		Session::flash('flash_message','Data Training Berhasil Dihapus');
        return redirect('training');
    }

    public function destroy($id)
    {
        //
    }
}
