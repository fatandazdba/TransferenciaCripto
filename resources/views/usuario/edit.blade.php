@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">
        <div class="row justify-content-center">



            <div class="col-md-5 perfil_from">
                <id id="img_my_perfil">
                    <img src="images/login.png" width="130" height="130">
                </id>
                <div class="card perfil">
                    <div class="card-body">
                        @include('usuario.forms.usr')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
