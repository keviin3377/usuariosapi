<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\support\Facades\Hash;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
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
     $existentemail = Usuario:: where('email', $request->email)->get();
     $existentedoc = Usuario:: where('documento', $request->documento)->get();
     if ($existentedoc->count()!=0 and $existentemail->count()!=0) {
        return 'Error: El correo y documento ya estan registrados en el sistema';
       } 
     if ($existentedoc->count()!=0) {
        //  echo $existentedoc;
        return 'Error: El documento ya esta registrado';
    }
    if ($existentemail->count()!=0) {
        // echo $existentemail;
        return 'Error: El email ya esta registrado';
}
 

    $usuario = new Usuario();
    $usuario->documento = $request->documento;
    $usuario->name = $request->name;
    $usuario->email = $request->email;
    $usuario->password = Hash::make ($request->password);
    $usuario->save();
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($dato)
    {
        $field =  filter_var($dato, FILTER_VALIDATE_EMAIL) ? 'email' : 'id';

        $usuario = Usuario::where($field, $dato)->first();

        if ($usuario->count() == 0 ) {
            return 'Error: El usuario no encontrado';  
        }
        return $usuario;
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
        return Usuario::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Usuario::destroy($id);
    }
}
