<?php

/**
 * @package Dollyaswin
 */

namespace Dollyaswin\Cli\Table;

use Dollyaswin\Cli\Table\Configuration;
use Dollyaswin\Cli\Color\Builder as ColorBuilder;

/**
 *
 * @author  Dolly Aswin <dolly.aswin@gmail.com>
 */
class Builder
{
    protected $configuration;
    
    /**
     * @param Dollyaswin\Cli\Table\Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;    
    }
    
    /**
     * Get Configuration object
     * 
     * @return Dollyaswin\Cli\Table\Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }
    
    /**
     * Get table output
     * 
     * @return string
     */
    public function getTable()
    {
        $table  = '';
        $table .= $this->getHeader();
        $table .= $this->getBody();

        return $table;
    }
    
    /**
     * Get header string
     * 
     * @return string
     */
    protected function getHeader()
    {
        $string  = '';
        $headers = $this->getConfiguration()->getHeader();
        $padding = $this->getConfiguration()->getPadding();
        $alignment  = $this->getConfiguration()->getHeaderAlignment();
        $headerTextColor = $this->getConfiguration()->getHeaderTextColor();
        $headerBgColor   = $this->getConfiguration()->getHeaderBgColor();
        
        foreach ($headers as $key => $header) {
            $content = ' ' . str_pad($header, $padding[$key], ' ', $alignment[$key]) . ' ';
            
            if ($this->getConfiguration()->getColorBuilder() instanceof ColorBuilder) {
                $string .= $this->getConfiguration()
                                ->getColorBuilder()
                                ->getColoredString($content, $headerTextColor[$key], $headerBgColor[$key]);
            } else {
                $string .= $content;
            }
            
            if ($this->getConfiguration()->isBordered()) {
                $string .= '|';
            }
        }
        
        if ($this->getConfiguration()->isBordered()) {
            $string = $this->getHr() . '|' . $string . $this->getHr();
        } else {
            $string .= PHP_EOL;
        }

        return $string;
    }
    
    /**
     * Get body string
     * 
     * @return string
     */
    protected function getBody()
    {
        $string  = '';
        $data    = $this->getConfiguration()->getData();
        $headers = $this->getConfiguration()->getHeader();
        $padding = $this->getConfiguration()->getPadding();
        $headerTextColor = $this->getConfiguration()->getHeaderTextColor();
        $headerBgColor   = $this->getConfiguration()->getHeaderBgColor();
        
        foreach ($data as $record) {
            if ($this->getConfiguration()->isBordered()) {
                $string .= '|';
            }
                
            foreach ($headers as $key => $header) {
                $content = ' ' . str_pad((isset($record[$header])) ? $record[$header] : ' ', $padding[$key]) .' ';
                if ($this->getConfiguration()->getColorBuilder() instanceof ColorBuilder) {
                    $string .= $this->getConfiguration()
                                    ->getColorBuilder()
                                    ->getColoredString($content, $headerTextColor[$key], $headerBgColor[$key]);
                } else {
                    $string .= $content;
                }
                 
                
                if ($this->getConfiguration()->isBordered()) {
                	$string .= '|';
                }
            }            
        	
            $string .= PHP_EOL;
        }
        
        return ($this->getConfiguration()->isBordered()) ? rtrim($string, PHP_EOL)  . $this->getHr() : $string;
    }
    
    /**
     * Get line
     * 
     * @return string
     */
    protected function getHr()
    {
        $string  = '';
        $headers = $this->getConfiguration()->getHeader();
        $padding = $this->getConfiguration()->getPadding();
        
        foreach ($headers as $key => $header) {
        	$string .= str_pad('+', ($padding[$key])  + 3, '-');
        }
        
        return PHP_EOL . $string . '+' . PHP_EOL;
    }
}
