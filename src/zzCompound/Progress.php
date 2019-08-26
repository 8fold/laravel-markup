<?php

namespace Eightfold\LaravelUIKit\Compound;

use Eightfold\UIKit\UIKit;

/**
 *
 * UIKit::ef_progress(50.0)
 *     ->labels('label1', 'label2', label3)
 *     ->links(Link1, Link2, Link3)
 */
abstract class Progress
{
    private $_labels = [];
    private $_links = [];

    public function compile(string ...$attributes): string
    {

    }

    public function labels(string ...$labels): Progress
    {
        $this->_labels = $labels;
        return $this;
    }

    public function links(Link ...$links): Progress
    {
        $this->_links = $links;
        return $this;
    }
}
