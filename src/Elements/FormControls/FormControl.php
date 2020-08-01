<?php

namespace Eightfold\LaravelMarkup\Elements\FormControls;

use Eightfold\Markup\Html\Elements\HtmlElement;

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

}
