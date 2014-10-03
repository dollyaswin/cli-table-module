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
        $isBordered = $this->getConfig()->isBordered();
        $table  = '';
        $table .= $this->getHeader();
        $table .= $this->getBody();

        return $table;
    }
    
    protected function getHeader()
    {
        $string  = '';
        $headers = $this->getConfig()->getHeader();
        $padding = $this->getConfig()->getPadding();
        $alignment  = $this->getConfig()->getHeaderAlignment();
        $isBordered = $this->getConfig()->isBordered();
        
        foreach ($headers as $key => $header) {
            $string .= str_pad($header, $padding[$key], ' ', $alignment[$key]);
            
            if ($isBordered) {
                $string .= ' | ';
            }
        }
        
        if ($isBordered) {
            $string = $this->getHr() . '| ' . $string . $this->getHr();
        } else {
            $string .= PHP_EOL;
        }
        
        return $string;
        
    }
    
    protected function getBody()
    {
        $string  = '';
        $data = $this->getConfig()->getData();
        $headers = $this->getConfig()->getHeader();
        $padding = $this->getConfig()->getPadding();
        $isBordered = $this->getConfig()->isBordered();
        
        foreach ($data as $record) {
            if ($isBordered) {
                $string .= '| ';
            }
                
            foreach ($headers as $key => $header) {
                $string .= str_pad((isset($record[$header])) ? $record[$header] : ' ', $padding[$key]);
                
                if ($isBordered) {
                	$string .= ' | ';
                }
            }            
        	
            $string .= PHP_EOL;
        }
        
        return ($isBordered) ? rtrim($string, PHP_EOL)  . $this->getHr() : $string;
    }
    
    protected function getHr()
    {
        $string  = '';
        $headers = $this->getConfig()->getHeader();
        $padding = $this->getConfig()->getPadding();
        
        foreach ($headers as $key => $header) {
        	$string .= str_pad('+', ($padding[$key])  + 3, '-');
        }
        
        return PHP_EOL . $string . '+' . PHP_EOL;
    }
}
