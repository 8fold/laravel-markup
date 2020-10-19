<?php

namespace Eightfold\LaravelMarkup\Tests;

use Orchestra\Testbench\BrowserKit\TestCase;
use Eightfold\Foldable\Tests\PerformantEqualsTestFilter as AssertEquals;

use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;

use Eightfold\LaravelMarkup\UIKit;
use Eightfold\LaravelMarkup\Elements\FormControls\Select;
use Eightfold\LaravelMarkup\Elements\Navigations\QuickChangeNavigation;
use Eightfold\LaravelMarkup\Elements\FormControls\TextLong;

/**
 * @group Main
 */
class MainTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app->make('Illuminate\Contracts\Http\Kernel')
            ->pushMiddleware('Illuminate\Session\Middleware\StartSession');
    }

    /**
     * @test
     */
    public function quick_change_navigation()
    {
        $expected = '<nav id="quick-change-nav"><form action="/" method="post"><div is="form-control"><label id="quick-change-label" for="quick-change">quick change</label><select id="quick-change" name="quick-change" required><option value="value1">Option A</option><option value="value2" selected>Option B</option></select></div><input type="hidden" name="_token" value="testing"><button>Go!</button></form></nav>';

        AssertEquals::applyWith(
            $expected,
            "string",
            28.7,
            962 // 851
        )->unfoldUsing(
            QuickChangeNavigation::fold(
                "post /",
                "quick change",
                "quick-change",
                "value2"
            )->options("value1 Option A", "value2 Option B")
            ->submitLabel("Go!")->attr("id quick-change-nav")
        );
    }

    /**
     * @test
     */
    public function text()
    {
        $expected = '<div is="form-control"><label id="counter-label" for="counter">Counter</label><input id="counter" type="text" name="counter" aria-describedby="counter-label" maxlength="254" required><span id="counter-counter" aria-live="polite"><i>254</i> characters remaining</span></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            25.22, // 20.12, // 14.98,
            812
        )->unfoldUsing(
            UIKit::text("Counter", "counter")->hasCounter()
        );

        $expected = '<div is="form-control"><label id="counter-label" for="counter">Counter</label><input id="counter" class="long-text" type="text" name="counter" aria-describedby="counter-label" maxlength="254" required></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            20.72,
            1
        )->unfoldUsing(
            UIKit::text("Counter", "counter")->attr("class long-text")
        );

        $expected = '<div is="form-control-with-errors"><label id="counter-label" for="counter">Counter</label><span is="form-control-error-message" id="counter-error-message">This is our error.</span><input id="counter" type="text" name="counter" aria-describedby="counter-label" maxlength="254" required></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            6.15, // 6.12, // 5.74, // 5.59, // 5.44, // 4.53, // 4.39,
            1
        )->unfoldUsing(
            UIKit::text("Counter", "counter")
                ->errorMessage("This is our error.")
        );

        $errorBag = (new ViewErrorBag)
            ->put("default", new MessageBag([
                "counter" => ["This is our error."]
            ])
        );
        session()->put("errors", $errorBag);

        AssertEquals::applyWith(
            $expected,
            "string",
            5.63, // 5.35,
            64
        )->unfoldUsing(
            UIKit::text("Counter", "counter")
        );
    }

    /**
     * @test
     */
    public function input_email()
    {
        $expected = '<div is="form-control"><label id="email-label" for="email">Email address</label><input id="email" type="email" name="email" aria-describedby="email-label" maxlength="254" required></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            18.35,
            812
        )->unfoldUsing(
            UIKit::text("Email address", "email")->email()
        );

        $expected = '<div is="form-control"><label id="email-label" for="email">Email address</label><input id="email" type="email" name="email" aria-describedby="email-label" maxlength="254" placeholder="admin@8fold.dev" required></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            7.04,
            1
        )->unfoldUsing(
            UIKit::text("Email address", "email")->email()
                ->placeholder("admin@8fold.dev")
        );
    }

    /**
     * @test
     */
    public function text_area()
    {
        $expected = '<div is="form-control"><label id="comment-label" for="comment">Comment</label><textarea id="comment" name="comment" aria-describedby="comment-label" maxlength="254" required>hello</textarea></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            22.88, // 13.11,
            812
        )->unfoldUsing(
            UIKit::text("Comment", "comment")
                ->value("hello")->long()
        );

        $expected = '<div is="form-control"><label id="comment-label" for="comment">Comment</label><input id="comment" type="text" name="comment" value="hello" aria-describedby="comment-label" maxlength="254" required></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            13.11,
            812
        )->unfoldUsing(
            UIKit::text("Comment", "comment")
                ->value("hello")
        );
    }

    /**
     * @test
     * @group current
     */
    public function _select()
    {
        $expected = '<div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required></select></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            14.39,
            842 // 841
        )->unfoldUsing(
            UIKit::select("Select", "select")
        );

        $expected = '<div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required></select></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            12.74, // 3.97, // 3.93, // 3.9, // 3.77,
            841
        )->unfoldUsing(
            UIKit::select("Select", "select")
        );

        $expected = '<div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required><option value="value1">Option A</option><option value="value2">Option B</option></select></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            13.41, // 13.38, // 6.18, // 5.82, // 4.36,
            826
        )->unfoldUsing(
            UIKit::select("Select", "select")
            ->options(
                "value1 Option A",
                "value2 Option B"
            )
        );

        $expected = '<div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required><optgroup label="optgroup label"><option value="value1">Option A</option><option value="value2">Option B</option></optgroup><option value="value3">Option C</option></select></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            16.8, // 15.73, // 15.54, // 15.38, // 15.14, // 8.75, // 8.53, // 8.16,
            851 // 25
        )->unfoldUsing(
            UIKit::select("Select", "select")
            ->options(
                [
                    "optgroup label",
                    "value1 Option A",
                    "value2 Option B"
                ],
                "value3 Option C"
            )
        );

        session("select", "value2");
        $expected = '<div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required><option value="value1">Option A</option><option value="value2" selected>Option B</option></select></div>';

        AssertEquals::applyWith(
            $expected,
            "string",
            15.35, // 11.44, // 11.33,
            653
        )->unfoldUsing(
            Select::fold("Select", "select", "value2")
            ->options(
                "value1 Option A",
                "value2 Option B"
            )
        );

        $expected = '<fieldset is="form-control"><legend id="select-legend">Select</legend><ul><li><label for="value1">Option A</label><input id="value1" type="radio" name="select" value="value1" required></li><li><label for="value2">Option B</label><input id="value2" type="radio" name="select" value="value2" required></li><li><label for="value3">Option C</label><input id="value3" type="radio" name="select" value="value3" required></li></ul></fieldset>';

        AssertEquals::applyWith(
            $expected,
            "string",
            13.41, // 12.13,
            73 // 10
        )->unfoldUsing(
            Select::fold("Select", "select", "radio")
                ->options(
                    "value1 Option A",
                    "value2 Option B",
                    "value3 Option C"
                )->radio()
        );

        $expected = '<fieldset is="form-control"><legend id="checkbox-legend">Checkbox</legend><ul><li><label for="value1">Option A</label><input id="value1" type="checkbox" name="checkbox[]" value="value1" required></li><li><label for="value2">Option B</label><input id="value2" type="checkbox" name="checkbox[]" value="value2" required></li><li><label for="value3">Option C</label><input id="value3" type="checkbox" name="checkbox[]" value="value3" required></li></ul></fieldset>';

        AssertEquals::applyWith(
            $expected,
            "string",
            10.41,
            1
        )->unfoldUsing(
            Select::fold("Checkbox", "checkbox", "check")
                ->options(
                    "value1 Option A",
                    "value2 Option B",
                    "value3 Option C"
                )->checkbox()
        );

        $errorBag = (new ViewErrorBag)
            ->put("default", new MessageBag([
                "select" => ["This is our error."]
            ])
        );
        session()->put("errors", $errorBag);
        $expected = '<fieldset is="form-control-with-errors"><legend id="select-legend">Select</legend><span is="form-control-error-message" id="select-error-message">This is our error.</span><ul><li><label for="test">error</label><input id="test" type="radio" name="select" value="test"></li></ul></fieldset>';

        AssertEquals::applyWith(
            $expected,
            "string",
            13.77,
            738
        )->unfoldUsing(
            UIKit::select("Select", "select")->options("test error")
                ->radio()->optional()
        );
    }

    /**
     * @test
     * @group current
     */
    public function form()
    {
        // Presume Testbench token will always be empty to make testing easier.
        $expected = '<form action="/" method="post"><input type="hidden" name="_token" value="testing"><button>Submit</button></form>';

        AssertEquals::applyWith(
            $expected,
            "string",
            27.14, // 22.62, // 12.94,
            796 // 795
        )->unfoldUsing(
            UIKit::form()
        );

        $expected = '<form id="form" action="/" method="post"><input type="hidden" name="_token" value="testing"><button>Submit</button></form>';

        AssertEquals::applyWith(
            $expected,
            "string",
            4.15, // 3.94, // 3.76, // 3.62, // 3.55, // 3.52, // 2.92,
            1
        )->unfoldUsing(
            UIKit::form()->attr("id form")
        );

        $expected = '<form id="form" action="/something" method="get"><input type="hidden" name="_token" value="testing"><button>Submit</button></form>';

        AssertEquals::applyWith(
            $expected,
            "string",
            3.91, // 3.87, // 3.07,
            1
        )->unfoldUsing(
            UIKit::form(
                "get /something"
            )->attr(
                "id form"
            )
        );

        $expected = '<form id="form" action="/request" method="get"><div is="form-control"><label id="select-label" for="select">Select</label><select id="select" name="select" required><option value="value1">Option A</option><option value="value2">Option B</option></select></div><input type="hidden" name="_token" value="testing"><button>Submit</button></form>';

        AssertEquals::applyWith(
            $expected,
            "string",
            10.91, // 9.85, // 3.11,
            115 // 51
        )->unfoldUsing(
            UIKit::form(
                "get /request",
                UIKit::select("Select", "select")->options(
                    "value1 Option A",
                    "value2 Option B"
                )
            )->attr("id form")
        );

        $expected = '<form action="/" method="post"><input type="hidden" name="_token" value="testing"><button>new label</button></form>';

        AssertEquals::applyWith(
            $expected,
            "string",
            3.52, // 3.05, // 2.99,
            1
        )->unfoldUsing(
            UIKit::form()->submitLabel("new label")
        );
    }
}
