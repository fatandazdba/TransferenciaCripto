@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>{{ __('Balance de transferencia') }}</h2></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif



                        @foreach($datos as $key =>$dato)

                            @if(isset($key) && $key === 'hash')

                                <div class="shadow-sm p-3 mb-1 bg-white rounded">
                                    <strong>Hash: </strong> {{ $datos[$key]  }}</div>
                            @endif
                            @if(isset($key) && $key === 'addresses')
                                <div class="shadow-sm p-3 mb-1 bg-white rounded">
                                    <strong>To: </strong> {{ $datos[$key][0]  }}</div>

                            @endif
                            @if(isset($key) && $key === 'addresses')
                                <div class="shadow-sm p-3 mb-1 bg-white rounded">
                                    <strong>From: </strong> {{ $datos[$key][2]  }}
                                </div>

                            @endif
                            @if(isset($key) && $key === 'total')
                                <div class="shadow-sm p-3 mb-1 bg-white rounded">
                                    <strong>Total: </strong> {{ $datos[$key]  }} </div>

                            @endif
                            @if(isset($key) && $key === 'fees')
                                <div class="shadow-sm p-3 mb-1 bg-white rounded">
                                    <strong>Tasa de envio: </strong> {{ $datos[$key]  }} </div>

                            @endif
                            @if(isset($key) && $key === 'size')
                                <div class="shadow-sm p-3 mb-1 bg-white rounded">
                                    <strong>Tamaño: </strong> {{ $datos[$key]  }} </div>

                            @endif
                            @if(isset($key) && $key === 'preference')
                                <div class="shadow-sm p-3 mb-1 bg-white rounded"><strong>Preferencia de
                                        envío: </strong> {{ $datos[$key]  }} </div>

                            @endif
                            @if(isset($key) && $key === 'relayed_by')
                                <div class="shadow-sm p-3 mb-1 bg-white rounded">
                                    <strong>Retrasmitido: </strong> {{ $datos[$key]  }} </div>

                            @endif
                            @if(isset($key) && $key === 'received')
                                <div class="shadow-sm p-3 mb-1 bg-white rounded">
                                    <strong>Recibido: </strong> {{ $datos[$key]  }} </div>

                            @endif
                            @if(isset($key) && $key === 'inputs')
                                <div class="shadow-sm p-3 mb-1 bg-white rounded"><strong>Hash
                                        previo: </strong> {{ $datos[$key][0]['prev_hash']  }} </div>

                            @endif

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
