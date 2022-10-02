@extends('template')

@section('main')
<div class="row">
    <div class="col-md-6">
        <h2>Data Mahasiswa</h2>
        <p><i>Ini hanyalah prediksi belaka bukan benar benar akan terjadi nanti. Dari hasil ini diharapkan teman-teman bisa mempersiapkan diri untuk mendapatkan pekerjaan nantinya.</i></p>
            <table class="table">
                <tr>
                    <td>NIM</td>
                    <td>{{ $mahasiswa->nim}}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>{{ $mahasiswa->nama  }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>{{ $mahasiswa->jenisKelamin  }}</td>
                </tr>
                <tr>
                    <td>IPK</td>
                    <td>{{ $mahasiswa->ipk }}</td>
                </tr>
                <tr>
                    <td>Predikat IPK</td>
                    <td>{{ $mahasiswa->ipkPredikat }}</td>
                </tr>
                <tr>
                    <td>Fakultas</td>
                    <td>{{ $mahasiswa->fakultas }}</td>
                </tr>
                <tr>
                    <td>Kemampuan Bahasa Inggris</td>
                    <td>{{ $mahasiswa->kemampuanBahasaInggris }}</td>
                </tr>
                <tr>
                    <td>Pengetahuan Diluar Bidang</td>
                    <td>{{ $mahasiswa->pengetahuanDiluarBidang }}</td>
                </tr>
                
                <tr>
                    <td>Keterampilan Komputer</td>
                    <td>{{ $mahasiswa->keterampilanKomputer }}</td>
                </tr>
                <tr>
                    <td>Pengalaman Magang</td>
                    <td>{{ $mahasiswa->pengalamanMagang }}</td>
                </tr>
                <tr>
                    <td>Jenis Pekerjaan</td>
                    <td>{{ $mahasiswa->jenisPekerjaan }}</td>
                </tr>
            </table>
            <p>Perkiraan {{$mahasiswa->nama}} mendapatkan pekerjaan setelah lulus terbilang {{ $mahasiswa->prediksi }} kira-kira {{ $mahasiswa->prediksi === "Cepat" ? "1 - 6 bulan" : "lebih dari 6 bulan" }}</p>
        </div>
        
    </div>
@endsection