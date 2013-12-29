<?php
namespace WtngrmGearmanTest;

use PHPUnit_Framework_TestCase;
use Desyncr\Wtngrm\Module;

/**
 * @covers Desyncr\Wtngrm\Gearman\Module
 */
class ModuleTest extends PHPUnit_Framework_TestCase
{
    public function testGetAutoloaderConfig()
    {
        $module = new Module();
        // just testing ZF specification requirements
        $this->assertInternalType('array', $module->getAutoloaderConfig());
    }

    public function testGetConfig()
    {
        $module = new Module();
        // just testing ZF specification requirements
        $this->assertInternalType('array', $module->getConfig());
    }
}
