<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{ asset('bootstrap_4_6_1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap_4_6_1/css/bootstrap.css') }}">

    <title>Prediksi Masa Depan</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #eef084;">  
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Prediksi Masa Tunggu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if (!empty($halaman) && $halaman == '/')
                  <li class="nav-item active">
                  <a class="nav-link" href="{{ url('/') }}"><b>Beranda</b><span class="sr-only">(current)</span></a>
                  </li> 
                    
                @else
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/') }}">Beranda</a>
                  </li>
                @endif

                @if (!empty($halaman) && $halaman == 'training')
                  <li class="nav-item active">
                  <a class="nav-link" href="{{ url('training') }}"><b>Data Training</b><span class="sr-only">(current)</span></a>
                  </li> 
                    
                @else
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('training') }}">Data Training</a>
                  </li>
                @endif

                @if (!empty($halaman) && $halaman == 'mahasiswa')
                  <li class="nav-item active">
                  <a class="nav-link" href="{{ url('mahasiswa') }}"><b>Data Mahasiswa</b><span class="sr-only">(current)</span></a>
                  </li> 
                    
                @else
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('mahasiswa') }}">Data Mahasiswa</a>
                  </li>
                @endif

                @if (!empty($halaman) && $halaman == 'about')
                  <li class="nav-item active">
                  <a class="nav-link" href="{{ url('/about') }}"><b>Tentang</b><span class="sr-only">(current)</span></a>
                  </li> 
                    
                @else
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/about') }}">Tentang</a>
                  </li>
                @endif
              
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            </div>
        </div>
      </nav>
    <div class="container">
        <br>
        @yield('main')
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="{{ asset('js/jquery_3_6_0.min.js') }}"></script>
    <script src="{{ asset('bootstrap_4_6_1/js/bootstrap.min.js') }}"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  </body>
</html>