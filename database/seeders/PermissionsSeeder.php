<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use App\Models\Permission;
use App\Models\User;
// Correr: php artisan db:seed --class=PermissionsSeeder
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $data = $this->data();
        // Creación de Permisos
        foreach ($data as $value) {
            Permission::create([
                'name' => $value['name'],
                'guard_name' => 'web',
                'tabla' => $value['tabla'],
            ]);
        }

        // Creación de roles
        $admin = Role::create(['name' => 'Admin']); 
        $servicio = Role::create(['name' => 'Servicio']); 
        $cliente = Role::create(['name' => 'Cliente']); 

        // Asignamos roles a los usuarios
        $user = User::find(1);
        if(!$user){
            $user = User::create(
                ['name' => 'Admin',
                 'email' => 'admin@admin',
                 'password' => '$2y$10$G.EKINhYlYYdnNnRugxNvu00iTL.aKIb.aYOiTWN7AnezVDAdFoh2' //admin123
                ]
            );
        }
        $user->assignRole('Admin');
    }

    public function data()
    {
        $data = [];
        // list of model permission
        $model = ['roles','usuarios','permisos','categorias','comprobantes','personas','auditorias','clientes','productos','proveedores','compras','ventas',];  // 'roles','users'
        foreach ($model as $value) {
            foreach ($this->crudActions($value) as $action) {
                $data[] = [
                    'name' => $action,
                    'tabla' => $value
                ];
            }
        }
        // Permisos de ver dashboard
        // $data[]=['dashboard admin'],
        // $data[]=['dashboard servicio'],
        // $data[]=['dashboard cliente'],

        return $data;
    }

    public function crudActions($name)
    {
        $actions = [];
        // list of permission actions
        $crud = ['dashboard','index','create', 'show', 'edit', 'destroy','report'];

        foreach ($crud as $value) {
            $actions[] = $value.' '.$name;
        }

        return $actions;
    }
}
