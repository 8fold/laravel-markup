<?php

namespace Eightfold\LaravelUIKit;

use Eightfold\UIKit\UIKit as PHPUIKit;

/**
 * Laravel UI Kit
 *
 * Laravel UI Kit extends and overrides 8fold UI Kit to take advantage of Laravel
 * & act as a prive repo for 8fold-specific UI components.
 *
 */
class UIKit extends PHPUIKit
{
    static public function __callStatic(string $element, array $args)
    {
        $class = '';
        if (array_key_exists($element, self::CLASSES)) {
            $class = self::CLASSES[$element];
        }

        if (strlen($class) === 0) {
            return parent::$element(...$args);
        }

        if ($element === 'webView') {
            $title = $args[0];
            unset($args[0]);
            
            return new $class($title, ...$args);
        }

        if ($element === 'form') {
            $methodAction = $args[0];
            unset($args[0]);
            return new $class($methodAction, ...$args);
        }

        if ($element === 'textInput' || $element === 'link') {
            return new $class($args[0], $args[1]);
        }

        return new $class(...$args);
    }

    const CLASSES = [
          'webView'    => Elements\Pages\WebView::class,
          'form'       => Elements\Forms\Form::class,
          'emailInput' => Elements\FormControls\InputEmail::class,
          'textInput'  => Elements\FormControls\InputText::class,
          'h2'         => Elements\Simple\H2::class,
          'h3'         => Elements\Simple\H3::class,
          'button'     => Elements\Simple\Button::class,

          'practitionerCard' => Elements\Compound\PractitionerCard::class

        // , 'form' => Elements\Forms\Form::class

        //   // mimic laravel form
        // , 'csrf_field'   => Elements\Simple\CsrfField::class

        // , 'method_field' => Elements\Simple\MethodField::class
        // , 'select'     => Elements\FormControls\Select::class
    ];
}
