@extends('template')

@section('main')
 
		{{-- notifikasi form validasi --}}
		@if ($errors->has('file'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			{{ $errors->first('file') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		@endif
		@include('__partial')
 
 
		<!-- Import Excel -->
			<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<form method="post" action="training/import_excel" enctype="multipart/form-data">
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
 
 
		<div>
			

			<h2>Data Training</h2>
			<button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
				Unggah Data
			</button>
			<a role="button" class="btn btn-danger mr-5" aria-pressed="true" href="training/delete">
				Hapus Data
			</a>
			<br>
			<br>
			<br>
			@if ($cek)
			<p>Data training tidak ada</p>
			@else
			@include('training.form_pencarian')
			<table class="table">
				<thead>
					<tr>
						<th>Diterima Setelah Lulus</th>
						<th>NIM</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>IPK</th>
						<th>Fakultas</th>
						<th>Kemampuan Bahasa Inggris</th>
						<th>Pengetahuan diluar Bidang</th>
						<th>Keterampilan Komputer</th>
						<th>Pengalaman Magang</th>
						<th>Jenis Pekerjaan Pertama</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($training as $tr)
						<tr>
							<td>{{ $tr->diterimaBulanStlhLulus }} bulan</td>
							<td>{{ $tr->nim }}</td>
							<td>{{ $tr->nama }}</td>
							<td>{{ $tr->jenisKelamin }}</td>
							<td>{{ $tr->ipkPredikat }}</td>
							<td>{{ $tr->fakultas }}</td>
							<td>{{ $tr->kemampuanBahasaInggris }}</td>
							<td>{{ $tr->pengetahuanDiluarBidang }}</td>
							<td>{{ $tr->keterampilanKomputer }}</td>
							<td>{{ $tr->pengalamanMagang }}</td>
							<td>{{ $tr->jenisPekerjaan }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
				
			@endif
			@if ($page == true)
			<div>
				{{ $training->links() }}
			</div>
			@endif
			
			
		</div>
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
		<table>
			@foreach ($bar as $b)
			<tr>
				<td>{{ $b->fakultas }}</td>
				<td>{{ $b->Cepat }}</td>
				<td>{{ $b->Lama }}</td>
			</tr>
			@endforeach
		</table>
			
 
 
	@endsection