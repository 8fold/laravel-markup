<?php

namespace Eightfold\LaravelUIKit\Simple;

use Eightfold\UIKit\UIKit;

/**
 * Event block
 */
class EventBlock
{
    static public function build(array $config)
    {
        $subheading = [];
        if (isset($config['subheading'])) {
            $subheading = [
                'element' => 'span',
                'attributes' => [
                    'class' => 'subheading'
                ],
                'content' => [
                    [
                        'element' => 'br'
                    ],
                    $config['subheading']
                ]
            ];
        }
        // dd($config);
        return UIKit::section([
            'attributes' => [
                'class' => 'ef-event-block'
            ],
            'content' => [
                [
                    'element' => self::heading($config),
                    'attributes' => [
                        'class' => (isset($config['heading']['class']) && strlen($config['heading']['class']) > 0)
                            ? $config['heading']['class']
                            : ''
                    ],
                    'content' => [
                        [
                            'element' => 'Eightfold\UIKit\UIKit::link',
                            'href' => $config['heading']['href'],
                            'content' => $config['heading']['content']
                        ],
                        $subheading
                    ]
                ],
                [
                    'element' => 'div',
                    'content' => $config['content']
                ]

            ]
        ]);
    }

    static private function heading(array $config): string
    {
        if (isset($config['heading']['level'])) {
            return 'h'. $config['heading']['level'];
        }
        return 'h2';
    }
}
