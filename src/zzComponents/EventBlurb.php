<?php

namespace Eightfold\LaravelUIKit\Components;

use GrahamCampbell\Markdown\Facades\Markdown;

use Auth;

class EventBlurb
{
    static public function render($config)
    {
        $header = (isset($config['header']))
            ? $config['header']
            : 'h2';

        $html = [];
        foreach ($config['events'] as $event) {
            if ($event->sessions()->count() > 0 || Auth::user()) {
                $html[] = '<section class="ef-content">';
                $html[] = '<'. $header .' class="ef-width-one-third">'.
                    $event->link .'<br>'.
                    '<span class="subheading">'. $event->location .'</span></'. $header .'>';
                $html[] = '<div class="ef-width-two-thirds ef-end-row">';
                if ($event->sessions()->count() == 0) {
                    $html[] = '<p class="datestamp"><span class="tag">No sessions</span>New session</p>';
                    $html[] = '<p><b>'. $event->link .'</b></p>';

                } else {
                    $html[] = static::sessions($event->sessions);

                }

                $html[] = '</div>';
                $html[] = '</section>';
            }
        }
        return implode('', $html);
    }

    static private function sessions($sessions)
    {
        $html = [];
        foreach ($sessions as $session) {
            $html[] = '<p class="datestamp"><span class="tag">'. str_singular($session->type->name) .'</span>'. $session->starting_at->toFormattedDateString() .'</p>';
            $html[] = '<p><b>'. $session->link .'</b></p>';
            $html[] = Markdown::convertToHtml($session->topic->short_description);
        }
        return implode('', $html);
    }
}
