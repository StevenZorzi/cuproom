<?php

use Illuminate\Database\Seeder;
use App\Lib\Language;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Language::create( [
            'slug' => 'it' ,
            'name' => 'Italiano',
            'ordering' => '0',
        ] );

        Language::create( [
            'slug' => 'en' ,
            'name' => 'English',
            'ordering' => '1',
        ] );

    }
}
