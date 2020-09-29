<?php

namespace TransferenciaCripto\Http\Controllers;

use TransferenciaCripto\Transferencia;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Http\Client\Exception\HttpException;
use Http\Client\Response;
use GuzzleHttp\Exception\RequestException;

/**
 * @OA\Info(title="API Transferenciacripto", version="1.0")
 *
 * @OA\Server(url="http://127.0.0.1:8000/")
 */
class TransferenciaApiController extends Controller
{

    public $messages = [
        'required' => 'The :attribute field is required.',
        'address' => 'The :attribute is incorrect.',
        'min' => 'The :attribute is too short. (At least 6 characters)'
    ];

    /**
     * @OA\Get(
     *     path="/api/chainEndPoint",
     *     summary="The returned object contains a litany of information about the blockchain, including its height, the time / hash of the last block, and more.",
     *     @OA\Response(
     *         response=200,
     *         description="json"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="The hash field is required."
     *     )
     * )
     */
    public function chainEndPoint(Request $request)
    {
        $token = env("BLOCKCYPHER_API_TOKEN");
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ];

        $params = [
            'Token' => $token,
        ];

        $url = 'https://api.blockcypher.com/v1/btc/test3/';

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
     * @OA\Get(
     *     path="/api/addressFull",
     *     summary="Shows the details of the transfers made with a specific address.",
     *
     *     @OA\Parameter(
     *         name="address",
     *         in="query",
     *         description="Address of the transfers to search",
     *         required=true,
     *         @OA\Schema(
     *         type="string",
     *         ),
     *         style="form"
     *     ),
     *    @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Number of searches",
     *         required=true,
     *         @OA\Schema(
     *         type="integer",
     *         ),
     *         style="form"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="json"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="All fields are required."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Bad request
     * "
     *     ),
     * )
     */
    public function addressFull(Request $request)
    {
        $token = env("BLOCKCYPHER_API_TOKEN");
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ];

        $params = [
            'limit' => $request->limit,
            'Token' => $token,
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'address' => 'required',
            'limit' => 'required'
        ], $this->messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['data' => $error], 400);
        }

        $url = 'https://api.blockcypher.com/v1/btc/test3/addrs/' . $request->address . '/full?limit=' . $request->limit;

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
     * @OA\Get(
     *     path="/api/balanceAddress",
     *     summary="Show the balance through the address.",
     *
     *     @OA\Parameter(
     *         name="address",
     *         in="query",
     *         description="Address of the balance to search",
     *         required=true,
     *         @OA\Schema(
     *         type="string",
     *         ),
     *         style="form"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="json"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="The address field is required."
     *     )
     * )
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
     * @OA\Get(
     *     path="/api/transactionHashEndpoint",
     *     summary="Get transaction information based on its hash",
     *
     *     @OA\Parameter(
     *         name="hash",
     *         in="query",
     *         description="Hash of the transfer made",
     *         required=true,
     *         @OA\Schema(
     *         type="string",
     *         ),
     *         style="form"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="json"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="The hash field is required."
     *     )
     * )
     */
    public function transactionHashEndpoint(Request $request)
    {
        $token = env("BLOCKCYPHER_API_TOKEN");
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ];

        $params = [
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
     * @OA\Post(path="/api/address",
     *   summary="Create a new bitcoins address for a user",
     *   @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *       )
     *   ),
     *   @OA\Response(response="200", description="successful operation")
     * )
     */
    public function address(Request $request)
    {
        $token = env("BLOCKCYPHER_API_TOKEN");
        $headers = [
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ];

        $params = [
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
     * @OA\Post(
     * path="/api/microTransferencia",
     * description="Make a transfer to an address by entering your public, private key, address and value in satoshis",
     * @OA\RequestBody(
     *    required=true,
     *    description="Data required",
     *    @OA\JsonContent(
     *       required={"from_pubkey","from_private", "to_address", "value_satoshis"},
     *       @OA\Property(property="from_pubkey", type="string", example="0359f12e977d2c46526ce084c96afb476b50b0262245ed8d25c0960e68e7c3cdec"),
     *       @OA\Property(property="from_private", type="string", example="d9ed9f7232ec4e8d1ad217a09dc18642ac19feea8a060461545313a2d2d25b1f"),
     *       @OA\Property(property="to_address", type="string", example="mgP6ca1ZXjhgsjzdFfmBH9jMVUMpWV8jYt"),
     *       @OA\Property(property="value_satoshis", type="integer", example="7500"),
     *    ),
     * ),
     *  @OA\Response(
     *    response=200,
     *    description="Successful",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Data was created without errors")
     *        )
     *     )
     * )
     */
    public function microTransferencia(Request $request)
    {
        //$token = env("BLOCKCYPHER_API_TOKEN");
        $token = "0cd201f0d5dd406c8c227751c3be22e4";

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'from_pubkey' => 'required',
            'from_private' => 'required',
            'to_address' => 'required',
            'value_satoshis' => 'required',
            //'token' => 'required',
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
                        "from_pubkey" => "$request->from_pubkey",
                        "from_private" => "$request->from_private",
                        "to_address" => "$request->to_address",
                        "value_satoshis" => "$request->value_satoshis",
                        "token" => "$token",
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
