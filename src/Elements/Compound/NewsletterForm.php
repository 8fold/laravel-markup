<?php

namespace Eightfold\LaravelUIKit\Elements\Compound;

use Illuminate\Support\Facades\File;

use Eightfold\LaravelSchema\Schema;

use Eightfold\Html\Html;
use Eightfold\Html\Elements\HtmlElement;

use Eightfold\LaravelUIKit\UIKit;

class NewsletterForm extends HtmlElement
{
    public function __construct(...$args)
    {}

    public function compile(string ...$attributes): string
    {
        return Html::div(
            UIKit::h3("8fold inCrease"),
            Html::p(Html::text("Our newsletter, which we send no more than once a month.")),
            UIKit::form(
                "post /",
                UIKit::emailInput(),
                // TODO: Provide subtraction, multiplication, and division
                UIKit::mathCaptcha(),
                UIKit::button("Keep up with The Fold")
            )->attr("class text-8fold-teal-dark m-2")
        )->attr("class bg-white p-2 m-3 mb-6 shadow rounded-lg border border-8fold-teal")->compile();
    }
}
