<?php

namespace TransferenciaCripto\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TransferenciaCripto\User;
use TransferenciaCripto\Http\Controllers\UserApiController;
use Session;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    public function userShow(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return view("usuario.edit", compact('user'));
    }

    public function userEdit(Request $request)
    {
        $user = new UserApiController();
        $datos = $user->updateUser($request);
        Session::flash('message', "Los datos han sido actualizados de manera correcta.");

        if (Auth::user()->admin === 1) {
            return redirect()->back();
        } else {
            return redirect()->route('userShow', $request);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
