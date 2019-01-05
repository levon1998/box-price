<?php

use Illuminate\Database\Seeder;

class SpinnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spinners = [
            [
                'level' => 1,
                'name' => 'Уровень 1',
                'description' => 'Шанс получить до 2 баллов в день.',
                'price' => 50,
            ],
            [
                'level' => 2,
                'name' => 'Уровень 2',
                'description' => 'Шанс получить до 3 баллов в день.',
                'price' => 100,
            ],
            [
                'level' => 3,
                'name' => 'Уровень 3',
                'description' => 'Шанс получить до 4 баллов в день.',
                'price' => 150,
            ],
            [
                'level' => 4,
                'name' => 'Уровень 4',
                'description' => 'Шанс получить до 5 баллов в день.',
                'price' => 250,
            ],
            [
                'level' => 5,
                'name' => 'Уровень 5',
                'description' => 'Шанс получить до 6 баллов в день.',
                'price' => 350,
            ]
        ];

        \App\Models\Spinners::insert($spinners);
    }
}
