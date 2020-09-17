@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">
        <h1>Yo soy el administrador</h1>
    </div>
@endsection
