<?php

namespace Eightfold\LaravelMarkup\Elements\FormControls;

use Eightfold\Markup\Html\Elements\HtmlElement;

use Eightfold\Shoop\Shoop;

abstract class FormControl extends HtmlElement implements FormControlInterface
{
    protected $type = "";

    protected $required = true;

    protected $label = "Select";
    protected $name = "select";
    protected $value = "";

    public function optional(bool $optional = true)
    {
        $this->required = ! $optional;
        return $this;
    }

    public function type(string $type = ""): string
    {
        if (Shoop::string($type)->isNotEmpty) {
            $this->type = $type;
            return $this;
        }
        return $this->type;
    }

    public function value(string $value = "")
    {
        if (Shoop::string($value)->isNotEmpty) {
            $this->value = $value;
            return $this;
        }
        return $this->value;
    }
}
