<?php

namespace Eightfold\LaravelMarkup\Tests;

use Orchestra\Testbench\BrowserKit\TestCase;
// use PHPUnit\Framework\TestCase;

use Eightfold\LaravelMarkup\UIKit;

class MainTest extends TestCase
{
    public function testQuickChangeNavigation()
    {
        $expected = '<nav id="quick-change-nav"><form action="/" method="post"><label for="quick-change">quick change</label><select id="quick-change" name="quick-change" required><option value="value1">Option A</option><option value="value2" selected>Option B</option></select><input type="hidden" name="_token" value="testing"><button>Go!</button></form></nav>';
        $actual = UIKit::quickChangeNavigation(
            "post /",
            "quick change",
            "quick-change",
            "value2"
        )->options("value1 Option A", "value2 Option B")
        ->submitLabel("Go!")->attr("id quick-change-nav");
        $this->assertEquals($expected, $actual->unfold());
    }

    public function testSelect()
    {
        $expected = '<label for="select">Select</label><select id="select" name="select" required></select>';
        $actual = UIKit::select("Select", "select");
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<label for="select">Select</label><select id="select" name="select"></select>';
        $actual = UIKit::select("Select", "select")->optional();
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<label for="select">Select</label><select id="select" name="select" required><option value="value1">Option A</option><option value="value2">Option B</option></select>';
        $actual = UIKit::select("Select", "select")
            ->options(
                "value1 Option A",
                "value2 Option B"
            );
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<label for="select">Select</label><select id="select" name="select" required><optgroup label="optgroup label"><option value="value1">Option A</option><option value="value2">Option B</option></optgroup><option value="value3">Option C</option></select>';
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

        $expected = '<label for="select">Select</label><select id="select" name="select" required><option value="value1">Option A</option><option value="value2" selected>Option B</option></select>';
        $actual = UIKit::select("Select", "select", "value2")
            ->options(
                "value1 Option A",
                "value2 Option B"
            );
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<fieldset><legend>Select</legend><ul><li><label for="optgroup">label</label><input id="optgroup" type="radio" name="select" value="optgroup" checked required></li><li><label for="value1">Option A</label><input id="value1" type="radio" name="select" value="value1" required></li><li><label for="value2">Option B</label><input id="value2" type="radio" name="select" value="value2" required></li><li><label for="value3">Option C</label><input id="value3" type="radio" name="select" value="value3" required></li></ul></fieldset>';
        $actual = UIKit::select("Select", "select", "optgroup")
            ->options(
                [
                    "optgroup label",
                    "value1 Option A",
                    "value2 Option B"
                ],
                "value3 Option C"
            )->radio();
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

        $expected = '<form id="form" action="/" method="post"><label for="select">Select</label><select id="select" name="select" required><option value="value1">Option A</option><option value="value2">Option B</option></select><input type="hidden" name="_token" value="testing"><button>Submit</button></form>';
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
        $expected = 3;
        $actual = UIKit::classMap()->count;
        $this->assertEquals($expected, $actual);

        $expected = "Eightfold\\LaravelMarkup\\Elements\\Forms\\Form";
        $actual = UIKit::classMap()->first;
        $this->assertEquals($expected, $actual);
    }
}
