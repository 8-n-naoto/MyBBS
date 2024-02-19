<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class initManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //main_reservation
        for ($i = 0; $i < 5; $i++) {
            DB::table('main_reservation')->insert([
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'users_id' => 1,
                'birthday' =>  Carbon::today(),
                'time'  => Carbon::today(),
            ]);
        }

        //sub_reservation
        $max = pow(10, 4) - 1;
        $rand = random_int(0, $max);
        $code = sprintf('%0' . '4' . 'd', $rand);
        for ($i = 0; $i < 10; $i++) {
            DB::table('sub_reservation')->insert([
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'main_reservation_id' => 1,
                'cakename' =>  '商品名',
                'capacity' => $code . 'cm',
                'price' => $code,
                'message' => Str::random(15),
            ]);
        }

        // information
        for ($i = 0; $i < 10; $i++) {
            DB::table('information')->insert([
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'topic' =>'お知らせの題名'. Str::random(4),
                'information' => 'お知らせ内容'.Str::random(400),
            ]);
        }

        // basic_ingredients
        for ($i = 0; $i < 3; $i++) {
            DB::table('basic_ingredients')->insert([
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'cake_infos_id' => 1,
                'basic_amount' => '○○型〇枚分',
                'ingredient_unit' => 'g/kgなど',
            ]);
        }

        // each_ingredients
        for ($i = 0; $i < 20; $i++) {
            DB::table('each_ingredients')->insert([
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'basic_ingredients_id' => 1,
                'ingredient_name' =>  '材料名',
                'ingredient_amount' => $code + 20,
                'lot_amount' => $code,
                'lot_unit' => 'ダース/袋など',
                'expiration' => '1',
            ]);
        }


        for ($i = 0; $i < 20; $i++) {
        }
    }
}
