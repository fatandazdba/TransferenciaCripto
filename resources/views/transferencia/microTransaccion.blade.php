@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Nueva Transacción</h2></div>
                    <div class="card-body">

                        <form action="transaccion" method="post" >
                            {{@csrf_field()}}
                            <div class="container">
                                <h3>Datos requeridos</h3>
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           id="from_pubkey"
                                           placeholder="Clave publica"
                                           name="from_pubkey"
                                           value="{{ old('from_pubkey')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control"
                                           id="from_private"
                                           placeholder="Clave privada"
                                           name="from_private"
                                           value="{{ old('from_private')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control"
                                           id="to_address"
                                           placeholder="Address destinatario"
                                           name="to_address"
                                           value="{{ old('to_address')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="number"
                                           class="form-control"
                                           id="value_satoshis"
                                           placeholder="Monto (satoshis)"
                                           name="value_satoshis"
                                           value="{{ old('value_satoshis')}}"
                                    >
                                </div>
                                <hr>
                                <input class="btn btn-primary" type="submit" value="Enviar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



