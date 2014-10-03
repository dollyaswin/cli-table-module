<?php

/**
 * @package Dollyaswin
 */

namespace Dollyaswin\CliTable;

use Dollyaswin\CliTable\Configuration;

/**
 *
 * @author  Dolly Aswin <dolly.aswin@gmail.com>
 */
class Builder
{
    protected $config;
    
    public function __construct(Configuration $config)
    {
        $this->config = $config;    
    }
    
    public function getConfig()
    {
        return $this->config;
    }
    
    public function getTable()
    {
        $table  = '';
        $table .= $this->generateHeader();
        $table .= PHP_EOL;
        $table .= $this->generateBody();

        return $table;
    }
    
    protected function generateHeader()
    {
        $string  = '';
        $headers = $this->getConfig()->getHeader();
        $padding = $this->getConfig()->getPadding();
        $alignment = $this->getConfig()->getHeaderAlignment();
        foreach ($headers as $key => $header) {
            $string .= str_pad($header, $padding[$key], ' ', $alignment[$key]);
        }
        
        return $string;
    }
    
    protected function generateBody()
    {
        $string  = '';
        $data = $this->getConfig()->getData();
        $headers = $this->getConfig()->getHeader();
        $padding = $this->getConfig()->getPadding();
        foreach ($data as $record) {
            foreach ($headers as $key => $header) {
                $string .= str_pad($record[$header], $padding[$key]);
            }            
        	
            $string .= PHP_EOL;
        }
        
        return $string;
    }
}
