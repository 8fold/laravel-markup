<?php

namespace Eightfold\LaravelMarkup\Elements\Forms;

use Eightfold\Markup\Html\Elements\HtmlElement;

use Eightfold\Markup\UIKit as PHPUIKit;

use Eightfold\Shoop\Shoop;
use Eightfold\Shoop\Helpers\Type;

class Form extends HtmlElement
{
    private $method = "post";
    private $action = "/";

    private $submitLabel = "Submit";

    public function __construct($methodAction, ...$content)
    {
        $this->content = Type::sanitizeType($content, ESArray::class);

        list($method, $action) = Shoop::string($methodAction)->divide(" ", false, 2);
        $this->attributes = Shoop::dictionary([
            "method" => $method,
            "action" => $action
        ]);
    }

    public function unfold(): string
    {
        $token = csrf_token();
        if (env("APP_ENV") === "testing" and $token === null) {
            $token = "testing";
        }

        $content = $this->content->plus(
            PHPUIKit::input()->attr("type hidden", "name _token", "value {$token}"),
            PHPUIKit::button($this->submitLabel)
        );

        return PHPUIKit::form(...$content)
            ->attr(...$this->attributes()->plus(
                "action {$this->action}",
                "method {$this->method}"
            )
        );
    }
}
