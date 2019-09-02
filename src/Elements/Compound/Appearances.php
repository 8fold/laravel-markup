<?php

namespace Eightfold\LaravelUIKit\Elements\Compound;

use Illuminate\Support\Facades\File;

use Eightfold\LaravelSchema\Schema;

use Eightfold\Html\Html;
use Eightfold\Html\Elements\HtmlElement;

use Eightfold\LaravelUIKit\UIKit;

class Appearances extends HtmlElement
{
    public function __construct(...$args)
    {}

    public function compile(string ...$attributes): string
    {
        $dataPath = UIKit::data_path();

        $appearances = [UIKit::h2("Appearances")->attr("id appearances")];
        $folders = array_reverse(File::directories($dataPath ."/appearances"));
        foreach ($folders as $folder) {
            $year = explode("/", $folder);
            $year = array_pop($year);
            $appearances[] = UIKit::h3($year);

            $venues = File::allFiles($folder);
            foreach ($venues as $venue) {
                $filePath = $venue->getRealPath();
                $schema = Schema::fromPath($filePath);
                $appearances[] = Html::a(
                    Html::span(Html::text($schema->name(). " "))->attr("property name", "href ". $schema->url()),
                    Html::span(Html::text($schema->startDate(). " "))->attr("property startDate", "content ". $schema->startDate(), "class sr-only"),
                    Html::span(Html::text($schema->endDate()))->attr("property endDate", "content ". $schema->endDate(), "class sr-only")
                )->attr("class block bg-white hover:bg-8fold-white-dark p-2 py-6 m-3 mb-6 shadow rounded-lg border border-8fold-teal text-center",
                    "vocab http://schema.org/",
                    "typeof Event",
                    "href ". $schema->url()
                );
            }
        }
        return Html::div(...$appearances)->attr("class grid col-4")->compile();
    }
}
