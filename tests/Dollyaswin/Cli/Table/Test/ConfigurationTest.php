<?php

/**
 * @package Dollyaswin
 */

namespace Dollyaswin\Cli\Table\Test;

use PHPUnit_Framework_TestCase;
use Dollyaswin\Cli\Table\Configuration;
use Dollyaswin\Cli\Color\Builder as ColorBuilder;

/**
 *
 * @author  Dolly Aswin <dolly.aswin@gmail.com>
 */
class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    protected $configuration;
    
    protected $expectedHeader;
    
    public function setUp()
    {
        $this->configuration  = new Configuration();
        $this->expectedHeader = ['Name', 'Gender', 'Age'];
    }
    
    public function tearDown()
    {
        unset($this->configuration);
    }
    
    /**
     * Test ColorBuilder instance
     */
    public function testColorBuilderInstance()
    {
        $colorBuilder = new ColorBuilder();
        $this->configuration->setColorBuilder($colorBuilder);
        $this->assertInstanceOf('\Dollyaswin\Cli\Color\Builder', $this->configuration->getColorBuilder());
    }
    
    /**
     * Test data structure validation #1
     */
    public function testValidateDataStructure1()
    {
        $this->setExpectedException('\Dollyaswin\Cli\Table\Exception\InvalidDataStructure');
        $data = [
                  [1, 2, 3, 4, 5],
                  [4, 5, 6, 7, 8]
                ];
        $this->configuration->setData($data);
    }
    
    /**
     * Test data structure validation #2
     */
    public function testValidateDataStructure2()
    {
    	$this->setExpectedException('\Dollyaswin\Cli\Table\Exception\InvalidDataStructure');
    	$data = [
    	          ['Name' => 'Testing'],
    	          [4, 5, 6, 7, 8]
    	        ];
    	$this->configuration->setData($data);
    }
    
    /**
     * Test get header from setHeader()
     */
    public function testGetHeaderFromSetHeader()
    {
        $this->configuration->setHeader($this->expectedHeader);
        $this->assertEquals($this->expectedHeader, $this->configuration->getHeader());
    }
    
    /**
     * Test get header from setData()
     */
    public function testGetHeaderFromSetData()
    {
        $data = [
                  [
                    'Name'   => 'John',
                    'Gender' => 'Male',
                    'Age'    => 26
                  ]
                ];
        $this->configuration->setData($data);
        $this->assertEquals($this->expectedHeader, $this->configuration->getHeader());
    }
    
    /**
     * Test get padding element number same with header element number
     */
    public function testGetPadding()
    {
        $this->configuration->setHeader($this->expectedHeader);
        $this->assertEquals(count($this->expectedHeader), count($this->configuration->getPadding()));
    }
    
    /**
     * Test get header alignment element number same with header element number
     */
    public function testGetHeaderAlignment()
    {
    	$this->configuration->setHeader($this->expectedHeader);
    	$this->assertEquals(count($this->expectedHeader), count($this->configuration->getHeaderAlignment()));
    }
}
