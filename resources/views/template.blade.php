<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{ asset('bootstrap_4_6_1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap_4_6_1/css/bootstrap.css') }}">
    <style>

		.has-error .help-block,
		.has-error .control-label,
		.has-error .radio,
		.has-error .checkbox,
		.has-error .radio-inline,
		.has-error .checkbox-inline,
		.has-error.radio label,
		.has-error.checkbox label,
		.has-error.radio-inline label,
		.has-error.checkbox-inline label {
		color: #a94442;
		}

      .has-error .form-control {
        border-color: #a94442;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      }

	  	.has-success .help-block,		
		.has-success .control-label,
		.has-success .radio,
		.has-success .checkbox,
		.has-success .radio-inline,
		.has-success .checkbox-inline,
		.has-success.radio label,
		.has-success.checkbox label,
		.has-success.radio-inline label,
		.has-success.checkbox-inline label {
		color: #3c763d;
		}

      .has-success .form-control {
        border-color: #3c763d;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      }

      .help-block {
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
        color: #737373;
      }
      
		.zoom {
			transition: transform .2s; /* Animation */
			width: auto;
			height: 350px;
		}

		.zoom:hover {
			transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
		}
    </style>
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
                
                @if (Auth::check() && Auth::user()->level == 'mahasiswa')
                  @if (!empty($halaman) && $halaman == 'prediksi')
                    <li class="nav-item active">
                    <a class="nav-link" href="{{ url('prediksi') }}"><b>Prediksi</b><span class="sr-only">(current)</span></a>
                    </li>
                  @else
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('prediksi') }}">Prediksi</a>
                    </li>
                  @endif
                @endif

                @if (Auth::check() && Auth::user()->level == 'admin')
                  @if (!empty($halaman) && $halaman == 'training')
                    <li class="nav-item active">
                    <a class="nav-link" href="{{ url('training') }}"><b>Data Training</b><span class="sr-only">(current)</span></a>
                    </li> 
                      
                  @else
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('training') }}">Data Training</a>
                    </li>
                  @endif
                @endif
                
                        @if (Auth::check() && Auth::user()->level == 'admin')
                  @if (!empty($halaman) && $halaman == 'mahasiswa')
                  <li class="nav-item active">
                  <a class="nav-link" href="{{ url('mahasiswa') }}"><b>Data Mahasiswa</b><span class="sr-only">(current)</span></a>
                  </li> 
                    
                  @else
                  <li class="nav-item">
                  <a class="nav-link" href="{{ url('mahasiswa') }}">Data Mahasiswa</a>
                  </li>
                  @endif		
                @endif
                        
                @if (Auth::check() && Auth::user()->level == 'admin')
                  @if (!empty($halaman) && $halaman == 'akun')
                  <li class="nav-item active">
                  <a class="nav-link" href="{{ url('akun') }}"><b>Akun Mahasiswa</b><span class="sr-only">(current)</span></a>
                  </li> 
                    
                  @else
                  <li class="nav-item">
                  <a class="nav-link" href="{{ url('akun') }}">Akun Mahasiswa</a>
                  </li>
                  @endif	
                @endif
                

              
            </ul>
            <ul class="nav justify-content-end">
				@if (Auth::check())
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ Auth::user()->nama }}<span class="sr-only"></span></a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
						</div>
				  	</li>
				@else
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">Masuk</a> 
					</li>
				@endif
            </ul>
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
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  </body>
</html>