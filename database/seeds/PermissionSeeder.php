<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'booking-list',
            'booking-create',
            'booking-edit',
            'booking-delete',
            'schedule-list',
            'schedule-create',
            'schedule-edit',
            'schedule-delete',
         ];
 
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
