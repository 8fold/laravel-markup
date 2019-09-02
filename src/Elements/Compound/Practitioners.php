<?php

namespace Eightfold\LaravelUIKit\Elements\Compound;

use Illuminate\Support\Facades\File;

use Eightfold\LaravelSchema\Schema;

use Eightfold\Html\Html;
use Eightfold\Html\Elements\HtmlElement;

use Eightfold\LaravelUIKit\UIKit;

class Practitioners extends HtmlElement
{
    public function __construct(...$args)
    {}

    public function compile(string ...$attributes): string
    {
        $dataPath = UIKit::data_path();

        $featuredPractitioners = [UIKit::h2("Featured Practitioners")->attr("id practitioners")];
        $files = File::allFiles($dataPath ."/practitioners");
        foreach ($files as $practitioner) {
            $filePath = $practitioner->getRealPath();
            $schema = Schema::fromPath($filePath);
            $featuredPractitioners[] = UIKit::practitionerCard($schema);
        }

        return Html::div(...$featuredPractitioners)->attr("class grid col-2")->compile();
    }
}
