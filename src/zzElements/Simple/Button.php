<?php

namespace Eightfold\LaravelUIKit\Elements\Simple;

use Eightfold\Html\Html;
use Eightfold\Html\Elements\HtmlElement;

use Eightfold\UIKit\UIKit;

class Button extends HtmlElement
{
	private $text = "";

    public function __construct(...$text)
    {
    	$this->text = $text[0];
    }

    public function compile(string ...$attributes): string
    {
        return Html::button(Html::text($this->text))
        	->attr("class bg-8fold-teal-dark hover:bg-8fold-teal text-white font-bold py-1 px-2 rounded mt-4")
        	->compile();
    }
}
