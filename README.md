# FcPhp Security Input

Package to clean input content

[![Build Status](https://travis-ci.org/00F100/fcphp-sinput.svg?branch=master)](https://travis-ci.org/00F100/fcphp-sinput) [![codecov](https://codecov.io/gh/00F100/fcphp-sinput/branch/master/graph/badge.svg)](https://codecov.io/gh/00F100/fcphp-sinput)

[![PHP Version](https://img.shields.io/packagist/php-v/00f100/fcphp-sinput.svg)](https://packagist.org/packages/00F100/fcphp-sinput) [![Packagist Version](https://img.shields.io/packagist/v/00f100/fcphp-sinput.svg)](https://packagist.org/packages/00F100/fcphp-sinput) [![Total Downloads](https://poser.pugx.org/00F100/fcphp-sinput/downloads)](https://packagist.org/packages/00F100/fcphp-sinput)

## How to install

Composer:
```sh
$ composer require 00f100/fcphp-sinput
```

or add in composer.json
```json
{
    "require": {
        "00f100/fcphp-sinput": "*"
    }
}
```

## How to use

```php
<?php

use FcPhp\SInput\SInput;
use FcPhp\SInput\Rules\AddSlashes;
use FcPhp\SInput\Rules\HtmlEntities;
use FcPhp\SInput\Rules\StripTags;

$instance = new SInput();

$instance->addRule('addslashes', new AddSlashes());
$instance->addRule('htmlentities', new HtmlEntities());
$instance->addRule('striptags', new StripTags());

$content = [
    'con"ntent' => 'value"',
    "ch'~ve" => "value'2",
    'tag' => '<tag>content</tag>',
];
$this->instance->executeRules(['striptags', 'htmlentities', 'addslashes'], $content);

//  Print:
//  
//  Array(
//      'con&quot;ntent' => 'value&quot;',
//      'ch\\\'~ve' => 'value\\\'2',
//      'tag' => 'content'
//  )
//
echo $content;

```