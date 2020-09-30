<form action="transaccion" method="post" >
    {{@csrf_field()}}
    <div class="container">
        <h3>Nueva Transferencia</h3>
        <hr>
        <div class="form-group">
            <input type="text" class="form-control"
                   id="from_pubkey"
                   placeholder="Clave publica"
                   name="from_pubkey"
                   value="{{ old('from_pubkey')}}"
            >
        </div>
        <div class="form-group">
            <input type="text"
                   class="form-control"
                   id="from_private"
                   placeholder="Clave privada"
                   name="from_private"
                   value="{{ old('from_private')}}"
            >
        </div>
        <div class="form-group">
            <input type="text"
                   class="form-control"
                   id="to_address"
                   placeholder="Address destinatario"
                   name="to_address"
                   value="{{ old('to_address')}}"
            >
        </div>
        <div class="form-group">
            <input type="number"
                   class="form-control"
                   id="value_satoshis"
                   placeholder="Monto (satoshis)"
                   name="value_satoshis"
                   value="{{ old('value_satoshis')}}"
            >
        </div>

        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Enviar">
    </div>
</form>