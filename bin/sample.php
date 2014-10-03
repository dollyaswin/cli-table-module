<?php

use Dollyaswin\CliTable\Configuration;
use Dollyaswin\CliTable\Builder;

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
$config = new Configuration();
$config->setData($data)
       ->setIsBordered(true)
       ->setPadding([15, 10, 15, 15])
       ->setHeaderAlignment([
                              Configuration::ALIGN_CENTER,
                              Configuration::ALIGN_CENTER,
                              Configuration::ALIGN_CENTER,
                              Configuration::ALIGN_CENTER
                            ]);
$builder = new Builder($config);
echo $builder->getTable();

