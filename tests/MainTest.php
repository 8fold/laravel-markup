<?php

namespace Eightfold\LaravelUIKit\Tests;

use PHPUnit\Framework\TestCase;

use Eightfold\Html\Html;

use Eightfold\LaravelUIKit\UIKit;

class MainTest extends TestCase
{
    public function testCanMakeTextFromHere()
    {
        $result = UIKit::text("Hello!")->compile();
        $this->assertEquals("Hello!", $result);
    }

    public function testCanUseRDFA()
    {
        $expected = '<div vocab="http://schema.org/"></div>';
        $result = Html::div()->attr("vocab http://schema.org/")->compile();
        $this->assertEquals($expected, $result);
    }
}
