<?php

namespace Eightfold\LaravelUIKit\Elements\FormControls;

use Eightfold\UIKit\Elements\FormControls\Select as UIKitSelect;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;

// use Eightfold\UIKit\UIKit;

/**
 * UIKit::new('select')
 *     ->label($label)
 *     ->hint($hint)
 *     ->name($name)
 *     ->options($options)
 *     ->selected(old())
 *     ->errors($errors)
 *
 */
class Select extends UIKitSelect
{
    public function compile(string ...$attributes): string
    {
        $content = $this->_content[0];
        list($label, $name) = $content;

        $old = Input::old();
        $this->_value = '';
        if (isset($content[2]) && strlen($content[2]) > 0) {
            $this->_value = 'value '. $content[2];
        }

        $errors = session()->get('errors', new MessageBag);

        if ($errors->has($name)) {
            $this->error($errors->first($name));
        }

        return parent::compile();
    }
}
