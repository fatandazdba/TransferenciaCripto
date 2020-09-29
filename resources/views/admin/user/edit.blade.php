@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Actualizar usuario</h2></div>
                    <div class="card-body">

                        <form action="userEdit" method="POST" >
                            {{@csrf_field()}}
                            <div class="container">
                                <div class="form-group">
                                    <input type="hidden" class="form-control"
                                           id="id_user"
                                           name="id_user"
                                           value="{{  $user->id}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           id="name"
                                           placeholder="Name"
                                           name="name"
                                           value="{{ old('name', $user->name)}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control"
                                           id="email"
                                           placeholder="Email"
                                           name="email"
                                           value="{{ old('email', $user->email)}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control"
                                           id="address"
                                           placeholder="Address"
                                           name="address"
                                           value="{{ old('address', $user->address)}}"
                                    disabled>
                                </div>
                                <hr>
                                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Editar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection