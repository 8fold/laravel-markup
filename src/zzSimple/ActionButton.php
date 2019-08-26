<?php

namespace Eightfold\LaravelUIKit\Simple;

use Eightfold\UIKit\UIKit;
use Eightfold\UIKit\FormControls\Button;
use Eightfold\LaravelUIKit\UIKit as LaravelUI;


/**
 * Action button
 *
 * The action button is a misnomer, it's a form, with an arbitrary number of hidden
 * inputs and a single button.
 *
 * UIKit::ef_action_button([
 *     'label', // button label
 *     'post action', // form post and action for button
 *     ['key value', 'key value'], // the hidden input values
 *     'button type' // type of buttons
 * ])
 *
 * @todo
 *
 * Should be able to create an ef_laravel_button - which would have the CSRF hidden
 * input inside it. Cut down on having to put in all the forms.
 *
 */
class ActionButton extends Button
{
    public function compile(string ...$attributes): string
    {
        $content = $this->_content[0];

        list($buttonLabel, $methodAction, $inputSettings) = $content;

        list($method, $action) = parent::splitFirstSpace($methodAction);

        $type = 'primary';
        if (isset($content[3]) && strlen($content[3]) > 0) {
            $type = $content[3];
        }

        $button = UIKit::ef_button($buttonLabel)->type($type);

        $inputs = [LaravelUI::csrf_field()];
        if (is_string($inputSettings)) {
            $inputSettings = [$inputSettings];
        }
        foreach ($inputSettings as $input) {
            if (is_string($input)) {
                $config = parent::splitFirstSpace($input);
                $inputs[] = UIKit::ef_hidden_input($config);

            } else {
                $inputs[] = $input;

            }
        }

        return UIKit::form([$button, $inputs])
            ->attr('method '. $method, 'action '. $action)
            ->compile();
    }
}
