@extends('template')

@section('main')
<div class="card col align-self-center" style="width: max;">
    <div class="card-body">
        <h5 class="card-title">Form Prediksi</h5>
        {!! Form::open(['url' => 'prediksi']) !!}
        @include('prediksi.form', ['submitBtnText' => 'Simpan'])
        {!! Form::close() !!}
    </div>
</div>
    
@endsection