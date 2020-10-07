<?php

namespace Eightfold\LaravelMarkup;

use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\ESDictionary;

class UIKit extends PHPUIKit
{
    static public function form(string $methodAction = "post /", ...$controls)
    {
        return Elements\Forms\Form::fold($methodAction, ...$controls);
    }

    static public function select(string $label, string $name)
    {
        // TODO: Most likely going to want a way to hand query strings:
        // request()->query($name) === $id in previous implementations
        $class = __NAMESPACE__ .'\\Elements\\FormControls\\Select';
        if (old($name) === null) {
            $class = $class::fold($label, $name);

        } else {
            $class = $class::fold($label, $name, old($name));

        }

        if (session()->get("errors") === null or
            session()->get("errors")->first($name) === ""
        ) {
            return $class;
        }
        return $class->errorMessage(session()->get("errors")->first($name));
    }

    static public function quickChangeNavigation(
        string $methodAction = "post /",
        string $label        = "navigation",
        string $name         = "quick-change-nav",
        string $value        = ""
    )
    {
        $class = __NAMESPACE__ .'\\Elements\\Navigations\\QuickChangeNavigation';
        if (old($name) === null) {
            return $class::fold($methodAction, $label, $name, $value);
        }
        return $class::fold($methodAction, $label, $name, old($name));
    }

    static public function text(string $label, string $name)
    {
        $class = __NAMESPACE__ .'\\Elements\\FormControls\\Text';
        if (old($name) === null) {
            $class = $class::fold($label, $name);

        } else {
            $class = $class::fold($label, $name, old($name));

        }

        if (session()->get("errors") === null or session()->get("errors")->first($name) === null) {
            return $class;
        }

        return $class->errorMessage(session()->get("errors")->first($name));
    }

    static public function password(string $label, string $name)
    {
        $class = 'Elements\\FormControls\\Password';
        if (session()->get("errors") === null or session()->get("errors")->first($name) === null) {
            return $class::fold($label, $name);
        }

        return $class::fold($lable, $name)->errorMessage(session()->get("errors")->first($name));
    }
}
