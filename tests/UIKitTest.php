<?php

namespace Eightfold\LaravelMarkup\Tests;

use Orchestra\Testbench\BrowserKit\TestCase;
// use PHPUnit\Framework\TestCase;

use Eightfold\LaravelMarkup\UIKit;

class MainTest extends TestCase
{
    public function testSelect()
    {
        $expected = '<label for="select">Select</label><select id="select" name="select"></select>';
        $actual = UIKit::select("Select", "select");
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<label for="select">Select</label><select id="select" name="select"><option value="value1">Option A</option><option value="value2">Option B</option></select>';
        $actual = UIKit::select("Select", "select")
            ->options(
                "value1 Option A",
                "value2 Option B"
            );
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<label for="select">Select</label><select id="select" name="select"><optgroup label="optgroup label"><option value="value1">Option A</option><option value="value2">Option B</option></optgroup><option value="value3">Option C</option></select>';
        $actual = UIKit::select("Select", "select")
            ->options(
                [
                    "optgroup label",
                    "value1 Option A",
                    "value2 Option B"
                ],
                "value3 Option C"
            );
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<label for="select">Select</label><select id="select" name="select"><option value="value1">Option A</option><option value="value2" selected>Option B</option></select>';
        $actual = UIKit::select("Select", "select", "value2")
            ->options(
                "value1 Option A",
                "value2 Option B"
            );
        $this->assertEquals($expected, $actual->unfold());
    }

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

        $expected = '<form id="form" action="/" method="post"><label for="select">Select</label><select id="select" name="select"><option value="value1">Option A</option><option value="value2">Option B</option></select><input type="hidden" name="_token" value="testing"><button>Submit</button></form>';
        $actual = UIKit::form(
            "post /",
            UIKit::select("Select", "select")
            ->options(
                "value1 Option A",
                "value2 Option B"
            )
        )->attr("id form");
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<form action="/" method="post"><input type="hidden" name="_token" value="testing"><button>new label</button></form>';
        $actual = UIKit::form()->submitLabel("new label");
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
        $expected = 2;
        $actual = UIKit::classMap()->count;
        $this->assertEquals($expected, $actual);

        $expected = "Eightfold\\LaravelMarkup\\Elements\\Forms\\Form";
        $actual = UIKit::classMap()->first;
        $this->assertEquals($expected, $actual);
    }
}
