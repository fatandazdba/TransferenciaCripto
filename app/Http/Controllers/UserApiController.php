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

    /**
     * Edit user
     * @param
     * @return  id
     */

    public function updateUser(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            //'password' => 'required|min:6',
            //'confirmPass' => 'required|same:password',
        ], $this->messages);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['data' => $error], 400);
        }
        try {
            DB::beginTransaction();
            $user = User::find($request->id_user);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            DB::commit();

            return response()->json( $user,200);

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
        }
    }

    /**
     * Get all users
     *
     * @return  json of Users
     */

    public function getUsers(Request $request)
    {
        try {
            $users = User::all();

            return response()->json([
                'message' => 'Successfully get users!',
                'user' => $users
            ],
                200);

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
        }
    }
}
