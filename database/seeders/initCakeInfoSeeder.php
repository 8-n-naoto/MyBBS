<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Illuminate\Support\Str; //追加
use Illuminate\Support\Facades\Hash; //追加
use Carbon\Carbon;

class initCakeInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //usersテーブル
        // DB::table('users')->insert([
        //     'name' =>  Str::random(10),
        //     'email' =>  Str::random(10) . '@gmail.com',
        //     'password'  => Hash::make('password'),
        // ]);
        // DB::table('admins')->insert([
        //     'name' =>  Str::random(10),
        //     'email' =>  Str::random(10) . '@gmail.com',
        //     'password'  => Hash::make('password'),
        // ]);

        // cakeinfoテーブル
        for ($i = 0; $i < 5; $i++) {
            DB::table('cake_infos')->insert([
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'cakename' => Str::random(10),
                'mainphoto' => 'storage/images/S__11796487_0.jpg',
                'topic' => 'ひとこと説明',
                'explain' => '商品説明'.Str::random(300),
                'cakecode' => '#' . Str::random(5),
                'boolean' => '1',
            ]);
        }

        // cakeinfosubテーブル
        for ($i = 0; $i < 4; $i++) {
            $max = pow(10, 4) - 1;                    // コードの最大値算出
            $rand = random_int(0, $max);                    // 乱数生成
            $code = sprintf('%0' . '4' . 'd', $rand);     // 乱数の頭0埋め
            DB::table('cake_info_subs')->insert([
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'cake_infos_id' => 1,
                'capacity' => $code . 'cm',
                'price' => $code,
            ]);
        }

        // // cakephotosテーブル
        for ($i = 0; $i < 6; $i++) {
            DB::table('cake_photos')->insert([
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'cake_photos_id' => 1,
                'photoname' => Str::random(10),
                'subphotos' => 'storage/images/S__11796487_0.jpg',
            ]);
        }

        // // cartテーブル
        for ($i = 0; $i < 10; $i++) {
            DB::table('carts')->insert([
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'user_id' => 1,
                'cake_info_subs_id' => 1,
                'message' => Str::random(15),
            ]);
        }

        // //tagテーブル
        for ($i = 0; $i < 10; $i++) {
            DB::table('tags')->insert([
                'tag' => Str::random(5),
                'cake_infos_id' => 1,
            ]);
        }
        // favorireテーブル
        for ($i = 0; $i < 10; $i++) {
            DB::table('favorites')->insert([
                'user_id' => 1,
                'cake_id' => 1,
            ]);
        }
    }
}
