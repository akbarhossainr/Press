<?php

namespace akbarhossainr\Press\Fields;

use akbarhossainr\Press\MarkdownParser;

class Body extends FieldContract
{
    public static function process($type, $value, $content)
    {
        return [$type => MarkdownParser::parse($value)];
    }
}
