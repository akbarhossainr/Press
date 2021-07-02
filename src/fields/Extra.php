<?php
namespace akbarhossainr\Press\Fields;

class Extra extends FieldContract {
    public static function process($type, $value, $content)
    {
        $extra = isset($content['extra']) ? (array) json_decode($content['extra']) : [];
        return [
            'extra' => json_encode(array_merge($extra, [$type => $value]))
        ];
    }
}