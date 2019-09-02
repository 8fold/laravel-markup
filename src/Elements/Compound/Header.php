<?php

namespace Eightfold\LaravelUIKit\Elements\Compound;

use Eightfold\Html\Elements\HtmlElement;

use Eightfold\Html\Html;
use Eightfold\LaravelUIKit\UIKit;

class Header extends HtmlElement
{
    public function __construct()
    {}

    public function compile(string ...$attributes): string
    {
        $attr = "class block text-8fold-teal hover:text-8fold-teal-dark pt-4 text-center text-2xl";
        return Html::header(
            Html::div(
                Html::nav(
                    Html::a(
                        Html::span(Html::text("8fold Pro(fessionals)"))->attr("class sr-only")
                    )->attr(
                        "href /",
                        "style background-image: url(". asset('/assets/img/8foldProLogo.svg') .")",
                        "class block h-12 w-40 bg-contain bg-center bg-no-repeat"
                    ),
                    UIKit::link("Practitioners", "#practitioners")
                        ->attr($attr),
                    UIKit::link("Appearances", "#appearances")
                        ->attr($attr),
                    UIKit::link("Registrations", "#registrations")
                        ->attr($attr)
                )->attr("class grid col-4")
            )->attr("class container mx-auto")
        )->attr("class bg-8fold-black")->compile();
    }
}
