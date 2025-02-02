<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use App\Models\Rol;
use Illuminate\Support\Facades\Auth;
use App\Models\Proveedor;
use App\Models\Productos;


class UsuarioController extends Controller
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
        $usuarios = DB::table('users')
        ->select('id', 'name','email', 'nombre','users.created_at')
        ->join('rols', 'users.rol_id', '=', 'rols.id_rol')
        ->get();
        if ($rol==1) {
            return view('usuarios.index', compact('usuarios', 'rol'));
        }
        return redirect()->route('home');



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = Auth::user()->rol_id;
        $rol_id = Rol::pluck('nombre','id_rol')->all();
        return view('usuarios.crear', compact('rol_id', 'rol'));
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
        $this->validate($request,[
        'name'=>'required',
        'email'=>'required|email|unique:users,email', 
        'password'=>'required|same:confirmar-contraseña|min:8',
        'rol_id'=>'required'
     ]);
    $input = request()->all();
    $input['password'] = Hash::make($input['password']); 

    $user = User::create($input);
/*     $user->assignRole($request->input('roles'));
 */
    return redirect()->route('usuarios.index')->with('creado','ok');

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $rol = Auth::user()->rol_id;
        $user = User::find($id);
        $rol_id = Rol::pluck('nombre','id_rol')->all();
        return view('usuarios.editar', compact('user', 'rol_id', 'rol'));
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
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id, 
            'password'=>'same:confirmar-contraseña',
            'rol_id' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            # code...
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

/*         $user->assignRole($request->input('roles'));
 */        return redirect()->route('usuarios.index')->with('editado', 'ok');
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
/*         User::find($id)->delete();
        return redirect()->route('usuarios.index')->with('eliminado', 'ok'); */

        $user = User::find($id);

        if (!$user) {
            // El usuario no existe
            return redirect()->back()->with('error', 'El usuario no se encontró.');
        }
    
        // Verificar las relaciones y tomar acciones según sea necesario
        if ($user->proveedores()->exists() or $user->productos()->exists() or $user->documentos()->exists()) {
            // Mostrar mensaje de error en la vista
            return redirect()->back()->with('error', 'usuario_datos_creados');
        }
    
        // Resto de las relaciones...
    
        // Eliminar el usuario
        $user->delete();
    
        // Redireccionar con un mensaje de éxito
        return redirect()->back()->with('success', 'ok');
    }
}
