<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Bollywood','Hollywood','Sports','Politics','Health','Tips','Local'];
        foreach($categories as $category){
            DB::table('categories')->insert([
                'title' => $category
            ]);
        }
        // $this->call(UsersTableSeeder::class);
        // factory(App\Category::class, 10)->create();
        // factory(App\User::class, 10)->create();
    }
}
