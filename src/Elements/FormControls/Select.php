<?php

namespace Eightfold\LaravelMarkup\Elements\FormControls;

use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Helpers\Type;

class Select extends FormControl
{
    public function __construct(string $label, string $name, string $value = "")
    {
        $this->type = "dropdown";
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

    public function radio()
    {
        $this->type = "radio";
        return $this;
    }

    public function unfold(): string
    {
        $base = "";
        switch ($this->type) {
            case "radio":
                $base = $this->radioControl();
                break;

            default:
                $base = $this->selectControl();
                break;
        }

        if (Shoop::string($this->errorMessage())->isNotEmpty) {
           return $base->attr("is form-control-with-errors");
        }
        return $base->attr("is form-control");
    }

    private function radioControl()
    {
        $options = Shoop::array([]);
        $this->content->each(function($option) use (&$options) {
            if (Type::isArray($option)) {
                Shoop::this($option)->each(function($option) use (&$options) {
                    $options = $options->plus($this->option($option));
                });

            } else {
                $options = $options->plus($this->option($option));

            }
        });

        return PHPUIKit::fieldset(
            PHPUIKit::legend($this->label),
            PHPUIKit::listWith(...$options)
        );
    }

    private function selectControl()
    {
        $select = PHPUIKit::select(...$this->content->each(function($option) {
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
        )->attr("id {$this->name}", "name {$this->name}");

        if ($this->required) {
            $select = $select->attr(...$this->attributes()->plus("required required"));
        }

        return PHPUIKit::div($this->label(), $this->error(), $select);
    }

    private function option($option)
    {
        list($value, $title) = Shoop::string($option)->divide(" ", false, 2);
        if ($this->type === "radio") {
            $label = PHPUIKit::label($title)->attr("for {$value}");
            $radio = PHPUIKit::input()->attr(
                "type radio",
                "name {$this->name}",
                "value {$value}",
                "id {$value}"
            );

            if ($this->required) {
                $radio = $radio->attr(...$this->attributes()->plus("required required"));
            }

            if ($this->value === $value) {
                $radio = $radio->attr(...$this->attributes()->plus("checked checked"));
            }

            return $label . $radio;
        }

        $option = PHPUIKit::option($title)->attr("value {$value}");
        if ($this->value === $value) {
            $option = $option->attr(...$this->attributes()->plus("selected selected"));
        }

        return $option;
    }
}
