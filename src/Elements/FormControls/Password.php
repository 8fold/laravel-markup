<?php

namespace Eightfold\LaravelMarkup\Elements\FormControls;

use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Shoop\Shoop;

class Password extends FormControl
{
    private $maxlength = 254;

    static public function fold(...$args): Foldable
    {
        return new static(...$args);
    }

    public function __construct(
        string $label = "",
        string $name = "",
        string $value = ""
    )
    {
        $this->type = "password";
        $this->label = $label;
        $this->name = $name;
    }

    public function maxlength(int $maxlength = 0)
    {
        if ($maxlength > 0) {
            $this->maxlength = $maxlength;
        }
        return $this;
    }

    public function input()
    {
        $input = PHPUIKit::input()->attr(...$this->attributes()->plus(
                "id {$this->name}",
                "name {$this->name}",
                "type {$this->type}",
                "aria-describedby {$this->name}-label"
            )
        );

        if (Shoop::string($this->maxlength)->isNotEmpty) {
            $input = $input->attr(...$input->attributes()->plus("maxlength {$this->maxlength}"));
        }

        if ($this->required) {
            $input = $input->attr(...$this->attributes()->plus("required required"));
        }

        return Shoop::array([$this->error(), $input]);
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
