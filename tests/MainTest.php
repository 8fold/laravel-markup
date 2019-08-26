<?php

namespace Eightfold\LaravelUIKit\Tests;

use PHPUnit\Framework\TestCase;

use Eightfold\LaravelUIKit\UIKit;

class MainTest extends TestCase
{
    public function testCanMakeTextFromHere()
    {
        $result = UIKit::text("Hello!")->compile();
        $this->assertEquals("Hello!", $result);
    }

    // public function testCanBuildSelectInput()
    // {
    //     $result = UIKit::select()->compile();
    //     $this->assertEquals("", $result);
    // }

    public function testCanBuildWebview()
    {
        $expected = '<!doctype html><html lang="en"><head><title>Laravel</title><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"></head><body><p>Hello, World!</p></body></html>';
        $result = UIKit::webView(
            "Laravel",
            UIKit::p(UIKit::text("Hello, World!"))
        )->compile();
        $this->assertEquals($expected, $result);
    }
}
