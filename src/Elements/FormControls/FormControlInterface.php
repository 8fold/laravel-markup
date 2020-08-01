<?php

namespace Eightfold\LaravelMarkup\Elements\FormControls;

interface FormControlInterface
{
    function type();

    function value();

    function unfold();
}
