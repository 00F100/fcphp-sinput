<?php

use PHPUnit\Framework\TestCase;
use FcPhp\SInput\Rules\AddSlashes;
use FcPhp\SInput\Interfaces\ISRule;

class AddSlashesUnitTest extends TestCase
{
    public function setUp()
    {
        $this->instance = new AddSlashes();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ISRule::class, $this->instance);
    }

    public function testRun()
    {
        $this->assertEquals('val\\\'ue', $this->instance->run('val\'ue'));
    }
}
