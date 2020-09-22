<?php

namespace TransferenciaCripto\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use TransferenciaCripto\Http\Controllers\TransferenciaApiController;
use Session;
use TransferenciaCripto\User;
use TransferenciaCripto\Transferencia;

use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Http\Client\Exception\HttpException;
use Http\Client\Response;
use GuzzleHttp\Exception\RequestException;

class TransferenciaController extends Controller
{
    public const PORT = '8090';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addressFull(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return view('transferencia.addressFull', compact('user') );
    }

    public function addressFullCallApi(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $transferenciaApi = new TransferenciaApiController();
        $data = $transferenciaApi->addressFull($request);
        $datos= json_decode($data, true);

        return view('transferencia.addressFullHistory' , compact('datos'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewMicroTransaccion(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return view('transferencia.microTransaccion', compact('user'));
    }

    public function microTransaccion(Request $request)
    {
        try {
            $mensaje_from_cypher = "";
            $hash = "";

            $user = User::find(Auth::user()->id);

            //Llamar al metodo que realiza la transferencia
            $transferencia = new TransferenciaApiController();
            $enviar = $transferencia->microTransferencia($request);
            $recibir_encode = json_encode($enviar, true);
            $recibir_decode = json_decode($recibir_encode, true);

            //Obtenermos los datos desde blockcypher al ejecutar la transferencia de manera correcta
            $getHash = json_decode($enviar, true);
            //print_r($getHash);        // Dump all data of the Array

            $mensajes_errores = [
                "The from pubkey field is required." => 'La clave publica es requerida',
                "The from private field is required." => 'La clave privada es requerida',
                "The to address field is required." => 'El address destinatario es requerido',
                "The value satoshis field is required." => 'El monto es requerido',
                "The token field is required" => "Se necesita permisos para enviar, comuniquese con el administrador",
                "From pubkey hex encoding error" => "Error en la clave publica, verifique que sea la correcta!",
                "From private hex encoding error" => "Error en la clave privada, verifique que sea la correcta!",
                "Error building micro transaction: Error building transaction: Address" => "Error en address destinatario, verifique que sea la correcta!",
                "Micro transactions are limited to values between 7000 and 4000000 satoshis" => "Las transacciones estan limitadas entre valores de 7000 y 4000000 satoshis",
                "Error while retrieving address" => "Error, verifique que el address sea correcto",
            ];

            if (isset($getHash["hash"])) {
                $hash = $getHash["hash"];
            } else {
                if (is_string($recibir_decode)) {
                    $mensaje_from_cypher = e($enviar);
                } else if (is_array($recibir_decode)) {
                    if (isset($recibir_decode["original"]["data"])) {
                        $mensaje_from_cypher = $recibir_decode["original"]["data"];
                    } else {
                        //
                    }
                }
                foreach (array_keys($mensajes_errores) as $mensaje) {
                    if (strpos($mensaje_from_cypher, $mensaje) === 0 || strpos($mensaje_from_cypher, $mensaje) > 0) {
                        Session::flash('message-error', $mensajes_errores[$mensaje]);
                        break;
                    }
                }
            }

            //Se guarda el hash e user_id en la tabla transferencias
            if ($hash != null || $hash != '') {
                $userApiController = new UserApiController();
                $saveHashInTransferencia = $userApiController->createTransferencia($request, ['hash' => $hash, 'user_id' => $user['id']]);
                Session::flash('message', "La transferencia ha sido realizada de manera correcta");
                return redirect()->route('viewTransaccion');
            }

            return view('transferencia.microTransaccion');

        } catch (QueryException $ex) {
            DB::rollback();
            return response()->json(array('message' => $ex->errorInfo));
        } catch (RequestException $e) {
            DB::rollback();
            return $e->getMessage();
        } catch (ClientException $e) {
            DB::rollback();
            if ($e->getMessage() . indexOf("cannot be both set") >= 0) {
                return Redirect::back()->withErrors('alert-danger', 'API error');
            } else {
                return Redirect::back()->withErrors('alert-danger', 'API error: ' . $e->getMessage());
            }
        } catch (ex $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function balanceAddress(Request $request)
    {
        return view('transferencia.balanceAddress');
    }
}
