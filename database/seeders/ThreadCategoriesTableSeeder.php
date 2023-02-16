<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThreadCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('thread_categories')->delete();
        
        \DB::table('thread_categories')->insert(array (
            0 => 
            array (
                'thread_category_id' => 1,
                'title' => 'Cara Pesan',
                'created_at' => '2023-02-11 00:00:00',
                'updated_at' => '2023-02-11 00:00:00',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}