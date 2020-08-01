<?php

namespace Eightfold\LaravelMarkup\Elements\Navigations;

use Eightfold\Markup\Html\Elements\HtmlElement;

use Eightfold\Markup\UIKit as PHPUIKit;
use Eightfold\LaravelMarkup\UIKit;

use Eightfold\LaravelMarkup\Elements\Forms\Form;
use Eightfold\LaravelMarkup\Elements\FormControls\Select;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Helpers\Type;

class QuickChangeNavigation extends Form
{
    private $methodAction = "post /";
    private $label = "navigation";
    private $name = "quick-change-nav";
    private $value = "";

    public function __construct(
        string $methodAction = "post /",
        string $label = "navigation",
        string $name = "quick-change-nav",
        string $value = ""
    )
    {
        $this->methodAction = $methodAction;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    public function options(...$options)
    {
        $this->content = Shoop::array($options);
        return $this;
    }

    public function unfold(): string
    {
        return UIKit::nav(
            UIKit::form(
                $this->methodAction,
                Select::fold($this->label, $this->name, $this->value)
                    ->options(...$this->content)
            )->submitLabel($this->submitLabel)
        )->attr(...$this->attributes());
    }
}
