@extends('adminlte::page')

@section('title', 'Reporte')

@section('content_header')
    <h1>listado de vehiculos oficiales</h1>
@stop
@section('content')
@include('records.CheckinModal')
@include('records.CheckoutModal')
@include('vehicle.createofModal')
@include('vehicle.createresModal')
<div class="card-body">
    <div class="card-header">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8">
                    <h2>Listado de Vehiculos oficiales</h2>
                </div>
                <div class="col-md-4">
                    <div class="mb-4 d-flex justify-content-end">
                        {!! Form::open(['route' => 'report.download','method'=>'get' ] ) !!}
                            {!! Form::submit('Crear nuevo', ['class'=>'btn btn-primary','id'=>'vof'])  !!}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
                <table class="table table-striped table-bordered no-margin-bottom dt-responsive nowrap" >
                    <caption>Listado de Vehiculos Residentes</caption>
                    <thead>
                    <tr>
                        <th scope="col">Num. Placa</th>
                        <th scope="col">Tiempo estacionado (min.)</th>
                        <th scope="col">Cantidad a pagar</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($recidentes as $recidente)
                        <tr>
                            <th scope="row">{{ $recidente->vehicle_registration_type.'-'.$recidente->vehicle_license_plates }}</th>
                            <td>{{ $recidente->parking_time }}</td>
                            <td>$. {{ $recidente->total }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@stop

@section('js')
<script>

$('#report').click(function (e) {
    Swal.fire({
         title: 'Submit your Github username',
         input: 'text',
         inputAttributes: {
         autocapitalize: 'off'
         },
         showCancelButton: true,
         confirmButtonText: 'Look up',
         showLoaderOnConfirm: true,
         preConfirm: (name) => {
             $.ajax({
                 type: "get",
                 headers: {'X-CSRF-TOKEN': $('#tokenVehicle').val()},
                 url: "/report/report-pay",
                 dataType: "json",

             });

         },
         allowOutsideClick: () => !Swal.isLoading()
     }).then((result) => {
         if (result.isConfirmed) {
         Swal.fire({
             title: `${result.value.login}'s avatar`,
             imageUrl: result.value.avatar_url
         })
         }
     })

 });
</script>
@section('js')
<script src="{{asset('js/jquery.validate.js') }}"></script>
<script src="{{asset('js/records/checkin.js')}}"></script>
<script src="{{asset('js/records/checkout.js')}}"></script>
<script src="{{asset('js/vehicle/createres.js')}}"></script>
<script src="{{asset('js/vehicle/createof.js')}}"></script>
<script src="{{asset('js/report/report.js')}}"></script>
@stop

@stop
