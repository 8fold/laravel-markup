<?php

namespace Eightfold\LaravelUIKit\Elements\Forms;

use Illuminate\Support\Str;

use Eightfold\Html\Elements\HtmlElement;
use Eightfold\HtmlComponent\Interfaces\Compile;

use Eightfold\Html\Html;
// use Eightfold\UIKit\UIKit;
// use Eightfold\LaravelUIKit\UIKit as LaravelUI;

class Form extends HtmlElement implements Compile
{
    protected $method = '';
    protected $action = '';
    protected $content = [];

    public function __construct(string $methodAction = "post /", Compile ...$content)
    {
        list($method, $action) = parent::splitFirstSpace($methodAction);

        $this->method = $method;
        $this->action = $action;

        $this->content = $content;
        $this->content[] = Html::input()
            ->attr("type hidden", "name _token", "value ". csrf_token());
        $this->content[] = Html::input()
        	->attr("type hidden", "name _method", "value ". strtoupper($method));
    }

    public function compile(string ...$attributes): string
    {

        return Html::form(...$this->content)
            ->attr('method '. $this->method, 'action '. $this->action)
            ->compile(...array_merge($this->getAttr(), $attributes));
    }
}
