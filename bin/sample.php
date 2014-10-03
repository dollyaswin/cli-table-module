<?php

use Dollyaswin\CliTable\Configuration;
use Dollyaswin\CliTable\Builder as TableBuilder;
use Dollyaswin\CliColor\Builder as ColorBuilder;
use Dollyaswin\CliColor\Background\Color as BgColor;
use Dollyaswin\CliColor\Text\Color as TextColor;

$loader = require_once __DIR__ . '/../vendor/autoload.php';

if (!isset($loader)) {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

$loader->add('Dollyaswin\CliTable', __DIR__);

$data = [
            [
                'Name'    => 'Trixie',
                'Color'   => 'Green',
                'Element' => 'Earth',
                'Likes'   => 'Flower'
            ],
            [
                'Name'    => 'Tinkerbell',
                'Color'   => 'Blue',
                'Element' => 'Air',
                'Likes'   => 'Singing'
            ],
            [
                'Name'    => 'Blum',
                'Color'   => 'Pink',
                'Element' => 'Water',
                'Likes'   => 'Dancing'
            ],
        ];

$colorBuilder = new ColorBuilder();
$config = new Configuration();
$config->setData($data)
       ->setIsBordered(true)
       ->setPadding([15, 10, 15, 15])
       ->setHeaderAlignment([
                              Configuration::ALIGN_CENTER,
                              Configuration::ALIGN_CENTER,
                              Configuration::ALIGN_CENTER,
                              Configuration::ALIGN_CENTER
                            ])
       ->setColorBuilder($colorBuilder)
       ->setHeaderBgColor([
                            BgColor::YELLOW,
                            BgColor::RED,
                            BgColor::BLUE,
                            BgColor::BLACK
                          ])
       ->setHeaderTextColor([
                              TextColor::LIGHT_GRAY,
                              TextColor::YELLOW,
                              TextColor::WHITE,
                              TextColor::PURPLE
                            ]);
$table = new TableBuilder($config);
echo $table->getTable();

