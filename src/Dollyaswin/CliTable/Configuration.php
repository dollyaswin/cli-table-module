<?php

/**
 * @package Dollyaswin
 */

namespace Dollyaswin\CliTable;

use Dollyaswin\CliTable\Exception\InvalidDataStructure;

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
    
    protected $padding;
    
    protected $headerAlignment;
    
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
	    if (!isset($this->headerAlignment)) {
	        $this->headerAlignment = array_fill(0, count($this->getHeaders()), '');
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



}
