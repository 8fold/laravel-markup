<?php

namespace Eightfold\LaravelMarkup\Tests;

use Orchestra\Testbench\BrowserKit\TestCase;
// use PHPUnit\Framework\TestCase;

use Eightfold\LaravelMarkup\UIKit;

class MainTest extends TestCase
{
    public function testForm()
    {
        // Presume Testbench token will always be empty to make testin easier.
        $expected = '<form action="/" method="post"><input type="hidden" name="_token" value="testing"><button>Submit</button></form>';
        $actual = UIKit::form();
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<form id="form" action="/" method="post"><input type="hidden" name="_token" value="testing"><button>Submit</button></form>';
        $actual = UIKit::form()->attr("id form");
        $this->assertEquals($expected, $actual->unfold());

        // method always initial
        $expected = '<form id="form" action="/" method="post"><input type="hidden" name="_token" value="testing"><button>Submit</button></form>';
        $actual = UIKit::form()->attr("id form", "action /something", "method get");
        $this->assertEquals($expected, $actual->unfold());
    }

    public function testClassFor()
    {
        $expected = "Eightfold\\LaravelMarkup\\Elements\\Forms\\Form";
        $actual = UIKit::classFor("form");
        $this->assertEquals($expected, $actual);
    }

    public function testUIKitClassMap()
    {
        $expected = 1;
        $actual = UIKit::classMap()->count;
        $this->assertEquals($expected, $actual);

        $expected = "Eightfold\\LaravelMarkup\\Elements\\Forms\\Form";
        $actual = UIKit::classMap()->first;
        $this->assertEquals($expected, $actual);
    }
}
