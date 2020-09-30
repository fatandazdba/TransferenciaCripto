<form action="userEdit" method="POST">
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
            <input type="text" class="form-control name"
                   id="name"
                   placeholder="Name"
                   name="name"
                   value="{{ old('name', $user->name)}}"
            >
        </div>
        <div class="form-group">
            <input type="text" class="form-control email"
                   id="email"
                   placeholder="Email"
                   name="email"
                   value="{{ old('email', $user->email)}}"
            >
        </div>
        <div class="form-group">
            <input type="text" class="form-control address"
                   id="address"
                   placeholder="Address"
                   name="address"
                   value="{{ old('address', $user->address)}}"
                   disabled
            >
        </div>
        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Editar">
    </div>
</form>