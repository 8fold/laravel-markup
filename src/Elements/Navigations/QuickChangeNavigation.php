<?php

namespace Eightfold\LaravelMarkup\Elements\Navigations;

use Eightfold\Foldable\Foldable;

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

    static public function fold(...$args): Foldable
    {
        return new static(...$args);
    }

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
        $this->content = $options;
        return $this;
    }

    public function unfold(): string
    {
        return UIKit::nav(
            UIKit::form(
                $this->methodAction,
                UIKit::select($this->label, $this->name, $this->value)
                    ->options(...$this->content)->unfold()
            )->submit($this->submitLabel)
        )->attr(...$this->submitAttr)->unfold();
    }
}
