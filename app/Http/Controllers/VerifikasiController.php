<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Storage;
use Illuminate\Support\Facades\File;
use Validator;
use Session;
use App\Http\Requests\AkunRequest;
use App\Mail\VerifikasiEmail;
use Illuminate\Support\Facades\Mail;

class VerifikasiController extends Controller
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
        $akun = User::where('verifikasi', '0')->get();
        //$akun = $akun->except(1);
        $halaman = 'akun';

        return view('verifikasi.index', compact('halaman','akun'));
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
    public function cari(Request $request)
    {
        $halaman = 'akun';
        $search = trim($request->input('search'));
        $fakultas = trim($request->input('fakultas'));
        $namaAtauNim = trim($request->input('namaAtauNim'));
        if (! empty($search)) {
            $this->validate($request, [
                'namaAtauNim' => 'required'
            ]);

            $query = User::where([
                [$namaAtauNim, 'LIKE', '%' . $search . '%'],
                ['verifikasi', '0']
            ] );
            (! empty($fakultas)) ? $query->where('fakultas', $fakultas ) : '';
            $akun = $query->paginate(25);
            $paging = (! empty($fakultas)) ? $akun->appends(['fakultas' => $fakultas]) : '';
            $paging = (! empty($namaAtauNim)) ? $akun->appends(['namaAtauNim' => $namaAtauNim]) : '';
            $paging = (! empty($search)) ? $akun->appends(['search' => $search]) : '';
            $cek = false;
            $page = true;
            return view('verifikasi.index', compact('halaman','akun', 'cek','page', 'search', 'namaAtauNim', 'fakultas'));
        }
        if (! empty($fakultas)) {
            $query = User::where([
                ['fakultas', $fakultas],
                ['verifikasi', '0']
            ] );
            $akun = $query->paginate(25);
            $paging = (! empty($fakultas)) ? $akun->appends(['fakultas' => $fakultas]) : '';
            $cek = false;
            $page = true;
            return view('verifikasi.index', compact('halaman','akun', 'cek','page', 'search', 'namaAtauNim', 'fakultas'));
        }
        return redirect('verifikasi');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $halaman = 'akun';
        $akun = User::findOrFail($id);
        return view('verifikasi.show', compact('halaman','akun'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $akun = User::findOrFail($id);
        $akun->update($request->all());

        Mail::to($akun->email)->send(new VerifikasiEmail($akun->nama, $akun->verifikasi));
        Session::flash('flash_message','Akun Mahasiswa Telah Diverifikasi');
        return redirect('verifikasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $akun = User::where('id',$id)->first();
        File::delete('kpmUpload/'.$akun->kpm);
        Mail::to($akun->email)->send(new VerifikasiEmail($akun->nama, $akun->verifikasi));
        $akun->delete();
        Session::flash('flash_message','Akun Mahasiswa Telah Ditolak');
        return redirect('akun');
    }
}
