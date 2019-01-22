<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "Главная страница - Box Price", // set false to total remove
            'description'  => 'Новое возможность онлайн заработка', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => ['онлайн заработка', 'заработок в интернете', 'Box', 'Box price', 'Box-price', ],
            'canonical'    => false, // Set null for using Url::current(), set false to total remove
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Главная страница - Box Price', // set false to total remove
            'description' => 'Новое возможность онлайн заработка', // set false to total remove
            'url'         => 'https://www.box-price.ru', // Set null for using Url::current(), set false to total remove
            'type'        => 'article',
            'site_name'   => 'Box Price',
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          //'card'        => 'summary',
          //'site'        => '@LuizVinicius73',
        ],
    ],
];
