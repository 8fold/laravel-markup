<?php

namespace Eightfold\LaravelUIKit\Elements\FormControls;

use Illuminate\Support\MessageBag;

use Eightfold\LaravelUIKit\Elements\FormControls\InputText;

class InputEmail extends InputText
{
    public function __construct(
        string $label = 'Email address',
        string $name = 'email',
        string $value = '',
        string $placeholder = '')
    {
        parent::__construct($label, $name, $value, $placeholder);
        if (strlen($this->placeholder) > 0) {
        	$this->placeholder($this->placeholder);

        } else {
        	$this->placeholder("john@8fold.pro");

        }
    }
}
