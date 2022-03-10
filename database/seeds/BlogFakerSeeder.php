<?php

use Illuminate\Database\Seeder;

class BlogFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Blog\Blog::class, 10)->create()->each(function($u) {
			$u->data()->save(factory(App\Models\Blog\BlogData::class)->make());
		});
    }
}
