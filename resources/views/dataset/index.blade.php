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
                            <input type="text" name="namaData" required="required" placeholder="Nama Dataset">
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

    <h2>Dataset</h2>
			<button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
				Unggah Data
			</button>
    
    <table class="table">
        <thead>
            <th>Nama Dataset</th>
            <th>Total Cepat</th>
            <th>Total Lama</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <tr>
                @foreach ($dataset as $data)
                    <td>{{ $data->namadataset->namaData }}</td>
                    <td>{{ $data->cepat }}</td>
                    <td>{{ $data->lama }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
@endsection