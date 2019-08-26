<?php

namespace Eightfold\LaravelUIKit\FormControls;

use Eightfold\UIKit\FormControls\InputFile as UIKitFileInput;

use Eightfold\Html\Elements\HtmlElement;
use Eightfold\UIKit\UIKit;

class InputFile extends UIKitFileInput
{
    protected function formElement(array $content): HtmlElement
    {
        $this->attr('type file');
        // $this->_attributes['type'] = 'file';
        return UIKit::ef_text_input($content);
    }
}
