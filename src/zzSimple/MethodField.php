<?php

namespace Eightfold\LaravelUIKit\Simple;

use Eightfold\LaravelUIKit\UIKit;
use Eightfold\UIKit\FormControls\InputHidden;

/**
 * Event block
 */
class MethodField extends InputHidden
{
    public function compile(string ...$attributes): string
    {
        $content = $this->_content[0];
        return UIKit::ef_hidden_input(['_method', $content])->compile();
    }
}
