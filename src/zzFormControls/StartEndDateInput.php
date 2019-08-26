<?php

namespace Eightfold\LaravelUIKit\FormControls;

use Eightfold\LaravelUIKit\UIKit;

class StartEndDateInput
{
    static public function build(array $config): string
    {
        $start = UIKit::dateinput(static::configWithPrefix($config['name'] . '_start', $config));
        $end = UIKit::dateinput(static::configWithPrefix($config['name'] .'_end', $config));
        return $start . $end;
    }

    static private function configWithPrefix(string $prefix, array $config)
    {
        $year = $prefix .'_date_year';
        $month = $prefix .'_date_month';
        $day = $prefix .'_date_day';

        $errors = $config['errors'];
        $error = '';
        if ($errors->has($year)) {
            $error = $errors->first($year);

        } elseif ($errors->has($month)) {
            $error = $errors->first($month);

        } elseif ($errors->has($day)) {
            $error = $errors->first($day);

        }

        $labelKey = str_replace($config['name'] .'_', '', $prefix) .'_label';
        return [
            'label' => $config[$labelKey],
            'name' => $prefix .'_date',
            'hint' => (isset($config[$prefix .'_hint']))
                ? $config[$prefix .'_hint']
                : '',
            'year_value' => (isset($config['old'][$year]))
                ? $config['old'][$year]
                : '',
            'month_value' => (isset($config['old'][$month]))
                ? $config['old'][$month]
                : '',
            'day_value' => (isset($config['old'][$day]))
                ? $config['old'][$day]
                : '',
            'error' => $error
        ];
    }
}
