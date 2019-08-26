<?php

namespace Eightfold\LaravelUIKit\Simple;

use Eightfold\UIKit\UIKit;

/**
 * Markdown JavaScript
 *
 * Required key
 *
 * - **for:** An array of id attributes to apply the editor to.
 *
 * Optional key
 *
 * - **hide-options:** An array of menu items to hide.
 *
 */
class MarkdownJs
{
    /**
     * Components::markdownjs(array $ids, array $hideOptions['heading', 'image'])
     *
     * @param  array  $config [description]
     * @return [type]         [description]
     */
    static public function build(array $config): string
    {
        $build = [];
        $hideOptions = ['heading', 'image'];
        if (isset($config['hide-options'])) {
            $hideOptions = $config['hide-options'];
        }

        foreach ($config['for'] as $id) {
            $js = 'var simplemde = new SimpleMDE({'.
                    'element: document.getElementById("'. $id .'"),'.
                    'autoDownloadFontAwesome: false,';
            if (isset($config['hide-options'])) {
                $js .= 'hideIcons: [\''. implode('\',\'', $hideOptions) .'\']';
            }

            $js .= '});';
            $build[] = $js;
        }
        return implode('', $build);
    }
}
