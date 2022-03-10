<?php

use Illuminate\Database\Seeder;

class CategoriesFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Core\Category::class, 10)->create()->each(function($u) {
			$u->data()->save(factory(App\Models\Core\CategoryData::class)->make());
		});
    }
}
