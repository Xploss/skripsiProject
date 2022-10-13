<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mahasiswa;
use Auth;
use Storage;
use Illuminate\Support\Facades\File;
use Validator;
use Session;
use App\Mail\VerifikasiEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AkunRequest;
use App\Http\Controllers\MahasiswaController;

class AkunController extends Controller
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
        $akun = User::paginate(25)->where('verifikasi', '1');
        $akun = $akun->except(1);
        $halaman = 'akun';

        return view('akun.index', compact('halaman','akun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('akun.create');
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
                ['verifikasi', '1'],
                ['level', '!=', 'admin']
            ] );
            (! empty($fakultas)) ? $query->where('fakultas', $fakultas ) : '';
            $akun = $query->paginate(25);
            $paging = (! empty($fakultas)) ? $akun->appends(['fakultas' => $fakultas]) : '';
            $paging = (! empty($namaAtauNim)) ? $akun->appends(['namaAtauNim' => $namaAtauNim]) : '';
            $paging = (! empty($search)) ? $akun->appends(['search' => $search]) : '';
            $cek = false;
            $page = true;
            return view('akun.index', compact('halaman','akun', 'cek','page', 'search', 'namaAtauNim', 'fakultas'));
        }
        if (! empty($fakultas)) {
            $query = User::where([
                ['fakultas', $fakultas],
                ['verifikasi', '1'],
                ['level', '!=', 'admin']
            ] );
            $akun = $query->paginate(25);
            $paging = (! empty($fakultas)) ? $akun->appends(['fakultas' => $fakultas]) : '';
            $cek = false;
            $page = true;
            return view('akun.index', compact('halaman','akun', 'cek','page', 'search', 'namaAtauNim', 'fakultas'));
        }
        return redirect('akun');
       }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AkunRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('kpm')) {
            $kpm = $request->file('kpm');
            $ext = $kpm->getClientOriginalExtension();
            if ($request->file('kpm')->isValid()) {
                $kpmNama = date('YmdHis'). ".$ext";
                $path = 'kpmUpload';
                $request->file('kpm')->move($path, $kpmNama);
                $data['kpm'] = $kpmNama;
            }
        }
        $data['password'] = bcrypt($data['password']);
        User::Create($data);

        return redirect('akun');
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
        return view('akun.show', compact('halaman','akun'));
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
        $akun = User::where('id',$id)->first();
        $mahasiswa = Mahasiswa::where('nim',$akun->nim)->first();
        echo $akun->nim;
        //$mahasiswa->delete();
        File::delete('kpmUpload/'.$akun->kpm);
        Mail::to($akun->email)->send(new VerifikasiEmail($akun->nama, '3'));
        $akun->delete();
        Session::flash('flash_message','Akun Mahasiswa Telah Dihapus');
        return redirect('akun');
    }
}
