<?php

namespace TransferenciaCripto\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use TransferenciaCripto\Http\Controllers\TransferenciaApiController;
use Session;
use TransferenciaCripto\User;
use TransferenciaCripto\Transferencia;

class TransferenciaController extends Controller
{
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
        return view('transferencia.addressFull');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewMicroTransaccion(Request $request)
    {
        $user = User::find(Auth::user()->id);
        echo("<script>console.warn('" . "ID: " . $user->address . "');</script>");
        return view('transferencia.microTransaccion', compact('user'));
    }

    public function microTransaccion(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            echo("<script>console.warn('" . "MESSAJE: " . json_encode($user) . "');</script>");

            $from_pubkey = $request->get('from_pubkey');
            $from_private = $request->get('from_private');
            $to_address = $request->get('to_address');
            $value_satoshis = $request->get('value_satoshis');


            echo("<script>console.warn('" . "from_pubkey : " . $from_pubkey . "');</script>");
            echo("<script>console.warn('" . "from_private : " . $from_private . "');</script>");
            echo("<script>console.warn('" . "to_address : " . $to_address . "');</script>");
            echo("<script>console.warn('" . "value_satoshi : " . $value_satoshis . "');</script>");


            $transferencia = new TransferenciaApiController();
            $enviar = $transferencia->microTransferencia($request);
            $recibir_encode = json_encode($enviar, true);
            $recibir_decode = json_decode($recibir_encode, true);

            $getHash = json_decode($enviar, true);
            print_r($getHash);        // Dump all data of the Array
            echo $getHash["hash"];


            //dd($recibir_decode);
            var_dump($recibir_decode);
            var_dump("ENVIAR: " . (e($enviar)));
            $mensajes_errores = [
                "The from pubkey field is required." => 'La clave publica es requerida',
                "The from private field is required." => 'La clave privada es requerida',
                "The to address field is required." => 'El address destinatario es requerido',
                "The value satoshis field is required." => 'El monto es requerido',
                "The token field is required" => "Se necesita permisos para enviar, comuniquese con el administrador",
                "From pubkey hex encoding error" => "Error en la clave publica, verifique que sea la correcta!",
                "From private hex encoding error" => "Error en la clave privada, verifique que sea la correcta!",
                "Error building micro transaction: Error building transaction: Address" => "Error en address destinatario, verifique que sea la correcta!",
                "Micro transactions are limited to values between 7000 and 4000000 satoshis" => "Las transacciones estan limitadas entre valores 7000 y 4000000 satoshis",
                "Error while retrieving address" => "Error, verifique que el address sea correcto",
            ];


            $mensaje_from_cypher="";
            $hash="";
            var_dump("MENSAJE FROM BLOCKCYPHER: " .$mensaje_from_cypher);
            if (isset($getHash["hash"])) {
                $hash=$getHash["hash"];
            }
            else if (is_string($recibir_decode)) {
                $mensaje_from_cypher = e($enviar);
            } else if (is_array($recibir_decode)) {
                if (isset($recibir_decode["original"]["data"])) {
                    $mensaje_from_cypher = $recibir_decode["original"]["data"];
                }
                else{
                    //
                }
            }
            var_dump("MENSAJE FROM BLOCKCYPHER: " .$mensaje_from_cypher);
            foreach (array_keys($mensajes_errores) as $mensaje) {
                var_dump("FOR: " .$mensaje);
                var_dump("strpos: " . strpos($mensaje_from_cypher, $mensaje));
                if (strpos($mensaje_from_cypher, $mensaje) === 0 || strpos($mensaje_from_cypher, $mensaje) > 0) {
                    Session::flash('message-error', $mensajes_errores[$mensaje]);
                    break;
                }
            }

            //array_push($recibir_decode["original"]['data'], ["Error" =>'xxxxxxxxxx']);
            //dd(is_array($recibir_decode));
            echo "<pre>" . print_r($recibir_decode) . "</pre>";
            echo "<pre>" . print_r("HASH: ". $hash) . "</pre>";
            if (isset($hash)){
                $userApiController = new UserApiController();
                $saveHashInTransferencia = $userApiController->createTransferencia($request, ['hash' => $hash, 'user_id'=> $user['id']]);
                if(isset($saveHashInTransferencia->id)){
                    Session::flash('message', "La transferencia se ha realizado de manera correcta");
                }
            }

            //echo("<script>console.warn('" . "ENVIAR: " . json_encode($enviar) . "');</script>");
            echo "<pre>" . print_r($getHash) . "</pre>";
            //echo("<script>console.warn('" . "RECIBIR ENCODE: " . $recibir_decode . "');</script>");
            echo("<script>console.warn('" . "RECIBIR DECODE: " . e(json_encode($recibir_decode)) . "');</script>");
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
