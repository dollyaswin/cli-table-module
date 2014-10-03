<?php

/**
 * @package Dollyaswin
 */

namespace Dollyaswin\CliTable;

/**
 *
 * @author  Dolly Aswin <dolly.aswin@gmail.com>
 */
class Module
{
    /**
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }
}
