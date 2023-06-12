<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rol = Auth::user()->rol_id;

        $clientes = Cliente::where('estado', 'ACTIVO')->get();
        return view('clientes.index', compact('clientes', 'rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rol = Auth::user()->rol_id;
        $user = Auth::user()->id;
        return view('clientes.crear', compact('user' , 'rol'));
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
        request()->validate([
            'nombre_cliente' => 'required',
            'documento_identidad'=>'required|unique:clientes|numeric|digits_between:1,11'        
        ]);

        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('creado','ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $rol = Auth::user()->rol_id;
        $cliente = Cliente::find($id);
        if ($rol==1) {
            return view('clientes.editar',compact('cliente', 'rol'));
        }
    }
    public function inactivo()
    {
        //
        
        $rol = Auth::user()->rol_id;
        if ($rol==1) {
            $user = Auth::user()->id;
            $clientes = DB::table('clientes')
                ->select('id_cliente', 'nombre_cliente','documento_identidad', 'clientes.created_at')
                ->where('clientes.estado', 'INACTIVO')
                ->get();
    
                return view('clientes.inactivo', compact('clientes' ,'rol'));        
            }
            return redirect()->route('clientes.index');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activo($id)
    {
        $rol = Auth::user()->rol_id;
        if ($rol == 1) {
            $clientes = Cliente::find($id);
            if ($clientes->estado == 'INACTIVO') {
                $clientes->estado = 'ACTIVO';
                $clientes->save();
                return redirect()->route('clientes.inactivo')->with('Activado', 'ok');
            } else {
                return redirect()->route('clientes.inactivo')->with('error', 'El cliente ya está activo.');
            }
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
        request()->validate([
            'nombre_cliente' => 'required',
            'documento_identidad' => 'required|numeric|digits_between:1,10|unique:clientes,documento_identidad,'.$id.',id_cliente',
        ]);

        $cliente = Cliente::find($id);

        $cliente->update($request->all());
        return redirect()->route('clientes.index');
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
        $rol = Auth::user()->rol_id;
        if ($rol == 1) {
            $cliente = Cliente::find($id);
            if ($cliente->estado == 'ACTIVO') {
                $cliente->estado = 'INACTIVO';
                $cliente->save();
                return redirect()->route('clientes.index')->with('eliminado', 'ok');
            } else {
                return redirect()->route('clientes.index')->with('error', 'cliente_inactivo');
            }
        }
    }
}
