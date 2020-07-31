<?php

namespace Eightfold\LaravelUIKit\Elements\Simple;

use Eightfold\Html\Html;
use Eightfold\Html\Elements\HtmlElement;

use Eightfold\UIKit\UIKit;

class H3 extends HtmlElement
{
	private $text = "";

    public function __construct(...$text)
    {
    	$this->text = $text[0];
    }

    public function compile(string ...$attributes): string
    {
    	return Html::h3(Html::text($this->text))->attr("class m-2 font-headline text-4xl text-8fold-black-light")->compile();
    }
}
