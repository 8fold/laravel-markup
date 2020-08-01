<?php

namespace Eightfold\LaravelMarkup\Elements\FormControls;

use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Shoop\Shoop;

class Text extends FormControl
{
    private $placeholder = "";
    private $maxlength = 254;

    private $hasCounter = false;

    public function __construct(
        string $label = "",
        string $name = "",
        string $value = ""
    )
    {
        $this->type = "text";
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    public function email()
    {
        $this->type = "email";
        return $this;
    }

    public function long()
    {
        $this->type = "textarea";
        return $this;
    }

    public function hasCounter()
    {
        $this->hasCounter = true;
        return $this;
    }

    public function placeholder(string $placeholder = "")
    {
        if (Shoop::string($placeholder)->isNotEmpty) {
            $this->placeholder = $placeholder;
        }
        return $this;
    }

    public function maxlength(int $maxlength = 0)
    {
        if ($maxlength > 0) {
            $this->maxlength = $maxlength;
        }
        return $this;
    }

    public function label()
    {
        return PHPUIKit::label($this->label)->attr("id {$this->name}-label", "for {$this->name}");
    }

    public function input()
    {
        if ($this->type === "textarea") {
            $input = PHPUIKit::textarea($this->value)->attr(...$this->attributes()->plus(
                    "id {$this->name}",
                    "name {$this->name}",
                    "aria-describedby {$this->name}-label"
                )
            );

        } else {
            $input = PHPUIKit::input()->attr(...$this->attributes()->plus(
                    "id {$this->name}",
                    "name {$this->name}",
                    "type {$this->type}",
                    "aria-describedby {$this->name}-label"
                )
            );

        }

        if (Shoop::string($this->placeholder)->isNotEmpty) {
            $input = $input->attr(...$input->attributes()->plus("placeholder {$this->placeholder}"));
        }

        if (Shoop::string($this->maxlength)->isNotEmpty) {
            $input = $input->attr(...$input->attributes()->plus("maxlength {$this->maxlength}"));
        }

        if ($this->type !== "textarea" and Shoop::string($this->value)->isNotEmpty) {
            $input = $input->attr(...$input->attributes()->plus("value {$this->value}"));
        }

        $counter = (! $this->hasCounter)
            ? ""
            : PHPUIKit::span(
                PHPUIKit::i("{$this->maxlength}"),
                " characters remaining"
            )->attr("id {$this->name}-counter", "aria-live polite");

        return Shoop::array([$this->error(), $input, $counter]);
    }

    public function unfold(): string
    {
        $base = PHPUIKit::div($this->label(), ...$this->input());
        if (Shoop::string($this->errorMessage())->isNotEmpty) {
            return $base->attr("is form-control-with-errors");
        }
        return $base->attr("is form-control");
    }
}
