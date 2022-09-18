@extends('template')

@section('main')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Pendaftaran Akun</div>
                <div class="card-body"> 
                    {!! Form::open(['url' => 'regis', 'files' => 'true']) !!}
                    
                    @if ($errors->any())
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : 'has-success'}}">
                    @else
                        <div class="form-group">
                    @endif
                        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    @if ($errors->any())
                        <div class="form-group {{ $errors->has('nama') ? 'has-error' : 'has-success'}}">
                    @else
                        <div class="form-group">
                    @endif
                        {!! Form::label('nama', 'Nama', ['class' => 'control-label']) !!}
                        {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                        @if ($errors->has('nama'))
                            <span class="help-block">{{ $errors->first('nama') }}</span>
                        @endif
                    </div>

                    @if ($errors->any())
                        <div class="form-group {{ $errors->has('nim') ? 'has-error' : 'has-success'}}">
                    @else
                        <div class="form-group">
                    @endif
                        {!! Form::label('nim', 'NIM', ['class' => 'control-label']) !!}
                        {!! Form::text('nim', null, ['class' => 'form-control']) !!}
                        @if ($errors->has('nim'))
                            <span class="help-block">{{ $errors->first('nim') }}</span>
                        @endif
                    </div>

                    @if ($errors->any())
                        <div class="form-group {{ $errors->has('jenisKelamin') ? 'has-error' : 'has-success'}}">
                    @else
                        <div class="form-group">
                    @endif
                        {!! Form::label('jenisKelamin', 'Jenis Kelamin', ['class' => 'control-label']) !!}
                        <div class="radio">
                            <label>{!! Form::radio('jenisKelamin', 'Laki laki') !!}Laki laki</label>
                        </div>
                        <div class="radio">
                            <label>{!! Form::radio('jenisKelamin', 'Perempuan') !!}Perempuan</label>
                        </div>
                        @if ($errors->has('jenisKelamin'))
                            <span class="help-block">{{ $errors->first('jenisKelamin') }}</span>
                        @endif
                    </div>
                    
                    @if ($errors->any())
                        <div class="form-group {{ $errors->has('fakultas') ? 'has-error' : 'has-success'}}">
                    @else
                        <div class="form-group">
                    @endif
                        {!! Form::label('fakultas', 'Fakultas', ['class' => 'control-label']) !!}
                        {!! Form::select('fakultas',[
                            null => 'Silahkan pilih',
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
                    ], null, ['class' => 'form-control']) !!}
                        @if ($errors->has('fakultas'))
                            <span class="help-block">{{ $errors->first('fakultas') }}</span>
                        @endif
                    </div>
                    
                    @if ($errors->any())
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : 'has-success'}}">
                    @else
                        <div class="form-group">
                    @endif
                        {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                        {!! Form::password('password',['class' => 'form-control']) !!}
                        @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    
                    @if ($errors->any())
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : 'has-success'}}">
                    @else
                        <div class="form-group">
                    @endif
                        {!! Form::label('password_confirmation', 'Konfirmasi Password', ['class' => 'control-label']) !!}
                        {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    @if ($errors->any())
                        <div class="form-group {{ $errors->has('kpm') ? 'has-error' : 'has-success'}}">
                    @else
                        <div class="form-group">
                    @endif
                        {!! Form::label('kpm', 'Foto KPM', ['class' => 'control-label']) !!}
                        {!! Form::file('kpm', ['class' => 'form-control']) !!}
                        @if ($errors->has('kpm'))
                            <span class="help-block">{{ $errors->first('kpm') }}</span>
                        @endif
                    </div>

                    {!! Form::hidden('level', 'admin',['class' => 'form-control-file']) !!}
                    {!! Form::hidden('verifikasi', '0',['class' => 'form-control-file']) !!}
                    <div class="form-group">
                        <label class = 'control-label'>Permintaan akan diproses 1x24 jam, hasil validasi akun akan dikirim melalui email</label>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Daftar', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                    
                    {!! Form::close() !!}
    </div>
</div>
</div>
</div>
</div>
@endsection