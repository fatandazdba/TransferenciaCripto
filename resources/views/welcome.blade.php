@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">
        <div class="container-fluid imagen_blockchain text-white">

            <div class="align-content-center size">
                <h2>Buscar</h2>
                <!--p>Ingrese un address para encontrar las transacciones en la red de pruebas testnet3</p-->
                <form class="form-inline" action="/api/addressFull">
                    <label for="address" class="mb-2 mr-sm-2">Bitcoin Address:</label>
                    <input type="text" class="form-control mb-2 mr-sm-2 input-group-lg" id="search_address"
                           placeholder="n3AmuXTmVtPRZfm1zqZG5bVFR4QGxZM2RE" value="n3AmuXTmVtPRZfm1zqZG5bVFR4QGxZM2RE"
                           name="address">
                    <button type="submit" title="Search" class="btn btn-primary mb-2">
                        <a href="javascript:void(0)" id="n3AmuXTmVtPRZfm1zqZG5bVFR4QGxZM2RE" class="btn btn-sm btn-primary boton_url">Buscar</a>
                    </button>

                </form>
            </div>

        </div>

        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="images/bitcoin.jpg" alt="bitcoin">
                <div class="card-body">
                    <h5 class="card-title">Bitcoin</h5>
                    <p class="card-text">Bitcoin​ ​ es un protocolo, proyecto de código abierto y red peer-to-peer que se utiliza como criptomoneda, sistema de pago​ y mercancía.​​Fue concebida en 2008, ​ por una entidad conocida bajo el seudónimo de Satoshi Nakamoto, cuya identidad concreta se desconoce</p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="images/testnet.png" alt="testnet">
                <div class="card-body">
                    <h5 class="card-title">Testnet</h5>
                    <p class="card-text">
                        Una red testnet es una herramienta imprescindible en el desarrollo de criptomonedas como Bitcoin. Gracias a este tipo de redes los equipos de desarrollo pueden hacer pruebas sin afectar el funcionamiento de la red original.</p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="images/blockcypher.jpg" alt="blockcypher" width="50" height="140">
                <div class="card-body">
                    <h5 class="card-title">BlockCypher</h5>
                    <p class="card-text">Ofrece los servicios de RESTful para poder interactuar con blockchain y lo hacen mediante transferencia de datos en lenguaje JSON. Las consultas pueden ser realizadas mediante http o https.</p>
                </div>
            </div>
        </div>

    @include('layouts.partials.page')
    <div class="alert alert-success" style="display:none;">ALERTXXXX  {{ $success ?? 'CCCC' }}</div>

    {{--{{ request()->routeIs('') ? 'hola' : 'no Hola' }}--}}
    {{-- {{ var_dump( request()) }}--}}
    {{-- {{ dump( request()) }} --}}

@endsection


