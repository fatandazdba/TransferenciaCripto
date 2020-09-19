<?php

namespace TransferenciaCripto\Http\Controllers;

use Illuminate\Http\Request;

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
    public function addressFull()
    {
        return view('transferencia.addressFull');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function microTransaccion()
    {
        return view('transferencia.microTransaccion');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function balanceAddress()
    {
        return view('transferencia.balanceAddress');
    }
}
