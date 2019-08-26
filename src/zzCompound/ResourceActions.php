<?php

namespace Eightfold\LaravelUIKit\Compound;

use Eightfold\UIKit\UIKit;
use Eightfold\LaravelUIKit\UIKit as LaravelUI;

/**
 * I don't know what no-actions is...no-actions is a way to tag a button if that tag
 * is in an array of no-actions.
 *
 * LaravelUI::ef_action_buttons([])
 *
 * @todo Might be worth abandoning this.
 */
abstract class ResourceActions
{
    public function compile(string ...$attributes): string
    {

    }

    static public function build(array $config): string
    {
        $actionButtons = [];
        $hide = [];
        if (isset($config['no-actions'])) {
            if (is_string($config['no-actions'])) {
                $hide = [$config['no-actions']];

            } else {
                $hide = $config['no-actions'];

            }

        }
        foreach ($config['action-buttons'] as $actionButtonConfig) {
            if ( ! in_array($actionButtonConfig['tag'], $hide)) {
                $actionButtons[] = UIKit::actionbutton($actionButtonConfig);

            }
        }
        return implode('', $actionButtons);

    }
}
