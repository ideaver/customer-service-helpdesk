<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'uuid' => '41cf5290-25de-4b2e-872e-7ae8ef8c5170',
                'role_id' => 1,
                'image_profile' => 'https://api.dicebear.com/5.x/avataaars/svg?seed=Peanut',
                'fullname' => 'Testing 1',
                'email' => 'test@gmail.com',
                'phone' => '+62 851-7540-473',
                'password' => '$2y$10$2S3WETZ9OxCiHnJP12r8SOC2EaRKnGenFNfaKLmbnfqIG7IvA3hkO',
                'fcm_token' => 'd3yGDVBGpK6GO9LMaojAdj:APA91bGMJBOLqCSkWkw_k9mm12ZB-0HQL_A7vW_kJstkKZjwp5i6qmhhydxeIFhu1X0sIAvJZxzzpOopDiFlyEpwe78ybZRmTLFPPLn5FAOoo8S87KuLAw_OCkKFibX-IKNkWfr0L6OI',
                'is_active' => 1,
                'created_at' => '2023-02-14 10:39:04',
                'updated_at' => '2023-02-15 11:13:28',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'user_id' => 2,
                'uuid' => 'a16a779d-b3d9-4015-a65d-9439fd9beec5',
                'role_id' => 1,
                'image_profile' => 'https://api.dicebear.com/5.x/avataaars/svg?seed=Ginger',
                'fullname' => 'Testing 2',
                'email' => 'test2@gmail.com',
                'phone' => '+62 858-1745-721',
                'password' => '$2y$10$dhfRObCBHOSZL2hUv3lBuuTValL8li.nNwxSX8MG3w/GHCxxQ114G',
                'fcm_token' => NULL,
                'is_active' => 1,
                'created_at' => '2023-02-14 11:16:23',
                'updated_at' => '2023-02-14 11:16:23',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'user_id' => 3,
                'uuid' => '9e229cc6-0f35-41cc-b4b2-c5f41b8861df',
                'role_id' => 4,
                'image_profile' => 'https://api.dicebear.com/5.x/avataaars/svg?seed=Bubba',
                'fullname' => 'Customer 1',
                'email' => 'cust@gmail.com',
                'phone' => '+62 865-550-954',
                'password' => '$2y$10$2s0b0lOZHHov.yFbCGX7k.7ZOVsioBhv7e62q/DuCaePZ3JIIYxvK',
                'fcm_token' => NULL,
                'is_active' => 1,
                'created_at' => '2023-02-16 06:33:14',
                'updated_at' => '2023-02-16 06:33:14',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'user_id' => 4,
                'uuid' => '4e019d77-7f41-4acc-98f6-dfa5d4885b0e',
                'role_id' => 3,
                'image_profile' => 'https://api.dicebear.com/5.x/avataaars/svg?seed=Lily',
                'fullname' => 'Partner 1',
                'email' => 'part2@gmail.com',
                'phone' => '+62 881-5300-471',
                'password' => '$2y$10$WEP8K0X5yiDsto.vsFmTE.ZOC1oMuKJ.29i.giQw8GXx9LwKtVI4i',
                'fcm_token' => NULL,
                'is_active' => 1,
                'created_at' => '2023-02-16 07:39:56',
                'updated_at' => '2023-02-16 07:39:56',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'user_id' => 5,
                'uuid' => 'c70bb333-bc82-44e3-a541-b04722ac264c',
                'role_id' => 1,
                'image_profile' => 'https://api.dicebear.com/5.x/avataaars/svg?seed=Kitty',
                'fullname' => 'Testing 3',
                'email' => 'test3@gmail.com',
                'phone' => '+62 877-3624-7345',
                'password' => '$2y$10$slj4WTDZC1mkWcg9aV8gaOsogGvhLeIQBLxTjesMy0r29.QUmMCAC',
                'fcm_token' => NULL,
                'is_active' => 1,
                'created_at' => '2023-02-16 07:42:07',
                'updated_at' => '2023-02-16 07:42:07',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}