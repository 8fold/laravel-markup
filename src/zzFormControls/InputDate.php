<?php

namespace Eightfold\UIKit\FormControls;

// use Eightfold\UIKit\UIKit;
use Eightfold\UIKit\FormControls\InputDate;

// use DateTime;
// use Eightfold\UIKit\FormControls\FormControlBase;

/**
 * Date input
 *
 * The date input component allows users to enter a date.
 *
 * @example
 * [
 *     {
 *         "label":"Date of birth",
 *         "name":"dob"
 *     }
 * ]
 */
class InputDate extends InputText
{
//     static protected function elementForContainer(array $config): string
//     {
//         return 'fieldset';
//     }

//     static protected function containerClass(array $config): string
//     {
//         $class = ['ef-date-input'];
//         if (self::hasError($config)) {
//             $class[] = 'ef-input-error';
//         }
//         return implode(' ', $class);
//     }

//     static protected function elementForLabel(array $config): string
//     {
//         return 'legend';
//     }

//     static protected function labelClass(array $config): string
//     {
//         return (self::hasError($config))
//             ? 'ef-input-error-label'
//             : '';
//     }

//     static protected function formElement(array $config): array
//     {
//         $monthFieldName = $config['name'] .'_month';
//         $dayFieldName = $config['name'] .'_day';
//         $yearFieldName = $config['name'] .'_year';

//         $monthFieldValue = (isset($config['month_value']))
//             ? $config['month_value']
//             : '';
//         $dayFieldValue = (isset($config['day_value']))
//             ? $config['day_value']
//             : '';
//         $yearFieldValue = (isset($config['year_value']))
//             ? $config['year_value']
//             : '';

//         $monthLabel = (isset($config['month-label']))
//             ? $config['month-label']
//             : 'Month';


//         $dayLabel = (isset($config['day-label']))
//             ? $config['day-label']
//             : 'Day';


//         $yearLabel = (isset($config['year-label']))
//             ? $config['year-label']
//             : 'Year';


//         $elementConfig = [
//             'element' => 'div',
//             'attributes' => [
//                 'class' => 'ef-date-of-birth'
//             ],
//             'content' => [
//                 [
//                     'element' => 'div',
//                     'attributes' => [
//                         'class' => 'ef-form-group ef-form-group-month'
//                     ],
//                     'content' => [
//                         [
//                             'element' => 'label',
//                             'for' => $monthFieldName,
//                             'content' => $monthLabel
//                         ],
//                         [
//                             'element' => 'input',
//                             'attributes' => [
//                                 'id' => $monthFieldName,
//                                 'name' => $monthFieldName,
//                                 'class' => 'ef-input-inline',
//                                 'pattern' => '0?[1-9]|1[012]',
//                                 'type' => 'number',
//                                 'min' => '1',
//                                 'max' => '12',
//                                 'maxlength' => 2,
//                                 'required' => ( ! isset($config['required']))
//                                     ? 'required'
//                                     : '',
//                                 'value' => $monthFieldValue
//                             ]
//                         ]
//                     ]
//                 ],
//                 [
//                     'element' => 'div',
//                     'attributes' => [
//                         'class' => 'ef-form-group ef-form-group-day'
//                     ],
//                     'content' => [
//                         [
//                             'element' => 'label',
//                             'for' => $dayFieldName,
//                             'content' => $dayLabel
//                         ],
//                         [
//                             'element' => 'input',
//                             'attributes' => [
//                                 'id' => $dayFieldName,
//                                 'name' => $dayFieldName,
//                                 'class' => 'ef-input-inline',
//                                 'pattern' => '0?[1-9]|1[0-9]|2[0-9]|3[01]',
//                                 'type' => 'number',
//                                 'min' => 1,
//                                 'max' => 31,
//                                 'maxlength' => 2,
//                                 'required' => ( ! isset($config['required']))
//                                     ? 'required'
//                                     : '',
//                                 'value' => $dayFieldValue
//                             ]
//                         ]
//                     ]
//                 ],
//                 [
//                     'element' => 'div',
//                     'attributes' => [
//                         'class' => 'ef-form-group ef-form-group-year'
//                     ],
//                     'content' => [
//                         [
//                             'element' => 'label',
//                             'for' => $yearFieldName,
//                             'content' => $yearLabel
//                         ],
//                         [
//                             'element' => 'input',
//                             'attributes' => [
//                                 'id' => $yearFieldName,
//                                 'name' => $yearFieldName,
//                                 'class' => 'ef-input-inline',
//                                 'pattern' => '[0-9]{4}',
//                                 'type' => 'number',
//                                 'min' => 1900,
//                                 'max' => 3000,
//                                 'maxlength' => 4,
//                                 'required' => ( ! isset($config['required']))
//                                     ? 'required'
//                                     : '',
//                                 'value' => $yearFieldValue
//                             ]
//                         ]
//                     ]
//                 ]
//             ]
//         ];
//         return $elementConfig;
//     }

//     public static function render($config)
//     {
//         static::militaryTimeZones();
//         $html = '';
//         if (static::hasError($config)) {
//             $error = ' class="ef-fieldset-inputs ef-input-error"';
//             $errorLabel = ' class="ef-input-error-label"';
//             $html = '<fieldset'. $error .'>';
//             $html .= '<legend'. $errorLabel .'>'.$config['label'].'</legend>';

//         } else {
//             $error = ' class="ef-fieldset-inputs"';
//             $html .= '<fieldset'. $error .'>';
//             $html .= '<legend>'.$config['label'].'</legend>';

//         }
//         $html .= static::hintText($config);
//         $html .= static::errorText($config);
//         $html .= UIKit::textInput([
//                 'type' => 'number',
//                 'label' => 'Month',
//                 'name' => $config['name'].'_month',
//                 'min' => '1',
//                 'max' => '12',
//                 'maxlength' => '2',
//                 'value' => (isset($config['month_value'])) ? $config['month_value'] : ''
//             ]);
//         $html .= UIKit::textInput([
//                 'type' => 'number',
//                 'label' => 'Day',
//                 'name' => $config['name'].'_day',
//                 'min' => '1',
//                 'max' => '31',
//                 'maxlength' => '2',
//                 'value' => (isset($config['day_value'])) ? $config['day_value'] : ''
//             ]);
//         if (isset($config['useMax']) && $config['useMax']) {
//             $html .= UIKit::textInput([
//                     'type' => 'number',
//                     'label' => 'Year',
//                     'name' => $config['name'].'_year',
//                     'min' => '2014',
//                     'max' => date('Y'),
//                     'maxlength' => '4',
//                     'value' => (isset($config['year_value'])) ? $config['year_value'] : ''
//                 ]);

//         } else {
//             $html .= UIKit::textInput([
//                     'type' => 'number',
//                     'label' => 'Year',
//                     'name' => $config['name'].'_year',
//                     'min' => '2014',
//                     'max' => (date('Y') + 1000),
//                     'maxlength' => '4',
//                     'value' => (isset($config['year_value'])) ? $config['year_value'] : ''
//                 ]);
//         }

//         if (isset($config['timestamp']) && $config['timestamp']) {
//             $html .= UIKit::textInput([
//                     'type' => 'number',
//                     'label' => 'Hour',
//                     'name' => $config['name'].'_hour',
//                     'min' => 0,
//                     'max' => 24,
//                     'maxlength' => '2',
//                     'value' => (isset($config['hour_value'])) ? $config['hour_value'] : ''
//                 ]);
//             $html .= UIKit::textInput([
//                     'type' => 'number',
//                     'label' => 'Minute',
//                     'name' => $config['name'].'_minute',
//                     'min' => 0,
//                     'max' => 60,
//                     'maxlength' => '2',
//                     'value' => (isset($config['minute_value'])) ? $config['minute_value'] : ''
//                 ]);

// $date = new DateTime();
// $date = $date->getTimezone();
// $date = $date->getName();
// dd(date_default_timezone_get());
// dd(system('date +%Z'));
//             $html .= UIKit::select([
//                     'label' => 'time zone',
//                     'name' => $config['name'].'_tz',
//                     'options' => static::timeZones(),
//                     'selected' => (isset($config['timezone_value'])) ? $config['timezone_value'] : ''
//                 ]);
//         }

//         $html .= '</fieldset>';

//         return $html;
//     }

//     static private function militaryTimeZones()
//     {
//         $lettersA = range('A', 'I');
//         $lettersB = range('K', 'Z');
//         $letters = array_merge($lettersA, $lettersB);
//         $tz = [];
//         for ($i=0; $i < 25; $i++) {
//             $key = $letters[$i];
//             if ($i == 24) {
//                 $value = 'UTC 0';
//                 $tz[$key] = $value;

//             } elseif ($i > 11) {
//                 $value = 'UTC -'. ($i - 11);
//                 $tz[$key] = $value;

//             } else {
//                 $value = 'UTC +'. ($i + 1);
//                 $tz[$key] = $value;
//             }
//         }
//         return $tz;
//     }

//     /**
//      * Timezones list with GMT offset
//      *
//      * @return array
//      * @link http://stackoverflow.com/a/9328760
//      */
//     static private function timeZones()
//     {
//         $zones = [];
//         $timestamp = time();
//         $onlyProcessZones = [
//             'UTC',
//             'Europe/London',
//             'Europe/Paris',
//             'Europe/Athens',
//             'Asia/Dubai',
//             'Indian/Maldives',
//             'Asia/Dhaka',
//             'Asia/Bangkok',
//             'Asia/Hong_Kong',
//             'Asia/Tokyo',
//             'Australia/Sydney',
//             'Pacific/Norfolk',
//             'Pacific/Fiji',
//             'Atlantic/Cape_Verde',
//             'Atlantic/South_Georgia',
//             'Atlantic/Bermuda',
//             'America/New_York',
//             'America/Chicago',
//             'America/Denver',
//             'America/Los_Angeles',
//             'America/Anchorage',
//             'Pacific/Gambier',
//             'Pacific/Honolulu',
//             'Pacific/Pago_Pago',

//         ];

//         foreach(timezone_identifiers_list() as $key => $zone) {
//             date_default_timezone_set($zone);
//             $offset = date('P', $timestamp);
//             $offsetString = '(UTC ' . $offset .') '. $zone;
//             if (in_array($zone, $onlyProcessZones)) {
//                 $zones[$offset] = $offsetString;

//             }
//         }
//         return $zones;
//     }
}
