<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($x = 0; $x < 3; $x++) {
            factory(gotham\Project::class, 1)->create();
        }
    }
}
