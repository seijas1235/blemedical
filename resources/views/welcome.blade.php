@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')
@include('records.CheckinModal')
@include('records.CheckoutModal')
@include('vehicle.createofModal')
@include('vehicle.createresModal')

@stop

@section('js')
<script src="{{asset('js/jquery.validate.js') }}"></script>
<script src="{{asset('js/records/checkin.js')}}"></script>
<script src="{{asset('js/records/checkout.js')}}"></script>
<script src="{{asset('js/vehicle/createres.js')}}"></script>
<script src="{{asset('js/vehicle/createof.js')}}"></script>
@stop

