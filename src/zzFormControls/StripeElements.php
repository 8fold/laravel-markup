<?php

namespace Eightfold\LaravelUIKit\FormControls;

use Eightfold\UIKit\FormControls\StripeElements as PHPUIKitStripeElements;

/**
 * Laravel Stripe Elements
 *
 * This is the same as the PHP UIKit Stripe Elements, with the exception that it
 * assume an environment variable names `STRIPE_KEY`; therefore, there is no required
 * `api-key` configuration key.
 *
 * Required keys
 *
 * - **form:** The id attribute for the form.
 * - **label:** The text above the elements object.
 * - **button-label:** The text on the button.
 *
 *
 */

abstract class StripeElements extends PHPUIKitStripeElements
{
    static public function build(array $config): string
    {
        $config['api-key'] = env('STRIPE_KEY');
        return parent::build($config);
    }
}
