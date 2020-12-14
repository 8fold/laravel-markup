<?php

namespace Eightfold\LaravelMarkup\Elements\Forms;

use Eightfold\Markup\Html\HtmlElement;

use Eightfold\Markup\Html;
use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Foldable\Foldable;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Helpers\Type;

class Form extends HtmlElement
{
    private $method = "post";
    private $action = "/";

    protected $submitLabel = "Submit";
    protected $submitAttr  = [];

    static public function fold(...$args): Foldable
    {
        return new static(...$args);
    }

    public function __construct($methodAction, ...$content)
    {
        list($method, $action) = Shoop::this($methodAction)
            ->divide(" ", false, 2)->unfold();
        $this->attr("method ". $method, "action ". $action);

        $this->method  = $method;
        $this->action  = $action;
        $this->content = Shoop::this($content);
    }

    public function submit(string $label = "Submit", string ...$attr)
    {
        $this->submitLabel = $label;
        $this->submitAttr  = $attr;
        return $this;
    }

    /**
     * @deprecated
     */
    public function submitLabel(string $label = "")
    {
        $this->submit($label, $this->submitAttr);
        return $this;
    }

    /**
     * @deprecated
     */
    public function submitAttr(string ...$attr)
    {
        $this->submit($this->submitLabel, $attr);
        return $this;
    }

    public function unfold(): string
    {
        $token = csrf_token();
        if (env("APP_ENV") === "testing" and $token === null) {
            $token = "testing";
        }

        $content = $this->content->append([
            PHPUIKit::input()->attr("type hidden", "name _token", "value {$token}"),
            PHPUIKit::button($this->submitLabel)->attr(...$this->submitAttr)
        ]);

        return Html::form(...$content)
            ->attr(
                ...Shoop::this($this->attrList())->append([
                    "action {$this->action}",
                    "method {$this->method}"
                ])->each(function($v, $m, &$build) {
                    if (Shoop::this($build)->has($v)->reversed()->unfold()) {
                        $build[] = $v;
                    }
                })->unfold()
            )->unfold();
    }
}
