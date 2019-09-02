<?php

namespace Eightfold\LaravelUIKit\Elements\Simple;

use Eightfold\Html\Html;
use Eightfold\Html\Elements\HtmlElement;

use Eightfold\UIKit\UIKit;

class H2 extends HtmlElement
{
	private $text = "";

	private $textColor = "text-8fold-black";

	private $textSize = "text-5xl";

    public function __construct(...$text)
    {
    	$this->text = $text[0];
    }

    public function compile(string ...$attributes): string
    {
        $attributes = array_merge(
            ["class w-full font-headline m-2 mt-4 {$this->textSize}  {$this->textColor}"],
            $this->getAttr()
        );
    	return Html::h2(Html::text($this->text))->attr(...$attributes)->compile();
    }
}
