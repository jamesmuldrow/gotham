<?php

use Illuminate\Database\Seeder;
use gotham\Http\Controllers\MyUtilController;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $util = new MyUtilController();

        \gotham\User::create([
            'first_name' => $util->firstlettertoupper('bruce'),
            'last_name' => $util->firstlettertoupper('wayne'),
            'permission_level' => $util->firstlettertoupper('administrator'),
            'account_status' => 'active',
            'email' => 'jamesmuldrow@gmail.com',
            'password' => bcrypt('Gotham1')
        ]);

        for ($x = 0; $x < 500; $x++) {
            factory(gotham\User::class, 1)->create();
        }
    }
}
