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

        if ($element === 'textInput') {
            return new $class($args[0], $args[1]);
        }

        return new $class(...$args);
        // if ($element === 'emailInput') {
        //     return new $class();
        // }

        // $class = self::classForElement($element);

        // $classElement = (object) ['class' => $class, 'element' => $element];

        // switch ($classElement) {
        //     case ($classElement->element == 'web_view'):
        //         $title = $args[0];
        //         $bodyAttr = $args[1];

        //         unset($args[0]);
        //         unset($args[1]);

        //         return new $class($title, $bodyAttr, ...$args);
        //         break;

        //     case ($classElement->element == 'csrf_field'):
        //         return new $class();
        //         break;

        //     case ($classElement->element == 'form'):
                // $methodAction = $args[0];
                // unset($args[0]);
                // return new $class($methodAction, ...$args);
        //         break;

        //     case (
        //            $classElement->element == 'select'
        //         || $classElement->element == 'text_input'
        //     ):
        //         if (isset($args[3])) {
        //             return new $class($args[0], $args[1], $args[2], $args[3]);

        //         } elseif (isset($args[2])) {
        //             return new $class($args[0], $args[1], $args[2]);

        //         }
        //         return new $class($args[0], $args[1]);
        //         break;

        //     default:
        //         return parent::$element(...$args);
        //         break;
        // }
    }

    const CLASSES = [
          'webView'    => Elements\Pages\WebView::class,
          'form'       => Elements\Forms\Form::class,
          'emailInput' => Elements\FormControls\InputEmail::class,
          'textInput'  => Elements\FormControls\InputText::class,
          'h2'         => Elements\Simple\H2::class,
          'button'     => Elements\Simple\Button::class

        // , 'form' => Elements\Forms\Form::class

        //   // mimic laravel form
        // , 'csrf_field'   => Elements\Simple\CsrfField::class

        // , 'method_field' => Elements\Simple\MethodField::class
        // , 'select'     => Elements\FormControls\Select::class
    ];
}
