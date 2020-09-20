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
/*
    public function createUser(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], $this->messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['data' => $error], 400);
        }

        try {
            $user = User::Create([
                'firstname' => $request->name,
                'email' => $request->email,
                'lastname' => $request->lastName,
                'mobile' => $request->mobile,
                'password' => bcrypt($request->password),
                'roles_id' => 1,
            ]);
            return response()->json(['message' => 'Successfully created user!', 'user' => $user], 201);

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

    public function updateUser(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required',
            'lastName' => 'required',
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
            $user = User::find($request->User_id);
            $user->firstname = $request->name;
            $user->lastname = $request->lastName;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->save();
            DB::commit();

            return response()->json(['message' => 'Successfully update user!', 'user' => $user], 200);

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

    public function getAddressByEmail(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'email' => 'required|email',
        ], $this->messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['data' => $error], 400);
        }
        $credential = $request->only('email');
        try {
            if (sizeof((User::firstOrFail()->where('email', $request->email)->get())) > 0) {
                $entity = DB::table('entities_bitcoin_address')
                    ->join('users', 'users.id', '=', 'entities_bitcoin_address.users_id')
                    ->select('users.*', 'entities_bitcoin_address.bitcoin_address')
                    ->where('email', 'LIKE', "%{$request->email}%")->where('active', 1)->first();

                if (empty($entity->id)) {
                    return response()->json(['data' => 'Access denied. User does not have an associated bitcoin address.'], 404);
                } else {
                    $user = [
                        'address' => $entity->bitcoin_address
                    ];
                    return response()->json(['user' => $user,], 200);
                }
            } else {
                return response()->json(['data' => 'Access denied, email not found.'], 401);
            }
        } catch (RequestException $e) {
            return response()->json(['data' => $e], 500);
        }
    }

    public function recoveryPassword(Request $request)
    {
        $random_password = str_random(8);
        $hashed_random_password = Hash::make($random_password);

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'email' => 'required|email',
        ], $this->messages);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['message' => ['Error, The email is incorrect.', 1062]], 200);
        }
        try {
            DB::beginTransaction();
            $user = User::where('email', $request->email)->first();
            if (empty($user->email)) {
                return response()->json(['message'=>['Error, User was not found.', 1062]], 200);
            } else {
                $user->password = $hashed_random_password;
                $user->save();
                DB::commit();

                try{
                Mail::send('mails.recoverypassword', ['user' => $user, 'random_password' => $random_password], function ($message) use ($user) {
                    $message->from(env('MAIL_FROM'), 'Recovery password');
                    $message->to($user->email)
                        ->subject('Recovery password');
                });
                return response()->json(['message' => ['Successfully, please check your email','ok','user' => $user->email], ], 200);
                }catch (Exception $e) {
                    DB::rollback();
                    return response()->json(array('message' => $e->errorInfo));
                }
            }
        } catch (QueryException $ex) {
            DB::rollback();
            return response()->json(array('message' => $ex->errorInfo));
        } catch (RequestException $e) {
            DB::rollback();
            //return $e->getMessage();
            return response()->json(array('message' => $e->errorInfo));
        } catch (ClientException $e) {
            DB::rollback();
            return response()->json(array('message' => $e->errorInfo));
        }
    }
*/
}
