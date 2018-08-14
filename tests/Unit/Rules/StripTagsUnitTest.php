<?php

use PHPUnit\Framework\TestCase;
use FcPhp\SInput\Rules\StripTags;
use FcPhp\SInput\Interfaces\ISRule;

class StripTagsUnitTest extends TestCase
{
    public function setUp()
    {
        $this->instance = new StripTags();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ISRule::class, $this->instance);
    }

    public function testRun()
    {
        $this->assertEquals('content', $this->instance->run('<tag>content</tag>'));
    }
}
