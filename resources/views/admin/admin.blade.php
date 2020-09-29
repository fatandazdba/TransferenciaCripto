@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">

        <h1>Users</h1>
        <div class="users">
            <table class="table">
                <thead>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Address</th>
                <th></th>
                <th></th>
                </thead>
                @foreach($users as $user)
                    <tbody>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->address}}</td>
                    <td>
                        @include('admin.user.form.showUserAdmin')
                    </td>
                    <td>
                        @include('admin.user.form.addressFull')
                    </td>
                    </tbody>
                @endforeach
            </table>
            {!!$users->render()!!}
        </div>

    </div>
@endsection


