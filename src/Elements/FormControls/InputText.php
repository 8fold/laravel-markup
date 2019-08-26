<?php

namespace Eightfold\LaravelUIKit\Elements\FormControls;

use Eightfold\UIKit\Elements\FormControls\InputText as UIKitInputText;

use Eightfold\Html\Html;
use Eightfold\Html\Elements\HtmlElement;
use Eightfold\UIKit\UIKit;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;

class InputText extends UIKitInputText
{
    private $type;

    private $label;

    private $name;

    private $value;

    private $placeholder;

    private $errorMessage;

    private $class;

    public function __construct(
        string $label,
        string $name,
        string $value = '',
        string $placeholder = '')
    {
        $this->type = "type text";
        $this->label = Html::text($label);
        $this->name = $name;
        $this->value = "value {$value}";
        $this->placeholder = "placeholder {$placeholder}";

        $errors = session()->get('errors', new MessageBag);
        $this->errorMessage = Html::text("");
        $this->class = "class border border-black";
        if ($errors !== null && $errors->has($name)) {
            $this->errorMessage = Html::span(
                Html::text($errors->first($name))
            )->attr("class font-bold", "id ". $this->name ."-error-message", "role alert");
            $this->class = "class border border-red-600"; 
        }
    }

    public function compile(string ...$attributes): string
    {
        $input = (strlen($this->errorMessage->compile()) === 0)
            ? Html::input()->attr(
                $this->type, 
                "name ". $this->name, 
                "id ". $this->name, 
                $this->class,
                "required required"
            )
            : Html::input()->attr(
                $this->type, 
                "name ". $this->name, 
                "id ". $this->name, 
                $this->class,
                "aria-describedby ". $this->name ."-error-message",
                "required required"
            );

        return Html::div(
            Html::label($this->label)->attr("for ". $this->name),
            $this->errorMessage,
            $input
        )->is("form-control")->compile();
    }
}
