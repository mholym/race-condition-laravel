<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Answer;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::create([
             'name' => 'Admin',
             'email' => 'admin@admin.sk',
             'password' => Hash::make('adminadmin'),
         ]);

         Cart::create([
             'user_id' => 1,
             'total_discount' => 0,
         ]);

         Coupon::create([
             'discount' => 25,
             'code' => 'HESOYAM',
             'expired_at' => '2023-10-29 19:16:07',
         ]);

         Coupon::create([
             'discount' => 10,
             'code' => 'AEZAKMI',
             'expired_at' => '2025-10-29 19:27:12',
         ]);

         Poll::create([
             'user_id' => 1,
             'text' => 'Who should be our next president?',
         ]);

         Poll::create([
             'user_id' => 1,
             'text' => 'What food do you prefer?',
         ]);

         Answer::create([
             'poll_id' => 2,
             'text' => 'Human meat',
         ]);

        Answer::create([
            'poll_id' => 2,
            'text' => 'Krokodil meat',
        ]);

        Answer::create([
            'poll_id' => 2,
            'text' => 'Kanye memes',
        ]);

        Answer::create([
            'poll_id' => 1,
            'text' => 'Abrakadabrus',
        ]);

        Answer::create([
            'poll_id' => 1,
            'text' => 'Voldemorto',
        ]);

        Answer::create([
            'poll_id' => 1,
            'text' => 'Tutanchamonus',
        ]);
    }
}
