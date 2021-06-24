<?php
namespace akbarhossainr\Press;

class MarkdownParser
{
    public static function parse($content)
    {
        return \Parsedown::instance()->text($content);
    }
}