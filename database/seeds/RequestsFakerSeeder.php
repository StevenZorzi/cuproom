<?php

use Illuminate\Database\Seeder;

class RequestsFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ContactRequests\ContactRequest::class, 10)->create();
    }
}
