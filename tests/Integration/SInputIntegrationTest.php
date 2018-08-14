<?php

use FcPhp\SInput\SInput;
use PHPUnit\Framework\TestCase;
use FcPhp\SInput\Interfaces\ISInput;
use FcPhp\SInput\Rules\AddSlashes;
use FcPhp\SInput\Rules\HtmlEntities;
use FcPhp\SInput\Rules\StripTags;

class SInputIntegrationTest extends TestCase
{
    public function setUp()
    {
        $this->instance = new SInput();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ISInput::class, $this->instance);
    }

    public function testRules()
    {
        $this->instance->addRule('addslashes', new AddSlashes());
        $this->instance->addRule('htmlentities', new HtmlEntities());
        $this->instance->addRule('striptags', new StripTags());
        $content = [
            'con"ntent' => 'value"',
            "ch'~ve" => "value'2",
            'tag' => '<tag>content</tag>',
        ];
        $this->instance->executeRules(['striptags', 'htmlentities', 'addslashes'], $content);
        $this->assertEquals(['con&quot;ntent' => 'value&quot;', 'ch\\\'~ve' => 'value\\\'2', 'tag' => 'content'], $content);
    }

    public function testRulesString()
    {
        $this->instance->addRule('striptags', new StripTags());    
        $content = '<tag>content</tag>';
        $this->instance->executeRules(['striptags', 'htmlentities', 'addslashes'], $content);
        $this->assertEquals('content', $content);   
    }

    public function testRulesArrayMulti()
    {
        $this->instance->addRule('addslashes', new AddSlashes());
        $this->instance->addRule('htmlentities', new HtmlEntities());
        $this->instance->addRule('striptags', new StripTags());
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
        $this->instance->executeRules(['striptags', 'htmlentities', 'addslashes'], $content);
        $this->assertEquals(['v\\\'al&quot;ue' => ['con\\\'tent' => 'valu&quot;e', 'list' => [['name' => 'va\\\'lue&quot;xx']]]], $content);   
    }

    public function testRulesArrayNumeric()
    {
        $this->instance->addRule('addslashes', new AddSlashes());
        $this->instance->addRule('htmlentities', new HtmlEntities());
        $this->instance->addRule('striptags', new StripTags());
        $content = [
            [
                'item',
                'val"ue'
            ]
        ];
        $this->instance->executeRules(['striptags', 'htmlentities', 'addslashes'], $content);
        $this->assertEquals([['item', 'val&quot;ue']], $content);
    }
}
