<?php

/**
 * @package Dollyaswin
 */

namespace Dollyaswin\Cli\Table;

use Dollyaswin\Cli\Table\Exception\InvalidDataStructure;
use Dollyaswin\Cli\Color\Builder as ColorBuilder;
use Dollyaswin\Cli\Color\Background\Color as BgColor;
use Dollyaswin\Cli\Color\Text\Color as TextColor;

/**
 *
 * @author  Dolly Aswin <dolly.aswin@gmail.com>
 */
class Configuration
{
    const ALIGN_RIGHT  = STR_PAD_RIGHT;
    
    const ALIGN_LEFT   = STR_PAD_LEFT;
    
    const ALIGN_CENTER = STR_PAD_BOTH;
    
    protected $data;
    
    protected $header;
    
    protected $isBordered;
    
    protected $padding = [];
    
    protected $headerAlignment = [];
    
    protected $colorBuilder;
    
    protected $headerBgColor   = [];
    
    protected $headerTextColor = [];
    
	/**
	 * @return the $data
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param array $data
	 */
	public function setData($data)
	{
	    // validate data structure
	    foreach ($data as $records) {
	        if (! is_array($records) || 
	            array_keys($records) === range(0, count($records) - 1)
	           ) {
	            $message = "Data structure must be an array with structure like this "
	                     . "[['key 0' => 'value', 'key 1' => 'value'], ...]";
	            throw new InvalidDataStructure($message);
	        }
	    }
	    
		$this->data = $data;
		return $this;
	}

	/**
	 * @return the $header
	 */
	public function getHeader()
	{
	    $header = [];
	    
	    if (!isset($this->header)) {
	        $data = $this->getData();
	        // data structure
	        foreach ($data as $record) {
	            $header = array_merge($header, array_keys($record));
	        }
	        
	        $this->header = array_unique($header);
	    }
	    
		return $this->header;
	}

	/**
	 * @param array $header
	 */
	public function setHeader($header)
	{
		$this->header = $header;
		return $this;
	}

	/**
	 * @return the $isBodered
	 */
	public function isBordered()
	{
		return $this->isBordered;
	}

	/**
	 * @param boolean $isBodered
	 */
	public function setIsBordered($isBordered)
	{
		$this->isBordered = $isBordered;
		return $this;
	}
	/**
	 * @return the $padding
	 */
	public function getPadding()
	{
	    $headers = $this->getHeader();
	    $padding = [];
	    
	    // if padding array element is not same with header array element
	    if (count($this->padding) != count($headers)) {
	        foreach ($headers as $key => $header) {
	            // create padding element by add 4 spaces, intended to not defined padding
	            $padding[$key] = (isset($this->padding[$key])) ? $this->padding[$key] : strlen($header) + 4;
	        }
	            
	        $this->padding = $padding;
	    }    
	    
		return $this->padding;
	}

	/**
	 * @param array $padding
	 */
	public function setPadding($padding)
	{
		$this->padding = $padding;
		return $this;
	}
	
	/**
	 * @return the $headerAlignment
	 */
	public function getHeaderAlignment()
	{
	    $headers   = $this->getHeader();
	    $alignment = [];
	    
	    // if header alignment array element is not same with header array element
	    if (count($this->headerAlignment) != count($headers)) {
	        foreach ($headers as $key => $header) {
	            // // create header alignment element with 1 as value, intended to not defined alignment
	            $alignment[$key] = (isset($this->headerAlignment[$key])) ? $this->headerAlignment[$key] : 1;
	        }

	        $this->headerAlignment = $alignment;
	    }
	    
		return $this->headerAlignment;
	}

	/**
	 * @param array $headerAlignment
	 */
	public function setHeaderAlignment($headerAlignment)
	{
		$this->headerAlignment = $headerAlignment;
		return $this;
	}
	/**
	 * @return the $colorBuilder
	 */
	public function getColorBuilder()
	{
		return $this->colorBuilder;
	}

	/**
	 * @param Dollyaswin\Cli\Color\Builder $colorBuilder
	 */
	public function setColorBuilder(\Dollyaswin\Cli\Color\Builder $colorBuilder)
	{
		$this->colorBuilder = $colorBuilder;
		return $this;
	}
	/**
	 * @return the $headerBgColor
	 */
	public function getHeaderBgColor()
	{
		return $this->headerBgColor;
	}

	/**
	 * @param array $headerBgColor
	 */
	public function setHeaderBgColor(Array $headerBgColor) 
	{
		$this->headerBgColor = $headerBgColor;
		return $this;
	}

	/**
	 * @return the $headerTextColor
	 */
	public function getHeaderTextColor()
	{
		return $this->headerTextColor;
	}

	/**
	 * @param array $headerTextColor
	 */
	public function setHeaderTextColor(Array $headerTextColor)
	{
		$this->headerTextColor = $headerTextColor;
		return $this;
	}
}
