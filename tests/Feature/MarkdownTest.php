<?php
namespace akbarhossainr\Press\Tests;

use akbarhossainr\Press\MarkdownParser;

class MarkdownTest extends TestCase
{
    /** @test */
    public function is_parsedown_enabled()
    {
        $this->assertEquals('<h1>Heading</h1>', MarkdownParser::parse('# Heading'));
    }
}