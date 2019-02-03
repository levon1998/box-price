<?php

use Illuminate\Database\Seeder;

class PassiveIncomesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $passiveIncomes = [
            [
                'title' => 'Малинки Источник',
                'description' => '3 рубля каждый день независимо от ваших усилий или активности.',
                'image' => '/img/passive_income_1.png',
                'duration' => 38,
                'price' => 100,
                'daily_income' => 3,
                'show_status' => 1
            ],
            [
                'title' => 'Обычны Источник',
                'description' => '4 рубля каждый день независимо от ваших усилий или активности.',
                'image' => '/img/passive_income_2.png',
                'duration' => 70,
                'price' => 250,
                'daily_income' => 4,
                'show_status' => 1
            ],
            [
                'title' => 'Большой Источник',
                'description' => '6 рубля каждый день независимо от ваших усилий или активности.',
                'image' => '/img/passive_income_3.png',
                'duration' => 95,
                'price' => 500,
                'daily_income' => 6,
                'show_status' => 1
            ],
            [
                'title' => 'Огромный Источник',
                'description' => '10 рубля каждый день независимо от ваших усилий или активности.',
                'image' => '/img/passive_income_4.png',
                'duration' => 120,
                'price' => 1000,
                'daily_income' => 10,
                'show_status' => 1
            ]
        ];

        \App\Models\PassiveIncome::insert($passiveIncomes);
    }
}
