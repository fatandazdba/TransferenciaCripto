<form action="addressFullCallApi" method="post" >
    {{@csrf_field()}}
        <div class="form-group">
            <input type="hidden" class="form-control"
                   id="address"
                   placeholder="Address"
                   name="address"
                   value="{{  $user->address}}"
            >
        </div>
        <div class="form-group">
            <input type="hidden"
                   class="form-control"
                   id="limit"
                   placeholder="Numero de busquedas que desea realizar"
                   name="limit"
                   value="50"
            >
        </div>
        <input id="btn_hash_admin" class="btn btn btn-sm" type="submit" value="Transferencias">

</form>