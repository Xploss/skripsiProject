@extends('template')

@section('main')
		<div>
			<h2>Data Mahasiswa</h2>
			<script>
				window.onload = function () {
				
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					title:{
						text: "Grafik Prediksi Masa Tunggu"
					},	
					axisY: {
						title: "Banyak Mahasiswa",
						titleFontColor: "#4F81BC",
						lineColor: "#4F81BC",
						labelFontColor: "#4F81BC",
						tickColor: "#4F81BC"
					},
					toolTip: {
						shared: true
					},
					legend: {
						cursor:"pointer",
						itemclick: toggleDataSeries
					},
					data: [{
						type: "bar",
						name: "Cepat",
						legendText: "Cepat",
						color : "green",
						showInLegend: true, 
						dataPoints:[
							@foreach($bar as $b)
							{ label: "{{ $b->fakultas }}", y: {{ $b->Cepat }} },
							@endforeach
						]
					},{
						type: "bar",
						name: "Lama",
						legendText: "Lama",
						color : "red",
						showInLegend: true, 
						dataPoints:[
							@foreach($bar as $b)
							{ label: "{{ $b->fakultas }}", y: {{ $b->Lama }} },
							@endforeach
						]
					}]
				});
				chart.render();
				
				function toggleDataSeries(e) {
					if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
						e.dataSeries.visible = false;
					}
					else {
						e.dataSeries.visible = true;
					}
					chart.render();
				}
				
				}
				</script>
				<div id="chartContainer" style="height: 300px; width: 100%;"></div>
			<a href="{{ url('mahasiswa/export') }}" class="btn btn-success my-3" target="_blank">Unduh Excel</a>
			@include('mahasiswa.form_pencarian')
			<table class="table">
				<thead>
					<tr>
						<th>NIM</th>
                        <th>Nama</th>
						<th>IPK</th>
                        <th>Prediksi</th>
						<th>Fakultas</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($mahasiswa as $ms => $id)
						<tr>
							<td>{{ $id->nim }}</td>
							<td>{{ $id->nama }}</td>
                            <td>{{ $id->ipk }}</td>
							<td>{{ $id->prediksi}}</td>
							<td>{{ $id->fakultas }}</td>
							<td>
								<div style="display: inline-block">
									{{ link_to('mahasiswa/'.$id->nim, 'Detail', ['class'=>'btn btn-success btn-sm']) }}
								</div>
								<div style="display: inline-block">
									{!! Form::open(['method' => 'DELETE', 'action' => ['MahasiswaController@destroy', $id->nim]]) !!}
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