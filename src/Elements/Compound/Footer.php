<?php

namespace Eightfold\LaravelUIKit\Elements\Compound;

// use Illuminate\Support\Facades\File;

// use Eightfold\LaravelSchema\Schema;

use Eightfold\Html\Html;
use Eightfold\Html\Elements\HtmlElement;

use Eightfold\LaravelUIKit\UIKit;

class Footer extends HtmlElement
{
    public function __construct(...$args)
    {}

    public function compile(string ...$attributes): string
    {
        $linkColors = "text-8fold-teal hover:text-8fold-teal-dark";

        return Html::footer(
            Html::div(
                Html::div(
                    Html::div(
                        Html::h2(Html::text("8fold on the Web"))->attr("class w-full font-headline mt-4 mb-2 text-2xl text-8fold-white"),
                        UIKit::list(
                            UIKit::link("Media", "https://8fold.media")
                                ->attr("class {$linkColors}"),
                            UIKit::link("Software", "https://8fold.software")
                                ->attr("class {$linkColors}")
                        )
                    )->attr("class pt-2"),
                    Html::div(
                        Html::h2(
                            Html::a(
                                Html::text("8fold Handbook")
                            )->attr("href https://8fold.gitbook.io/handbook/")
                        )->attr("class w-full font-headline mt-4 mb-2 text-2xl {$linkColors}"),
                        UIKit::list(
                            UIKit::link("Culture", "https://8fold.gitbook.io/handbook/the-culture")
                                ->attr("class {$linkColors}"),
                            UIKit::link("About", "https://8fold.gitbook.io/handbook/the-basics")
                                ->attr("class {$linkColors}"),
                            UIKit::link("Users & Beyond", "https://8fold.gitbook.io/handbook/the-outer-fold")
                                ->attr("class {$linkColors}"),
                            UIKit::link("Fold System", "https://8fold.gitbook.io/handbook/the-fold-system")
                                ->attr("class {$linkColors}")
                        )
                    )->attr("class pt-2"),
                    Html::div(
                        Html::h2(
                            Html::a(
                                Html::text("Policy Palace")
                            )->attr("href https://8fold.gitbook.io/handbook/policy-palace")
                        )->attr("class w-full font-headline mt-4 mb-2 text-2xl {$linkColors}"),
                        UIKit::list(
                            UIKit::link("Privacy", "https://8fold.gitbook.io/handbook/policy-palace/privacy-agreement")
                                ->attr("class {$linkColors}"),
                            UIKit::link("Service", "https://8fold.gitbook.io/handbook/policy-palace/service-agreement")
                                ->attr("class {$linkColors}"),
                            UIKit::link("Data", "https://8fold.gitbook.io/handbook/policy-palace/data-policy")
                                ->attr("class {$linkColors}"),
                            UIKit::link("Folds", "https://8fold.gitbook.io/handbook/policy-palace/fold-policy")
                                ->attr("class {$linkColors}")
                        )
                    )->attr("class pt-2")
                )->attr("class grid col-4"),
                Html::p(Html::text("Copyright © 2019 8fold, llc"))->attr("class text-center mt-10 text-8fold-white")
            )->attr("class container m-4 mb-0 md:mx-auto")
        )->attr("class min-h-20 mt-12 bg-8fold-black")->compile();
    }
}
