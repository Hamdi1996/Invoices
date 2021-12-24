<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
        $user = User::create([
        'name'        => 'Hamdy Mahmoud',
        'email'       => 'hamdy.fcai@gmail.com',
        'password'    => bcrypt('admin'),
        'roles_name'  => ['owner'],
        'Status'      => 'مفعل',
        ]);
        $role = Role::create(['name' => 'owner']);

        $permissions = Permission::pluck('id','id')->all();
        
        $role->syncPermissions($permissions);
        
        $user->assignRole([$role->id]);
}
}