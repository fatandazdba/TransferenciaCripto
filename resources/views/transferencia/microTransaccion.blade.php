@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-5">
                <div class="card">

                    <div class="card-body">
                        @include('transferencia.form.micro')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    body {
        background-image: url(https://www.pandasecurity.com/spain/mediacenter/src/uploads/2017/09/IMG-MC-blockchain-1920x1261.jpg) !important;
    }
</style>


