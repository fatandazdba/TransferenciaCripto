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
                                <th>Hash</th>
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
                                    <td class="text-center">{{ $datos["txs"][$x]['outputs'][0]['value'] }}</td>
                                    <td data-title="{{$datos["txs"][$x]["hash"] }}" title="{{$datos["txs"][$x]["hash"] }}">
                                        <!--a href="#"> {{ substr ($datos["txs"][$x]["hash"], 0 , 3)  }}...</a-->

                                        <form action="balanceAddress" method="GET" >
                                            {{@csrf_field()}}
                                            <div class="container">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control"
                                                           id="hash"
                                                           name="hash"
                                                           value="{{ $datos["txs"][$x]["hash"] }}"
                                                    >
                                                </div>
                                                <input id="btn_hash" class="btn btn-sm" type="submit" value="{{ substr ($datos["txs"][$x]["hash"], 0 , 3)  }}...">
                                            </div>
                                        </form>

                                    </td>
                                    <td class="text-center">{{ $datos["txs"][$x]['confirmations'] }}/6</td>
                                    <td class="text-center">


                                        @if($datos["txs"][$x]['confirmations'] >= 6)
                                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="top_check bi bi-check-all" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992a.252.252 0 0 1 .02-.022zm-.92 5.14l.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486-.943 1.179z"/>
                                            </svg>
                                        @endif
                                        @if($datos["txs"][$x]['confirmations'] < 6)
                                                <svg width="2em" height="2em" viewBox="0 0 16 16" class="top_check bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                                </svg>
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