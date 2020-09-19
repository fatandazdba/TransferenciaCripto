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
    </div>

    @include('layouts.partials.page')
    <div class="alert alert-success" style="display:none;">ALERTXXXX  {{ $success ?? 'CCCC' }}</div>

    {{--{{ request()->routeIs('') ? 'hola' : 'no Hola' }}--}}
    {{-- {{ var_dump( request()) }}--}}
    {{-- {{ dump( request()) }} --}}

@endsection


