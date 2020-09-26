@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Buscar Transferencias</h2></div>
                    <div class="card-body">

                        <form action="addressFullCallApi" method="post" >
                            {{@csrf_field()}}
                            <div class="container">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           id="address"
                                           placeholder="Address"
                                           name="address"
                                           value="{{  $user['address'] ?? ''}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="number"
                                           class="form-control"
                                           id="limit"
                                           placeholder="Numero de busquedas que desea realizar"
                                           name="limit"
                                           value="{{ old('limit')}}"
                                    >
                                    @error('limit')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                                <hr>
                                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Enviar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @isset($data)
            {{-- json_decode($data, true) --}}
            {{ $data['address'] }}
        @endisset
    </div>
@endsection
