<?php

/**
 * @package Dollyaswin
 */

namespace Dollyaswin\Cli\Table\Test;

use PHPUnit_Framework_TestCase;
use Dollyaswin\Cli\Table\Configuration;
use Dollyaswin\Cli\Table\Builder as TableBuilder;

/**
 *
 * @author  Dolly Aswin <dolly.aswin@gmail.com>
 */
class BuilderTest extends PHPUnit_Framework_TestCase
{
    protected $configuration;
    
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
     * Test TableBuilder instance
     */
    public function testConfigurationInstance()
    {
        $tableBuilder = new TableBuilder($this->configuration);
        $this->assertInstanceOf('\Dollyaswin\Cli\Table\Configuration', $tableBuilder->getConfiguration());
    }
    
    /**
     * Test TableBuilder output with empty body
     */
    public function testTableOutputWithoutBody()
    {
    	$this->configuration->setHeader($this->expectedHeader);
    	$this->configuration->setData([]);
    	$tableBuilder = new TableBuilder($this->configuration);
    	
    	// compose expected output
    	$expectedOutput = '';
    	
    	foreach ($this->expectedHeader as $header) {
    	    // this is the way to compose content padding
    	    $expectedOutput .= ' ' . str_pad($header, strlen($header) + 4, ' ') . ' ';    
    	}
    	
    	$expectedOutput .= PHP_EOL;
    	
    	$this->assertEquals(strlen($expectedOutput), strlen($tableBuilder->getTable()));
    	$this->assertEquals($expectedOutput, $tableBuilder->getTable());
    }
}
