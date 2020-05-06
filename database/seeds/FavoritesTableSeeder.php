<?php

use Illuminate\Database\Seeder;
use App\USer; 
use App\Question; 

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('favorites')->delete();
        
        $users = User::pluck('id')->all(); 
        $numbersOfUsers = count($users); 

        foreach (Question::all() as $question) {
            for ($i = 0; $i < rand(1, $numbersOfUsers); $i++) {
                $user = $users[$i]; 
                $question->favorites()->attach($user);  
            }
        }
    }
}
