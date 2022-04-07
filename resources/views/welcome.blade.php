@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')
@include('records.createModal')

@stop

@section('js')
<script src="{{asset('js/records/checkin.js')}}"></script>
@stop

