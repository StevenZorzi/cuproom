<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create( [
            'email' => 'info@stevenweb.it' ,
            'password' => Hash::make( 'steven-123' ) ,
            'name' => 'Steven' ,
            'surname' => 'Zorzi' ,
            'role' => 'superadmin' ,
        ] );

       	User::create( [
            'email' => 'web@roundstudio.it' ,
            'password' => Hash::make( 'remo-123' ) ,
            'name' => 'Remo' ,
            'surname' => 'Diotto' ,
            'role' => 'superadmin' ,
        ] );

        User::create( [
            'email' => 'frontend@roundstudio.it' ,
            'password' => Hash::make( 'gianmaria-123' ) ,
            'name' => 'Gianmaria' ,
            'surname' => 'Bressan' ,
            'role' => 'superadmin' ,
        ] );
    }
}
