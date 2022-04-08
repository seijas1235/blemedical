@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Indicadores por dia</h1>
@stop
@section('content')
@include('records.CheckinModal')
@include('records.CheckoutModal')
@include('vehicle.createofModal')
@include('vehicle.createresModal')

<div class="row">

    <div class="col-sm-3">
        <div class="card" style="width: 99%; background:#2196F3; color:white">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="card" style="width: 99%; background:#CDDC39; color:white">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="card" style="width: 99%; background:#F44336; color:white">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card" style="width: 99%; background:#009688; color:white">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

            </div>
        </div>
    </div>
</div>

<main class="py-4">
    @yield('reporte')
</main>
@section('css')
    <script src="{{asset('css/custom.css') }}"></script>

@stop

@section('js')
<script src="{{asset('js/jquery.validate.js') }}"></script>
<script src="{{asset('js/records/checkin.js')}}"></script>
<script src="{{asset('js/records/checkout.js')}}"></script>
<script src="{{asset('js/vehicle/createres.js')}}"></script>
<script src="{{asset('js/vehicle/createof.js')}}"></script>
<script src="{{asset('js/report/report.js')}}"></script>
@stop
