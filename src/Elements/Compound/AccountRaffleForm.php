<?php

namespace Eightfold\LaravelUIKit\Elements\Compound;

use Illuminate\Support\Facades\File;

use Eightfold\LaravelSchema\Schema;

use Eightfold\Html\Html;
use Eightfold\Html\Elements\HtmlElement;

use Eightfold\LaravelUIKit\UIKit;

class AccountRaffleForm extends HtmlElement
{
    public function __construct(...$args)
    {}

    public function compile(string ...$attributes): string
    {
        return Html::div(
            UIKit::h3("8fold Account (beta)"),
            Html::p(Html::text("Enter to win an early invitation to sign-up.")),
            UIKit::form(
                "post /sign-up",
                UIKit::emailInput(),
                UIKit::mathCaptcha(),
                // TODO: Provide subtraction, multiplication, and division
                // UIKit::textInput("Please answer {$number1} plus {$number2}", "math_captcha"),
                // UIKit::hiddenInput("math_captcha_answer", $answer),
                UIKit::button("Register for account raffle")
            )->attr("class text-8fold-teal-dark m-2")
        )->attr("class bg-white p-2 m-3 mb-6 shadow rounded-lg border border-8fold-teal")->compile();
    }
}
