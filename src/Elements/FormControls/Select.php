<?php

namespace Eightfold\LaravelMarkup\Elements\FormControls;

use Eightfold\Markup\Html\Elements\HtmlElement;

use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Helpers\Type;

class Select extends HtmlElement
{
    private $label = "Select";
    private $name = "select";
    private $value = "";

    public function __construct(string $label, string $name, string $value = "")
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->content = Shoop::array([]);
    }

    public function options(...$options)
    {
        $this->content = Shoop::array($options);
        return $this;
    }

    public function unfold(): string
    {
        $label = PHPUIKit::label($this->label)->attr("for {$this->name}")->unfold();
        $select = PHPUIKit::select(
            ...$this->content->each(function($option) {
                if (Type::isArray($option)) {
                    $group = Shoop::array($option);
                    $label = $group->first;
                    $options = $group->dropFirst();
                    return PHPUIKit::optgroup(
                        ...$options->each(function($option) {
                            return $this->option($option);
                        })
                    )->attr("label {$group->first}");
                }
                return $this->option($option);
            })
        )->attr("id {$this->name}", "name {$this->name}")->unfold();
        return $label . $select;
    }

    private function option($option)
    {
        list($value, $title) = Shoop::string($option)->divide(" ", false, 2);
        return ($this->value === $value)
            ? PHPUIKit::option($title)->attr("value {$value}", "selected selected")
            : PHPUIKit::option($title)->attr("value {$value}");
    }
}
