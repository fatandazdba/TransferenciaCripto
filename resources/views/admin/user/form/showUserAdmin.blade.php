<form action="showUserAdmin" method="GET">
    <div class="container">
        <div class="form-group">
            <input type="hidden" class="form-control"
                   id="user_id"
                   name="user_id"
                   value="{{ $user->id }}"
            >
        </div>
        <input id="btn_hash" class="btn btn-sm" type="submit" value="Editar">
    </div>
</form>