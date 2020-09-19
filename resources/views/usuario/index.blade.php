@extends('layouts.admin')
	@include('alerts.success')
	@section('content')
	<?php
/*		$flights = \Transferencia\User::all();
		foreach ($flights as $flight) {
    		echo $flight->name;
		}*/
	?>
	<div class="users">
		<table class="table">
			<thead>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Operacion</th>
			</thead>
			@foreach($users as $user)
				<tbody>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>
						{!!link_to_route('usuario.edit', $title = 'Editar', $parameters = $user, $attributes = ['class'=>'btn btn-primary'])!!}
					</td>
				</tbody>
			@endforeach
		</table>
		{!!$users->render()!!}
	</div>


     <!--  get consulta get  -->
{{--	{!!Form::open(['route'=>'address', 'method'=>'GET'])!!}
	<div class="form-group">

		{!!Form::address('address',null,['class'=>'form-control', 'value'=>'oIz7F2qkBtP45coFq50QmApWzNK4MPpV','placeholder'=>'Address: n3AmuXTmVtPRZfm1zqZG5bVFR4QGxZM2RE'])!!}

	</div>
	{!!Form::submit('Iniciar',['class'=>'btn btn-primary'])!!}
	{!!Form::close()!!}--}}






	@endsection
	@section('scripts')
		{!!Html::script('js/script3.js')!!}
	@endsection