<?php

namespace Eightfold\LaravelMarkup;

use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\ESDictionary;

class UIKit extends PHPUIKit
{
    static public function form(string $methodAction = "post /", ...$controls)
    {
        $class = static::classFor("form");
        return $class::fold($methodAction, ...$controls);
    }

    static public function select(string $label, string $name)
    {
        // TODO: Most likely going to want a way to hand query strings:
        // request()->query($name) === $id in previous implementations
        $class = static::classFor("select");
        if (old($name) === null) {
            $class = $class::fold($label, $name);

        } else {
            $class = $class::fold($label, $name, old($name));

        }

        if (session()->get("errors") === null or session()->get("errors")->first($name) === "") {
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
        $class = static::classFor("quickChangeNavigation");
        if (old($name) === null) {
            return $class::fold($methodAction, $label, $name, $value);
        }
        return $class::fold($methodAction, $label, $name, old($name));
    }

    static public function text(string $label, string $name)
    {
        $class = static::classFor("text");
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
        $class = static::classFor("password");
        if (session()->get("errors") === null or session()->get("errors")->first($name) === null) {
            return $class::fold($label, $name);
        }

        return $class::fold($lable, $name)->errorMessage(session()->get("errors")->first($name));
    }

    static public function classFor(string $method): string
    {
        $map = static::classMap(); // essentially cache to run once
        return $map->hasMember($method, function($result, $map) use ($method) {
            return ($result->unfold()) ? $map->{$method} : parent::{$method}();
        });
    }

    static public function classMap(): ESDictionary
    {
        $prefix = Shoop::array(["Eightfold", "LaravelMarkup", "Elements"]);
        $map = Shoop::dictionary([]);
        $compiler = Shoop::dictionary([])->plus(
            $prefix->plus("Forms", "Form"), "form",
            $prefix->plus("Navigations", "QuickChangeNavigation"), "quickChangeNavigation",
            $prefix->plus("FormControls", "Select"), "select",
            $prefix->plus("FormControls", "Text"), "text",
            $prefix->plus("FormControls", "Password"), "password"

        )->each(function($class, $method) use (&$map) {
            $class = $class->join("\\");
            $map = $map->plus($class, $method);

        });
        return $map;
    }
}
