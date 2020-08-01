<?php

namespace Eightfold\LaravelMarkup\Elements\FormControls;

use Eightfold\Markup\Html\Elements\HtmlElement;

use Eightfold\Shoop\Shoop;
use Eightfold\Markup\UIKit as PHPUIKit;

abstract class FormControl extends HtmlElement implements FormControlInterface
{
    protected $type = "";

    protected $required = true;

    protected $label = "Select";
    protected $name = "select";
    protected $value = "";

    private $errorMessage = "";

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

    public function errorMessage(string $message = "")
    {
        if (Shoop::string($message)->isNotEmpty) {
            $this->errorMessage = $message;
            return $this;
        }
        return $this->errorMessage;
    }

    protected function error()
    {
        if (Shoop::string($this->errorMessage())->isNotEmpty) {
            return PHPUIKit::span($this->errorMessage())->attr(
                "is form-control-error-message",
                "id {$this->name}-error-message",
            );
        }
        return "";
    }
}
