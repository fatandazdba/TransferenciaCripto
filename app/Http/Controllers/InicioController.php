<?php

namespace TransferenciaCripto\Http\Controllers;

use Illuminate\Foundation\Providers\FormRequestServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use TransferenciaCripto\Http\Controllers\TransferenciaApiController;

class InicioController extends Controller
{
    public function inicio(Request $request)
    {
        return view('welcome');
    }

    public function callAddress(Request $request)
    {
        $success = ['success'=>'asas'];
        $view = view('layouts.partials.page', $success)->render();

        $html = View::make('layouts.partials.page', compact('success'))->render();
        return response()->json(['success'=>'asas', 'view'=>$view]);


    }

    public function addressSearchApi(Request $request)
    {
        $transferenciaApi = new TransferenciaApiController();
        $data = $transferenciaApi->addressFull($request);
        $datos= json_decode($data, true);

        echo ("<script>console.warn('" . "MESSAJE: ". json_encode($datos) . "');</script>");
        return view('search' , compact('datos'));
    }

}
