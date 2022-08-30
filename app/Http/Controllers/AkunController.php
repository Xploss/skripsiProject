<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Storage;
use Illuminate\Support\Facades\File;
use Validator;
use App\Http\Requests\AkunRequest;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akun = User::paginate(25)->where('verifikasi', '1');
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
        File::delete('kpmUpload/'.$akun->kpm);
        $akun->delete();

        return redirect('akun');
    }
}
