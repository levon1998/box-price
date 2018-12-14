<?php

use Illuminate\Database\Seeder;

class BoxsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boxes = [
            [
                'name' => 'Простой ящик',
                'description' => 'от - 25, до 100 рублей',
                'price' => 50,
                'min_prize' => 25,
                'max_prize' => 100,
                'image_source' => '/img/chest-3.png',
            ],
            [
                'name' => 'Открытый Ящик',
                'description' => 'от - 50, до 200 рублей',
                'price' => 100,
                'min_prize' => 50,
                'max_prize' => 200,
                'image_source' => '/img/chest-1.png',
            ],
            [
                'name' => 'Золотой Ящик',
                'description' => 'от - 100, до 400 рублей',
                'price' => 200,
                'min_prize' => 100,
                'max_prize' => 300,
                'image_source' => '/img/chest-2.png',
            ],
            [
                'name' => 'Бриллиантовы Ящик',
                'description' => 'от - 150, до 600 рублей',
                'price' => 300,
                'min_prize' => 150,
                'max_prize' => 600,
                'image_source' => '/img/chest-rich.png',
            ]
        ];

        \App\Models\Boxes::insert($boxes);
    }
}
