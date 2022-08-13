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


class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $halaman = 'training';
        $training = Training::paginate(25);
        return view('training.index', compact('halaman','training'));
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
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_training',$nama_file);
 
		// import data
		Excel::import(new TrainingImport, public_path('/file_training/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
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
        return redirect('training');
    }

    public function destroy($id)
    {
        //
    }
}
