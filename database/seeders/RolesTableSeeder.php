<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'title' => 'Super Admin',
                'created_at' => '2023-02-11 00:00:00',
                'updated_at' => '2023-02-11 00:00:00',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'role_id' => 2,
                'title' => 'Staff',
                'created_at' => '2023-02-11 00:00:00',
                'updated_at' => '2023-02-11 00:00:00',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'role_id' => 3,
                'title' => 'Partner',
                'created_at' => '2023-02-11 00:00:00',
                'updated_at' => '2023-02-11 00:00:00',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'role_id' => 4,
                'title' => 'Customer',
                'created_at' => '2023-02-11 00:00:00',
                'updated_at' => '2023-02-11 00:00:00',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}