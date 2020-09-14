<?php

namespace TransferenciaCripto\Http\Controllers;

use Illuminate\Foundation\Providers\FormRequestServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use TransferenciaCripto\Http\Controllers\TransferenciaController;

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
        //return view('layouts.partials.page', compact('success'));
        //return response()->json(view('layouts.partials.page',['success'=>'asas']));
        //return response()->json(['success'=>'asas', 'x' => 'zaza']);


        //$html = \view('layouts.partials.page', compact('success'))->render();
        $html = View::make('layouts.partials.page', compact('success'))->render();
        return response()->json(['success'=>'asas', 'view'=>$view]);

/*      $address= $request->address;
        $transferenciaController = new TransferenciaController();
        $addressFull = $transferenciaController->addressFull($address);
        var_dump($addressFull);
        return view(addressFull, compact($addressFull));*/

    }


}
