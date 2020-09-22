@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">


        <div class="row justify-content-center">

            @isset($datos)
                <div id="Balance_full_address" class="col-md-8">
                    <div class="dash dash-3">
                        <ul class="text-center">
                            <li>
                                <span class="dash-label">Address</span><br>
                                {{ $datos['address'] }}
                            </li>
                            <li>
                                <span class="dash-label">Received</span><br>
                                {{ $datos['total_received'] }} BTC
                            </li>
                            <li>
                                <span class="dash-label">Sent</span><br>
                                {{ $datos['total_sent'] }} BTC
                            </li>
                            <li>
                                <span class="dash-label">Balance</span><br>
                                {{ $datos['balance'] }} BTC
                            </li>
                            <li>
                                <span class="dash-label float-right">Total number of transfers: <strong><em>{{$datos['n_tx']}}</em></strong></span><br>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>


                <div class="col-md-10 table-responsive top_marginn">
                    <div class="dash dash-3">
                        <h2>Transferencias</h2>
                        <p>La tabla contiene la informacion de las transaferencias realizadas.</p>
                        <table class="table table-hover background_white">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Form</th>
                                <th>to</th>
                                <th>hash</th>
                                <th>Value (BTC)</th>
                                <th>Confirmación</th>
                                <th col-md-2></th>
                            </tr>
                            </thead>
                            <tbody>

                            @for($x = 0; $x < count($datos['txs']); $x++ )
                                <tr>
                                    <td class="text-center">{{$x+1}}</td>
                                    <td>{{ $datos["txs"][$x]["inputs"][0]['addresses'][0] }}</td>
                                    <td>{{ $datos["txs"][$x]['outputs'][0]['addresses'][0] }}</td>
                                    <td>{{ $datos["txs"][$x]['hash'] }}</td>
                                    <td class="text-center">{{ $datos["txs"][$x]['outputs'][0]['value'] }}</td>
                                    <td class="text-center">{{ $datos["txs"][$x]['confirmations'] }}/6</td>
                                    <td class="text-center">
                                        @if($datos["txs"][$x]['confirmations'] >= 6)
                                            <img class="" src="images/visto.png" alt="transferencia en comprobación"
                                                 width="20" height="20">
                                        @endif
                                        @if($datos["txs"][$x]['confirmations'] < 6)
                                            <img class="" src="images/esperarconfirmacion.png"
                                                 alt="transferencia en comprobación" width="20" height="20">
                                        @endif
                                    </td>
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