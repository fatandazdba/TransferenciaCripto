<?php

namespace App\Http\Controllers;

use App\Transferencia;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Http\Client\Exception\HttpException;
use http\Client\Response;
use GuzzleHttp\Exception\RequestException;

class TransferenciaController extends AppBaseController
{

    public $messages = [
        'required' => 'The :attribute field is required.',
        'address' => 'The :attribute is incorrect.',
        'min' => 'The :attribute is too short. (At least 6 characters)'
    ];

    /**
     * GET | Muestra el detalle de las 50 transferencias realizadas con un address especifico
     *
     * @return \Illuminate\Http\Response
     */
    public function addressFull(Request $request)
    {
        $token = env("BLOCKCYPHER_API_TOKEN");
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ];

        $params = [
            'limit' => '50',
            'Token' => $token,
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'address' => 'required',
        ], $this->messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['data' => $error], 400);
        }

        $url = 'https://api.blockcypher.com/v1/btc/test3/addrs/' . $request->address . '/full?limit=50';

        try {
            $client = new Client(['base_uri' => $url]);
            $response = $client->get($url, [
                    'headers' => $headers,
                    'json' => $params
                ]
            );
            $bodyResponseString = $response->getBody()->getContents();
            $bodyResponse = json_decode($bodyResponseString);
            return $bodyResponseString;


        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                if ($e->getResponse()->getStatusCode() == '400') {
                    return $e->getMessage();
                }
            }
            return $e->getMessage();
        } catch (ClientException $e) {
            if ($e->getMessage() . indexOf("cannot be both set") >= 0) {
                return Redirect::back()->withErrors('alert-danger', 'API error');
            } else {
                return Redirect::back()->withErrors('alert-danger', 'API error: ' . $e->getMessage());
            }
        }
    }

    /**
     * GET | Muestra el detalle de las 50 transferencias realizadas con un address especifico
     *
     * @return \Illuminate\Http\Response
     */
    public function balanceAddress(Request $request)
    {
        $token = env("BLOCKCYPHER_API_TOKEN");
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ];

        $params = [
            'limit' => '50',
            'Token' => $token,
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'address' => 'required',
        ], $this->messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['data' => $error], 400);
        }

        $address = 'https://api.blockcypher.com/v1/btc/test3/addrs/' . $request->address . '/balance';

        try {
            $client = new Client(['base_uri' => $address]);
            $response = $client->get($address, [
                    'headers' => $headers,
                    'json' => $params
                ]
            );
            $bodyResponseString = $response->getBody()->getContents();
            $bodyResponse = json_decode($bodyResponseString);
            return $bodyResponseString;


        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                if ($e->getResponse()->getStatusCode() == '400') {
                    return $e->getMessage();
                }
            }
            return $e->getMessage();
        } catch (ClientException $e) {
            if ($e->getMessage() . indexOf("cannot be both set") >= 0) {
                return Redirect::back()->withErrors('alert-danger', 'API error');
            } else {
                return Redirect::back()->withErrors('alert-danger', 'API error: ' . $e->getMessage());
            }
        }
    }

    /**
     * GET | Muestra el detalle de las transferencia por medio del hash
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionHashEndpoint(Request $request)
    {
        $token = env("BLOCKCYPHER_API_TOKEN");
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ];

        $params = [
            'limit' => '50',
            'Token' => $token,
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'hash' => 'required',
        ], $this->messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['data' => $error], 400);
        }

        $url = 'https://api.blockcypher.com/v1/btc/test3/txs/' . $request->hash;

        try {
            $client = new Client(['base_uri' => $url]);
            $response = $client->get($url, [
                    'headers' => $headers,
                    'json' => $params
                ]
            );
            $bodyResponseString = $response->getBody()->getContents();
            $bodyResponse = json_decode($bodyResponseString);
            return $bodyResponseString;


        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                if ($e->getResponse()->getStatusCode() == '400') {
                    return $e->getMessage();
                }
            }
            return $e->getMessage();
        } catch (ClientException $e) {
            if ($e->getMessage() . indexOf("cannot be both set") >= 0) {
                return Redirect::back()->withErrors('alert-danger', 'API error');
            } else {
                return Redirect::back()->withErrors('alert-danger', 'API error: ' . $e->getMessage());
            }
        }
    }

    /**
     * POST | Crea una nueva bitcoin address para un usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function address(Request $request)
    {
        $token = env("BLOCKCYPHER_API_TOKEN");
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ];

        $params = [
            'limit' => '50',
            'Token' => '0cd201f0d5dd406c8c227751c3be22e4',
        ];

        $url = 'https://api.blockcypher.com/v1/btc/test3/addrs';

        try {
            $client = new Client(['base_uri' => $url]);
            $response = $client->post($url, [
                    'headers' => $headers,
                    'json' => $params
                ]
            );
            $bodyResponseString = $response->getBody()->getContents();
            $bodyResponse = json_decode($bodyResponseString);
            return $bodyResponseString;


        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                if ($e->getResponse()->getStatusCode() == '400') {
                    return $e->getMessage();
                }
            }
            return $e->getMessage();
        } catch (ClientException $e) {
            if ($e->getMessage() . indexOf("cannot be both set") >= 0) {
                return Redirect::back()->withErrors('alert-danger', 'API error');
            } else {
                return Redirect::back()->withErrors('alert-danger', 'API error: ' . $e->getMessage());
            }
        }
    }

    /**
     * Crea una nueva microTransferencia
     *
     * @return \Illuminate\Http\Response
     */
    public function microTransferencia(Request $request)
    {
        $token = env("BLOCKCYPHER_API_TOKEN");
        /*$headers = [
            //'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $form_params = [
            'from_pubkey' => str_replace(' ', '', $request->from_pubkey),
            'from_private' => str_replace(' ', '', $request->from_private),
            'to_address' => str_replace(' ', '', $request->to_address),
            'value_satoshis' => str_replace(' ', '', $request->value_satoshis),
            'token' => str_replace(' ', '', $token),
        ];*/

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'from_pubkey' => 'required',
            'from_private' => 'required',
            'to_address' => 'required',
            'value_satoshis' => 'required',
            'token' => 'required',
        ], $this->messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['data' => $error], 400);
        }

        $url = 'https://api.blockcypher.com/v1/btc/test3/txs/micro';

        try {
            $client = new Client(['base_uri' => $url]);
            $response = $client->post($url, [

                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],

                    'form_params' => [
                        'from_pubkey' => str_replace(' ', '', $request->from_pubkey),
                        'from_private' => str_replace(' ', '', $request->from_private),
                        'to_address' => str_replace(' ', '', $request->to_address),
                        'value_satoshis' => str_replace(' ', '', $request->value_satoshis),
                        'token' => str_replace(' ', '', $token),
                    ]
                ]
            );
            $bodyResponseString = $response->getBody()->getContents();
            $bodyResponse = json_decode($bodyResponseString);
            return $bodyResponseString;

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                if ($e->getResponse()->getStatusCode() == '400') {
                    return $e->getMessage();
                }
            }
            return $e->getMessage();
        } catch (ClientException $e) {
            if ($e->getMessage() . indexOf("cannot be both set") >= 0) {
                return Redirect::back()->withErrors('alert-danger', 'API error');
            } else {
                return Redirect::back()->withErrors('alert-danger', 'API error: ' . $e->getMessage());
            }
        }
    }

}
