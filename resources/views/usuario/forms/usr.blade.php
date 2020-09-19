<div class="form-group">
		{!!Form::label('nombre','Nombre:')!!}
		{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('email','Correo:')!!}
		{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>
<div class="form-group">
	{!!Form::label('telephone','Telefono:')!!}
	{!!Form::text('telephone',null,['class'=>'form-control','placeholder'=>'Ingresa el telefono del usuario'])!!}
</div>
<div class="form-group">
	{!!Form::label('date_of_birth','Fecha de nacimiento:')!!}
	{!!Form::input('dateTime-local','date_of_birth',null,['class'=>'form-control','placeholder'=>'Ingresa la fecha de nacimiento'])!!}
</div>
	<div class="form-group">
		{!!Form::label('password','Contraseña:')!!}
		{!!Form::password('password',['class'=>'form-control','placeholder'=>'Ingresa el Nombre del usuario'])!!}
	</div>