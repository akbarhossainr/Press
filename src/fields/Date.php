<?php
namespace akbarhossainr\Press\Fields;

use Carbon\Carbon;

class Date extends FieldContract {
    public static function process($type, $value, $content)
    {
        return [$type => Carbon::parse($value)];
    }
}