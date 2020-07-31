<?php

namespace Eightfold\LaravelMarkup;

use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\ESDictionary;

class UIKit extends PHPUIKit
{
    static public function form($methodAction = "post /", ...$controls)
    {
        $class = static::classFor("form");
        return $class::fold($methodAction, $controls);
    }

    // static public function __callStatic(string $element, array $args)
    // {
    //     if ($element === "data_path") {
    //         $basePath = explode("/", base_path());
    //         array_pop($basePath);
    //         $basePath = implode("/", $basePath);
    //         $dataPath = $basePath ."/data";
    //         return $dataPath;
    //     }

    //     $class = '';
    //     if (array_key_exists($element, self::CLASSES)) {
    //         $class = self::CLASSES[$element];
    //     }

    //     if (strlen($class) === 0) {
    //         return parent::$element(...$args);
    //     }

    //     if ($element === 'webView') {
    //         $title = $args[0];
    //         unset($args[0]);

    //         return new $class($title, ...$args);
    //     }

    //     if ($element === 'form') {
    //         $methodAction = $args[0];
    //         unset($args[0]);
    //         return new $class($methodAction, ...$args);
    //     }

    //     if ($element === 'textInput' || $element === 'link') {
    //         return new $class($args[0], $args[1]);
    //     }

    //     return new $class(...$args);
    // }

    static public function classFor(string $method): string
    {
        $map = static::classMap(); // essentially cache to run once
        return $map->hasMember($method, function($result, $map) use ($method) {
            return ($result->unfold()) ? $map->{$method} : "";
        });
    }

    static public function classMap(): ESDictionary
    {
        $prefix = Shoop::array(["Eightfold", "LaravelMarkup", "Elements"]);
        $map = Shoop::dictionary([]);
        $compiler = Shoop::dictionary([])->plus(
            $prefix->plus("Forms", "Form"), "form"

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
