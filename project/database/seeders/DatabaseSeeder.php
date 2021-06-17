<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**  
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();

        $this->call([ UsersTableSeeder::class]);

        DB::table('cars')->insert([
            'carMake' =>'BMW',
            'carModel' => 'E60',
            'PhoneNumber' =>'45457120',
            'price' => '45',
            'user_id' => '2',
            'description' => 'If you order in advance, you can get a discount.',
            'documents' => 'Doc.pdf',
            'carArea' => 'Rusova iela',
            'photo' => 'Nt7is5Wh.jpg',
            'ifRented' => 'no',
            'status' => 'Under consideration',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('cars')->insert([
            'carMake' =>'Fiat',
            'carModel' => '500',
            'PhoneNumber' =>'75102236',
            'price' => '30',
            'user_id' => '3',
            'description' => 'On the phone from 10:00 till 21:00.',
            'documents' => 'Doc1.pdf',
            'carArea' => 'Old town',
            'photo' => 'Fiat500.jpg',
            'ifRented' => 'no',
            'status' => 'Under consideration',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('cars')->insert([
            'carMake' =>'Toyota',
            'carModel' => 'RAV4',
            'PhoneNumber' =>'30341402',
            'price' => '55',
            'user_id' => '4',
            'description' => 'A new one (2021)',
            'documents' => 'Doc3.jpg',
            'carArea' => 'Brivibas iela',
            'photo' => 'images.jpg',
            'ifRented' => 'no',
            'status' => 'Under consideration',
            'created_at' => now(),
            'updated_at' => now()
        ]);



        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
