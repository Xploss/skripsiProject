<div id="pencarian">
    {!! Form::open(['url' => 'mahasiswa/cari', 'method' => 'GET']) !!}
    <div class="row right">
        <div class="col-md-2">
            {!! Form::select('prediksi', [
                null => 'Pilih prediksi',
                'cepat' => 'Cepat',
                'lama' => 'Lama'], (! empty($masaTunggu)) ? $masaTunggu : 'Pilih masa tunggu', ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-2">
            {!! Form::select('fakultas',[
                null => 'Pilih fakultas',
                'EKONOMI' => 'EKONOMI',
                'HUKUM' => 'HUKUM',
                'ILMU KOMPUTER' => 'ILMU KOMPUTER',
                'ILMU SOSIAL DAN ILMU POLITIK' => 'ILMU SOSIAL DAN ILMU POLITIK',
                'KEDOKTERAN' => 'KEDOKTERAN',
                'KEGURUAN DAN ILMU PENDIDIKAN' => 'KEGURUAN DAN ILMU PENDIDIKAN',
                'KESEHATAN MASYARAKAT' => 'KESEHATAN MASYARAKAT',
                'MATEMATIKA DAN ILMU PENGETAHUAN ALAM' => 'MATEMATIKA DAN ILMU PENGETAHUAN ALAM',
                'PERTANIAN' => 'PERTANIAN',
                'TEKNIK' => 'TEKNIK',
        ], (! empty($fakultas)) ? $fakultas : 'Pilih fakultas', ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-2">
            {!! Form::select('namaAtauNim', [
                null => 'Cari nama atau NIM',
                'nama' => 'Nama',
                'nim' => 'NIM'], (! empty($namaAtauNim)) ? $namaAtauNim : 'Cari nama atau NIM', ['class' => 'form-control']) !!}
                @if ($errors->has('namaAtauNim'))
                    <span class="help-block" style="color: #a94442"><b>{{ $errors->first('namaAtauNim') }}</b></span>
                @endif
        </div>
        <div class="col-md-6">
            <div class="input-group">
                {!! Form::text('search', (!empty($search)) ? $search : null , ['class' => 'form-control', 'placeholder' => 'Masukkan yang dicari']) !!}
                <span class="input-group-btn">
                    {!! Form::submit('Cari', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </span>
            </div>
        </div>
    </div>
    
    {!! Form::close() !!}
</div>