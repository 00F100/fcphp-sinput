<?php

use PHPUnit\Framework\TestCase;
use FcPhp\SInput\Rules\HtmlEntities;
use FcPhp\SInput\Interfaces\ISRule;

class HtmlEntitiesUnitTest extends TestCase
{
    public function setUp()
    {
        $this->instance = new HtmlEntities();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ISRule::class, $this->instance);
    }

    public function testRun()
    {
        $this->assertEquals('val&quot;ue', $this->instance->run('val"ue'));
    }
}
