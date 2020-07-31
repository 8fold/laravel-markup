<?php

namespace Eightfold\LaravelUIKit\Elements\FormControls;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;

use Eightfold\LaravelUIKit\Elements\FormControls\InputText;

use Eightfold\LaravelUIKit\UIKit;

class InputMathCaptcha extends InputText
{
    private $answer = 0;

    public function __construct(
        string $label = '',
        string $name = "math_captcha",
        string $value = '',
        string $placeholder = '')
    {
        $number1 = rand(1, 50);
        $number2 = rand(1, 50);
        $this->answer = Hash::make($number1 + $number2);

        $label = "Please answer {$number1} plus {$number2}";

        parent::__construct($label, $name, $value, $placeholder);
        if (strlen($this->placeholder) > 0) {
        	$this->placeholder($this->placeholder);

        } else {
        	$this->placeholder("john@8fold.pro");

        }
    }

    public function compile(string ...$attributes): string
    {
        $text = parent::compile();
        $hidden = UIKit::hiddenInput("math_captcha_answer", $this->answer)->compile();
        return $text . $hidden;
    }
}
