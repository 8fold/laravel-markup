<?php

namespace Eightfold\LaravelUIKit\Elements\Compound;

use Eightfold\Html\Html;
use Eightfold\Html\Elements\HtmlElement;

use Eightfold\UIKit\UIKit;

use Eightfold\LaravelUIKit\UIKit as LaravelUIKit;

class PractitionerCard extends HtmlElement
{
	private $schema = "";

    public function __construct(...$args)
    {
    	$this->schema = $args[0];
    }

    public function compile(string ...$attributes): string
    {
        $person = $this->schema;
        $name = Html::text($person->givenName() ." ". $person->familyName());

        $links = [];
        $titles = $person->sameAsText();
        $linkClass = "class text-8fold-teal-dark hover:text-8fold-teal inline-block m-2";
        $i = 0;
        if (strlen($person->email()) > 0) {
            $links[] = UIKit::link($titles[$i], "mailto:". $person->email())->attr("property email", $linkClass);
            $i++;
        }
        
        foreach ($person->sameAs() as $url) {
            $links[] = UIKit::link($titles[$i], $url)->attr("property sameAs", $linkClass);
            $i++;
        }
        $linksPara = UIKit::p(...$links)->attr("class text-center");
        return Html::div(
            Html::img()->attr("property image", "class mx-auto rounded-full w-48 h-48 mt-6", "src " .asset($person->image())),
            Html::p($name)->attr("property name", "class text-center text-2xl font-bold m-3"),
            $linksPara
        )->attr("vocab http://schema.org/", "typeof Person", "class bg-white p-2 m-3 mb-6 shadow rounded-lg border border-8fold-teal")->compile();
    }
}
