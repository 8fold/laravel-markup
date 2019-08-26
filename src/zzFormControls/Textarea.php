<?php

namespace Eightfold\LaravelUIKit\FormControls;

use Eightfold\UIKit\FormControls\Textarea as PhpTextarea;

class Textarea extends PhpTextarea
{
    static public function build(array $config): string
    {
        if (!isset($config['errors'])) {
            return parent::build($config);
        }
        $errors = $config['errors'];
        $old = $config['old'];
        $key = $config['name'];
        return parent::build([
                'label' => $config['label'],
                'name' => $key,
                'error' => ($errors->has($key))
                    ? $errors->first($key)
                    : '',
                'content' => (isset($old[$key]))
                    ? $old[$key]
                    : ''
            ]);
    }
}
