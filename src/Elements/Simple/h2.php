<?php

namespace Eightfold\LaravelUIKit\Elements\Simple;

use Eightfold\Html\Html;
use Eightfold\Html\Elements\HtmlElement;

use Eightfold\UIKit\UIKit;

class H2 extends HtmlElement
{
	private $text = "";

    public function __construct(...$text)
    {
    	$this->text = $text[0];
    }

    public function compile(string ...$attributes): string
    {
    	return Html::h2(Html::text($this->text))->attr("class font-headline text-5xl")->compile();
    }
}
