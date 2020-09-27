@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">


        <div class="row justify-content-center">

            @isset($datos)

                <div class="col-md-10 {{--table-responsive--}} top_marginn">
                    <div class="dash dash-3">
                        <h2>Transferencias</h2>
                        <p>Informacion de transaferencias realizadas por <strong class="dash-label color-size-address"><em>{{ $datos['address'] }}</em></strong>.</p>
                        <table class="table table-hover background_white">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Form</th>
                                <th>to</th>
                                <th>Value (BTC)</th>
                                <th>Confirmación</th>
                            </tr>
                            </thead>
                            <tbody>

                            @for($x = 0; $x < count($datos['txs']); $x++ )
                                <tr>
                                    <td class="text-center">{{$x+1}}</td>
                                    <td>{{ $datos["txs"][$x]["inputs"][0]['addresses'][0] }}</td>
                                    <td>{{ $datos["txs"][$x]['outputs'][0]['addresses'][0] }}</td>
                                    <td class="text-center">{{ $datos["txs"][$x]['outputs'][0]['value'] }}</td>
                                    <td class="text-center">{{ $datos["txs"][$x]['confirmations'] }}/6</td>

                                </tr>
                            @endfor

                            </tbody>
                        </table>
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection