@extends('template')

@section('main')
		<div>
			<h2>Akun Mahasiswa</h2>
			<a href="{{ url('verifikasi') }}" class="btn btn-success my-3">Verifikasi Akun</a>
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Email</th>
						<th>NIM</th>
                        <th>Nama</th>
						<th>Fakultas</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($akun as $ak)
						<tr>
							<td>{{ $loop->iteration }}</td>
                            <td>{{ $ak->email }}</td>
							<td>{{ $ak->nim }}</td>
							<td>{{ $ak->nama }}</td>
							<td>{{ $ak->fakultas }}</td>
							<td>
								<div style="display: inline-block">
									{{ link_to('akun/'.$ak->id, 'Detail', ['class'=>'btn btn-success btn-sm']) }}
								</div>
								<div style="display: inline-block">
									{!! Form::open(['method' => 'DELETE', 'action' => ['AkunController@destroy', $ak->id]]) !!}
									{!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!}
									{!! Form::close() !!}
								</div>
							</td>
						</tr>
					@endforeach
					
				</tbody>
			</table>
		</div>
		
 
 
 
	@endsection