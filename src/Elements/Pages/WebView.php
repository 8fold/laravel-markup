<?php

namespace Eightfold\LaravelUIKit\Elements\Pages;

use Illuminate\Support\Facades\Session;

use Eightfold\Html\Html;
use Eightfold\UIKit\UIKit;

use Eightfold\UIKit\Elements\Pages\WebView as UIKitWebView;


class WebView extends UIKitWebView
{
    private $scripts = [];

    private $links = [];

    private $cssFile = "";

    public function compile(string ...$attributes): string
    {
        $this->headMeta(   
            UIKit::meta()->attr("name csrf-token", "content ". csrf_token()),
            UIKit::meta()->attr("charset utf-8"),
            UIKit::meta()->attr("name viewport", "content width=device-width, initial-scale=1"),
            // UIKit::script()->attr("src ". asset('js/app.js'), "defer defer"),
            Html::link()->attr("href ". asset("css/pro.css"), "rel stylesheet")
        );
        
        $message = (Session::has("message")) 
            ? Html::p(Html::text(Session::get("message"))) 
            : Html::text("");

        array_unshift($this->bodyContent, $message);
        return parent::compile(...$attributes);
    }
}
