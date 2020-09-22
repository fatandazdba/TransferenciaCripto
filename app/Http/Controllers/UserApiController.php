<?php

namespace TransferenciaCripto\Http\Controllers;

use TransferenciaCripto\Transferencia;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use TransferenciaCripto\User;
use GuzzleHttp\Client;
use Http\Client\Exception\HttpException;
use http\Client\Response;
use http\Exception;
use Session;
use Validator;
use DB;
use Auth;

use GuzzleHttp\Exception\RequestException;
class UserApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $messages = [
        'required' => 'The :attribute field is required.',
        'email' => 'The :attribute is incorrect.',
        'min' => 'The :attribute is too short. (At least 6 characters)'
    ];

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function createTransferencia(Request $request, $data)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($data, [
            'hash' => 'required',
            'user_id' => 'required',
        ], $this->messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['data' => $error], 400);
        }

        try {
            DB::beginTransaction();
            $transference = Transferencia::create([
                'hash' => $data["hash"],
                'user_id' => $data["user_id"],
            ]);
            DB::commit();
            return response()->json(['message' => 'Successfully created!', 'Transferencia' => $transference], 201);

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
        }catch (ex $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
