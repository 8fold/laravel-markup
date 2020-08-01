<?php

namespace Eightfold\LaravelMarkup\Elements\FormControls;

use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Shoop\Shoop;

class TextEmail extends Text
{
    public function __construct(
        string $label = "Email address",
        string $name = "email",
        string $value = ""
    )
    {
        $this->type = "email";
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    public function unfold(): string
    {
        $label = $this->label();
        $input = $this->input();

        return PHPUIKit::div($label, $input)->attr("is form-control");
    }
}
