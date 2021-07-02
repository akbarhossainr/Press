<?php

namespace akbarhossainr\Press\Fields;

use akbarhossainr\Press\MarkdownParser;

class Body
{
    public static function process($type, $value)
    {
        return [$type => MarkdownParser::parse($value)];
    }
}
