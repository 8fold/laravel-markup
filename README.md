# 8fold Laravel Markup

An extension of the [PHP Markup](https://github.com/8fold/php-markup) project tailored to [Laravel 7+](https://github.com/laravel/laravel) (might be able to use with previous versions, just not tested).

PHP Markup was developed on the principle of removing markup from your PHP, not removing PHP from your HTML and using syntactic sugar to put right back. Laravel's Blade template is wonderful for doing the latter.

Let's be honest, the main reason for this library is to make Laravel form generation easier, while using PHP Markup instead of Blade. In other words, these components will automatically take advantage of Laravel's CSRF tokens and error bags.

## Installation

```bash
composer require 8fold/laravel-markup
```

## Usage

As an extension of PHP Markup and wanting to make it as simple as possible to switch between the two, Laravel Markup uses the same entry class (`UIKit`) under a different namespace (`Eightfold\LaravelUIKit`) and falling back to PHP Markup, PHP HTML, and PHP Element before failing out right. Therefore, if you want to switch from using PHP Markup to using Laravel Markup, you should be able to change the namespace:

```php
<?php

namespace Your\Namespace;

use Eightfold\Markup\UIKit;
```

Becomes:

```php
<?php

namespace Your\Namespace;

use Eightfold\LaravelMarkup\UIKit;
```

In some cases, the classes and methods will be named the same and use similar, if not the same, argument list.

## Details

To create a common, helpful pattern all form controls are wrapped in a block-level element; usually a `fieldset` or `div`. This encapsulates a labelling element and one or more field inputs along with optional errors, short messaging, and counters.

We define a form control as being one or more elements a user interacts with to enter data. Therefore, hidden inputs, buttons, and the form itself are not considered form controls.
