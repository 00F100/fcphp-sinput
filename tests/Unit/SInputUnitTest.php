<?php

use FcPhp\SInput\SInput;
use PHPUnit\Framework\TestCase;
use FcPhp\SInput\Interfaces\ISInput;

class SInputUnitTest extends TestCase
{
    public function setUp()
    {
        $this->instance = new SInput();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ISInput::class, $this->instance);
    }

    public function testRulesString()
    {
        $rule = $this->createMock('FcPhp\SInput\Interfaces\ISRule');
        $rule
            ->expects($this->any())
            ->method('run')
            ->will($this->returnValue('content of rule'));
        $this->assertInstanceOf(ISInput::class, $this->instance->addRule('rule', $rule));
        $content = '<tag>content</tag>';
        $this->instance->executeRules(['rule'], $content);
        $this->assertEquals('content of rule', $content);   
    }

    public function testRules()
    {
        $rule = $this->createMock('FcPhp\SInput\Interfaces\ISRule');
        $rule
            ->expects($this->any())
            ->method('run')
            ->will($this->returnValue('content of rule'));
        $this->assertInstanceOf(ISInput::class, $this->instance->addRule('rule', $rule));
        $content = [
            'con"ntent' => 'value"',
            "ch'~ve" => "value'2",
            'tag' => '<tag>content</tag>',
        ];
        $this->instance->executeRules(['rule'], $content);
        $this->assertEquals(['content of rule' => 'content of rule'], $content);
    }

    public function testRulesArrayMulti()
    {
        $rule = $this->createMock('FcPhp\SInput\Interfaces\ISRule');
        $rule
            ->expects($this->any())
            ->method('run')
            ->will($this->returnValue('content of rule'));
        $this->assertInstanceOf(ISInput::class, $this->instance->addRule('rule', $rule));
        $content = [
            'v\'al"ue' => [
                'con\'tent' => 'valu"e',
                'list' => [
                    [
                        'name' => 'va\'lue"xx'
                    ]
                ],
            ]
        ];
        $this->instance->executeRules(['rule'], $content);
        $this->assertEquals(['content of rule' => ['content of rule' => ['content of rule' => ['content of rule' => 'content of rule']]]], $content);   
    }

    public function testRulesArrayNumeric()
    {
        $rule = $this->createMock('FcPhp\SInput\Interfaces\ISRule');
        $rule
            ->expects($this->any())
            ->method('run')
            ->will($this->returnValue('content of rule'));
        $this->assertInstanceOf(ISInput::class, $this->instance->addRule('rule', $rule));
        $content = [
            [
                'item',
                'val"ue'
            ]
        ];
        $this->instance->executeRules(['rule'], $content);
        $this->assertEquals(['content of rule' => ['content of rule', 'content of rule']], $content);
    }
}
