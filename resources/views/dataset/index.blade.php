@extends('template')

@section('main')
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="dataset/import_excel" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <h2>Uji Performa Dataset</h2>
			<button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
				Unggah Data
			</button>
    
    <table class="table">
        <thead>
            <th>Nama Dataset</th>
            <th>Total Cepat</th>
            <th>Total Lama</th>
            <th>Akurasi</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <tr>
                <td>Data training yang digunakan</td>
                <td>{{ $training[0]['cepat'] }}</td>
                <td>{{ $training[0]['lama'] }}</td>
                <td>{{ $valueTraining }}%</td>
                <td>{{ $deviasiTraining }}%</td>
            </tr>
                @foreach ($dataset as $data => $baris)
                <tr>
                    <td>{{ $baris->namadataset->namaData }}</td>
                    <td>{{ $baris->cepat }}</td>
                    <td>{{ $baris->lama }}</td>
                    <td>{{ $baris->namadataset->akurasi }}%</td>
                    <td>{{ $baris->namadataset->deviasi }}%</td>
                    <td>
                        <div style="display: inline-block">
                            {!! Form::open(['method' => 'DELETE','action' => ['DatasetController@destroy', $baris->id_dataset]]) !!}
                            {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
@endsection