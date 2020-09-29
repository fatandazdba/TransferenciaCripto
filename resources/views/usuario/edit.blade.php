{{--
@extends('layouts.admin')
	@section('content')
	@include('alerts.request')
		{!!Form::model($user,['route'=>['usuario.update',$user],'method'=>'PUT'])!!}
			@include('usuario.forms.usr')
			{!!Form::submit('Actualizar',['class'=>'btn btn-primary'])!!}
		{!!Form::close()!!}

		{!!Form::open(['route'=>['usuario.destroy', $user], 'method' => 'DELETE'])!!}
			{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
		{!!Form::close()!!}
	@endsection--}}
@extends('layouts.app')

@section('content')
    @include('alerts.errors')
    @include('alerts.request')
    @include('alerts.success')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Mi cuenta</h2></div>
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

 {{--   <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            Marcus Doe
                        </div>
                        <div class="profile-usertitle-job">
                            Developer
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm">Follow</button>
                        <button type="button" class="btn btn-danger btn-sm">Message</button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active">
                                <a href="#">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Overview </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Account Settings </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="glyphicon glyphicon-ok"></i>
                                    Tasks </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="glyphicon glyphicon-flag"></i>
                                    Help </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    Some user related content goes here...
                </div>
            </div>
        </div>
    </div>
    <center>
        <strong>Powered by <a href="http://j.mp/metronictheme" target="_blank">KeenThemes</a></strong>
    </center>
    <br>
    <br>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>--}}
@endsection
