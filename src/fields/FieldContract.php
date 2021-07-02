<?php
namespace akbarhossainr\Press\Fields;

abstract class FieldContract {
    public static function process($fieldType, $fieldValue, $content)
    {
        return [$fieldType => $fieldValue];
    }
}