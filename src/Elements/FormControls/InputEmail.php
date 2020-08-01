<?php

namespace Eightfold\LaravelMarkup\Elements\FormControls;

use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Shoop\Shoop;

class InputEmail extends FormControl
{
    private $placeholder = "";
    private $maxlength = 254;

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

    public function placeholder(string $placeholder = "")
    {
        if (Shoop::string($placeholder)->isNotEmpty) {
            $this->placeholder = $placeholder;
        }
        return $this;
    }

    public function unfold(): string
    {
        $label = PHPUIKit::label($this->label)->attr("id {$this->name}-label", "for {$this->name}");
        $input = PHPUIKit::input()->attr(
            "id {$this->name}",
            "name {$this->name}",
            "aria-describedby {$this->name}-label"
        );

        if (Shoop::string($this->placeholder)->isNotEmpty) {
            $input = $input->attr(...$input->attributes()->plus("placeholder {$this->placeholder}"));
        }

        if (Shoop::string($this->maxlength)->isNotEmpty) {
            $input = $input->attr(...$input->attributes()->plus("maxlength {$this->maxlength}"));
        }

        if (Shoop::string($this->value)->isNotEmpty) {
            $input = $input->attr(...$input->attributes()->plus("value {$this->value}"));
        }

        return PHPUIKit::div($label, $input)->attr("is form-control");
    }
}
