@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Mi cuenta</h2></div>
                    <div class="card-body">

                        @include('usuario.forms.usr')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
