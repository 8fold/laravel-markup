<?php

namespace Eightfold\LaravelMarkup\Tests;

use Orchestra\Testbench\BrowserKit\TestCase;
// use PHPUnit\Framework\TestCase;

use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;

use Eightfold\LaravelMarkup\UIKit;
use Eightfold\LaravelMarkup\Elements\FormControls\Select;
use Eightfold\LaravelMarkup\Elements\Navigations\QuickChangeNavigation;
use Eightfold\LaravelMarkup\Elements\FormControls\TextLong;

class MainTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app->make('Illuminate\Contracts\Http\Kernel')
            ->pushMiddleware('Illuminate\Session\Middleware\StartSession');
    }

    public function testQuickChangeNavigation()
    {
        $expected = '<nav id="quick-change-nav"><form action="/" method="post"><div is="form-control"><label id="quick-change-label" for="quick-change">quick change</label><select id="quick-change" name="quick-change" required><option value="value1">Option A</option><option value="value2" selected>Option B</option></select></div><input type="hidden" name="_token" value="testing"><button>Go!</button></form></nav>';
        $actual = QuickChangeNavigation::fold(
            "post /",
            "quick change",
            "quick-change",
            "value2"
        )->options("value1 Option A", "value2 Option B")
        ->submitLabel("Go!")->attr("id quick-change-nav");
        $this->assertEquals($expected, $actual->unfold());
    }

    public function testText()
    {
        $expected = '<div is="form-control"><label id="counter-label" for="counter">Counter</label><input id="counter" type="text" name="counter" aria-describedby="counter-label" maxlength="254"><span id="counter-counter" aria-live="polite"><i>254</i> characters remaining</span></div>';
        $actual = UIKit::text("Counter", "counter")->hasCounter();
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<div is="form-control"><label id="counter-label" for="counter">Counter</label><input id="counter" class="long-text" type="text" name="counter" aria-describedby="counter-label" maxlength="254"></div>';
        $actual = UIKit::text("Counter", "counter")->attr("class long-text");
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<div is="form-control-with-errors"><label id="counter-label" for="counter">Counter</label><span is="form-control-error-message" id="counter-error-message">This is our error.</span><input id="counter" type="text" name="counter" aria-describedby="counter-label" maxlength="254"></div>';
        $actual = UIKit::text("Counter", "counter")
            ->errorMessage("This is our error.");
        $this->assertEquals($expected, $actual->unfold());

        $errorBag = (new ViewErrorBag)
            ->put("default", new MessageBag([
                "counter" => ["This is our error."]
            ])
        );
        session()->put("errors", $errorBag);
        $actual = UIKit::text("Counter", "counter");
        $this->assertEquals($expected, $actual->unfold());
    }

    public function testInputEmail()
    {
        $expected = '<div is="form-control"><label id="email-label" for="email">Email address</label><input id="email" type="email" name="email" aria-describedby="email-label" maxlength="254"></div>';
        $actual = UIKit::text("Email address", "email")->email();
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<div is="form-control"><label id="email-label" for="email">Email address</label><input id="email" type="email" name="email" aria-describedby="email-label" maxlength="254" placeholder="admin@8fold.dev"></div>';
        $actual = UIKit::text("Email address", "email")->email()
            ->placeholder("admin@8fold.dev");
        $this->assertEquals($expected, $actual->unfold());
    }

    public function testTextarea()
    {
        $expected = '<div is="form-control"><label id="comment-label" for="comment">Comment</label><textarea id="comment" name="comment" aria-describedby="comment-label" maxlength="254">hello</textarea></div>';
        $actual = UIKit::text("Comment", "comment")
            ->value("hello")->long();
        $this->assertEquals($expected, $actual->unfold());
    }

    public function testSelect()
    {
        $expected = '<div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required></select></div>';
        $actual = UIKit::select("Select", "select");
        $this->assertEquals($expected, $actual->unfold());

        $errorBag = (new ViewErrorBag)
            ->put("default", new MessageBag([
                "select" => ["This is our error."]
            ])
        );
        session()->put("errors", $errorBag);
        $expected = '<div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select"></select></div>';
        $actual = UIKit::select("Select", "select")->optional();
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required></select></div>';
        $actual = UIKit::select("Select", "select");
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required><option value="value1">Option A</option><option value="value2">Option B</option></select></div>';
        $actual = UIKit::select("Select", "select")
            ->options(
                "value1 Option A",
                "value2 Option B"
            );
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required><optgroup label="optgroup label"><option value="value1">Option A</option><option value="value2">Option B</option></optgroup><option value="value3">Option C</option></select></div>';
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

        session("select", "value2");
        $expected = '<div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required><option value="value1">Option A</option><option value="value2" selected>Option B</option></select></div>';
        $actual = Select::fold("Select", "select", "value2")
            ->options(
                "value1 Option A",
                "value2 Option B"
            );
        $this->assertEquals($expected, $actual->unfold());

        $expected = '<fieldset is="form-control"><legend>Select</legend><ul><li><label for="optgroup">label</label><input id="optgroup" type="radio" name="select" value="optgroup" checked required></li><li><label for="value1">Option A</label><input id="value1" type="radio" name="select" value="value1" required></li><li><label for="value2">Option B</label><input id="value2" type="radio" name="select" value="value2" required></li><li><label for="value3">Option C</label><input id="value3" type="radio" name="select" value="value3" required></li></ul></fieldset>';
        $actual = Select::fold("Select", "select", "optgroup")
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

        $expected = '<form id="form" action="/" method="post"><div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required><option value="value1">Option A</option><option value="value2">Option B</option></select></div><input type="hidden" name="_token" value="testing"><button>Submit</button></form>';
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
        $expected = 4;
        $actual = UIKit::classMap()->count;
        $this->assertEquals($expected, $actual);

        $expected = "Eightfold\\LaravelMarkup\\Elements\\Forms\\Form";
        $actual = UIKit::classMap()->first;
        $this->assertEquals($expected, $actual);
    }
}
