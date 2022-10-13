<div class="form-group">
            {!! Form::label('nama', 'Nama', ['class' => 'control-label']) !!}
            {!! Form::text('nama', $mahasiswa['nama'], ['class' => 'form-control', 'readonly']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('nim', 'NIM', ['class' => 'control-label']) !!}
            {!! Form::text('nim', $mahasiswa['nim'], ['class' => 'form-control', 'readonly']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('jenisKelamin', 'Jenis Kelamin', ['class' => 'control-label']) !!}
            {!! Form::text('jenisKelamin', $mahasiswa['jenisKelamin'], ['class' => 'form-control', 'readonly']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('fakultas', 'Fakultas', ['class' => 'control-label']) !!}
            {!! Form::text('fakultas', $mahasiswa['fakultas'], ['class' => 'form-control', 'readonly']) !!}
        </div>
        
        @if ($errors->any())
            <div class="form-group {{ $errors->has('ipk') ? 'has-error' : 'has-success'}}">
        @else
            <div class="form-group">
        @endif
            {!! Form::label('ipk', 'IPK', ['class' => 'control-label']) !!}
            {!! Form::text('ipk', null, ['class' => 'form-control']) !!}
            {!! Form::hidden('ipkPredikat', "2",) !!}
            @if ($errors->has('ipk'))
                <span class="help-block">{{ $errors->first('ipk') }}</span>
            @endif
        </div>

        @if ($errors->any())
            <div class="form-group {{ $errors->has('kemampuanBahasaInggris') ? 'has-error' : 'has-success'}}">
        @else
            <div class="form-group">
        @endif
            {!! Form::label('kemampuanBahasaInggris', 'Kemampuan Bahasa Inggris', ['class' => 'control-label']) !!}
            {!! Form::select('kemampuanBahasaInggris',[
                null => 'Silahkan pilih',
                'Sangat besar' => 'Sangat besar',
                'Besar' => 'Besar',
                'Cukup besar' => 'Cukup besar',
                'Kurang' => 'Kurang',
                'Tidak sama sekali' => 'Tidak sama sekali',
        ], null, ['class' => 'form-control']) !!}
            @if ($errors->has('kemampuanBahasaInggris'))
                <span class="help-block">{{ $errors->first('kemampuanBahasaInggris') }}</span>
            @endif
        </div>

        @if ($errors->any())
            <div class="form-group {{ $errors->has('pengetahuanDiluarBidang') ? 'has-error' : 'has-success'}}">
        @else
            <div class="form-group">
        @endif
            {!! Form::label('pengetahuanDiluarBidang', 'Pengetahuan Diluar Bidang', ['class' => 'control-label']) !!}
            {!! Form::select('pengetahuanDiluarBidang',[
                null => 'Silahkan pilih',
                'Sangat besar' => 'Sangat besar',
                'Besar' => 'Besar',
                'Cukup besar' => 'Cukup besar',
                'Kurang' => 'Kurang',
                'Tidak sama sekali' => 'Tidak sama sekali',
        ], null, ['class' => 'form-control']) !!}
            @if ($errors->has('pengetahuanDiluarBidang'))
                <span class="help-block">{{ $errors->first('pengetahuanDiluarBidang') }}</span>
            @endif
        </div>

        @if ($errors->any())
            <div class="form-group {{ $errors->has('keterampilanKomputer') ? 'has-error' : 'has-success'}}">
        @else
            <div class="form-group">
        @endif
            {!! Form::label('keterampilanKomputer', 'Keterampilan Komputer', ['class' => 'control-label']) !!}
            {!! Form::select('keterampilanKomputer',[
                null => 'Silahkan pilih',
                'Sangat besar' => 'Sangat besar',
                'Besar' => 'Besar',
                'Cukup besar' => 'Cukup besar',
                'Kurang' => 'Kurang',
                'Tidak sama sekali' => 'Tidak sama sekali',
        ], null, ['class' => 'form-control']) !!}
            @if ($errors->has('keterampilanKomputer'))
                <span class="help-block">{{ $errors->first('keterampilanKomputer') }}</span>
            @endif
        </div>

        @if ($errors->any())
            <div class="form-group {{ $errors->has('pengalamanMagang') ? 'has-error' : 'has-success'}}">
        @else
            <div class="form-group">
        @endif
            {!! Form::label('pengalamanMagang', 'Pengalaman Magang', ['class' => 'control-label']) !!}
            {!! Form::select('pengalamanMagang',[
                null => 'Silahkan pilih',
                'Sangat besar' => 'Sangat besar',
                'Besar' => 'Besar',
                'Cukup besar' => 'Cukup besar',
                'Kurang' => 'Kurang',
                'Tidak sama sekali' => 'Tidak sama sekali',
        ], null, ['class' => 'form-control']) !!}
            @if ($errors->has('pengalamanMagang'))
                <span class="help-block">{{ $errors->first('pengalamanMagang') }}</span>
            @endif
        </div>

        @if ($errors->any())
            <div class="form-group {{ $errors->has('jenisPekerjaan') ? 'has-error' : 'has-success'}}">
        @else
            <div class="form-group">
        @endif
            {!! Form::label('jenisPekerjaan', 'Jenis Pekerjaan', ['class' => 'control-label']) !!}
            {!! Form::select('jenisPekerjaan',[
                null => 'Silahkan pilih',
                'Instansi Pemerintah' => 'Instansi Pemerintah',
                'Lembaga Swadaya Masyarakat' => 'Lembaga Swadaya Masyarakat',
                'Perusahaan Swasta' => 'Perusahaan Swasta',
                'Wiraswasta' => 'Wiraswasta',
                'Lainnya' => 'Lainnya',
        ], null, ['class' => 'form-control']) !!}
            @if ($errors->has('jenisPekerjaan'))
                <span class="help-block">{{ $errors->first('jenisPekerjaan') }}</span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::submit($submitBtnText, ['class' => 'btn btn-primary form-control']) !!}
        </div>