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
        $class = static::classFor("select");
        if (old($name) === null) {
            return $class::fold($label, $name, "");
        }
        // TODO: Most likely going to want a way to hand query strings:
        // request()->queray($name) === $id in previous implementations
        return $class::fold($label, $name, old($name));
    }

    static public function quickChangeNavigation(
        string $methodAction = "post /",
        string $label = "navigation",
        string $name = "quick-change-nav"
    )
    {
        $class = static::classFor("quickChangeNavigation");
        if (old($name) === null) {
            return $class::fold($methodAction, $label, $name);
        }
        // TODO: Most likely going to want a way to hand query strings:
        // request()->queray($name) === $id in previous implementations
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
            $prefix->plus("FormControls", "Text"), "text"

        )->each(function($class, $method) use (&$map) {
            $class = $class->join("\\");
            $map = $map->plus($class, $method);

        });
        return $map;
    }

    // const CLASSES = [
    //       'webView'     => Elements\Pages\WebView::class,
    //       'form'        => Elements\Forms\Form::class,
    //       'emailInput'  => Elements\FormControls\InputEmail::class,
    //       'textInput'   => Elements\FormControls\InputText::class,
    //       'mathCaptcha' => Elements\FormControls\InputMathCaptcha::class,

    //       'h2'         => Elements\Simple\H2::class,
    //       'h3'         => Elements\Simple\H3::class,
    //       'button'     => Elements\Simple\Button::class,

    //       'header' => Elements\Compound\Header::class,
    //       'footer' => Elements\Compound\Footer::class,

    //       'appearances'           => Elements\Compound\Appearances::class,
    //       'featuredPractitioners' => Elements\Compound\Practitioners::class,
    //       'practitionerCard'      => Elements\Compound\PractitionerCard::class,

    //       'newsletterForm'    => Elements\Compound\NewsletterForm::class,
    //       'accountRaffleForm' => Elements\Compound\AccountRaffleForm::class
    // ];
}
