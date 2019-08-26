<?php

namespace Eightfold\LaravelUIKit\Elements\Simple;

use Eightfold\Html\Elements\HtmlElement;

use Eightfold\UIKit\UIKit;

/**
 * Event block
 */
class CsrfField extends HtmlElement
{
    public function __construct()
    {}

    public function compile(string ...$attributes): string
    {
        return UIKit::hidden_input('_token', csrf_token())
            ->compile(...$attributes);
    }
}
