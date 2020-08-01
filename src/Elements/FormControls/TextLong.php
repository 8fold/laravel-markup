<?php

namespace Eightfold\LaravelMarkup\Elements\FormControls;

use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Shoop\Shoop;

class TextLong extends Text
{
    public function __construct(
        string $label = "Email address",
        string $name = "email",
        string $value = ""
    )
    {
        $this->type = "textarea";
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    public function unfold(): string
    {
        $label = $this->label();
        $input = $this->input();
        // $input = PHPUIKit::textarea($this->value)->attr(
        //     "id {$this->name}",
        //     "name {$this->name}",
        //     "aria-describedby {$this->name}-label"
        // );

        // if (Shoop::string($this->placeholder)->isNotEmpty) {
        //     $input = $input->attr(...$input->attributes()->plus("placeholder {$this->placeholder}"));
        // }

        // if (Shoop::string($this->maxlength)->isNotEmpty) {
        //     $input = $input->attr(...$input->attributes()->plus("maxlength {$this->maxlength}"));
        // }

        // if (Shoop::string($this->value)->isNotEmpty) {
        //     $input = $input->attr(...$input->attributes()->plus("value {$this->value}"));
        // }

        return PHPUIKit::div($label, $input)->attr("is form-control");
    }
}