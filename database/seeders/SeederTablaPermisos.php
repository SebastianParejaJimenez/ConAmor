<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;



//Spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
            //Tabla Blogs
            'ver-blog',
            'crear-blog',
            'editar-blog',
            'borrar-blog',
            //Tabla de Provedores
            'ver-proveedor',
            'crear-proveedor',
            'editar-proveedor',
            'borrar-proveedor',
        ];
        foreach ($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    
    }
}
