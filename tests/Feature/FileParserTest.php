<?php

namespace akbarhossainr\Press\Tests;

use akbarhossainr\Press\FileParser;
use Carbon\Carbon;
use Orchestra\Testbench\TestCase;

class FileParserTest extends TestCase
{
    /** @test */
    public function the_head_and_body_get_split()
    {
        $fileParser = new FileParser(__DIR__. '/../blogs/template1.md');
        $content = $fileParser->getRawContent();

        $this->assertContains("title: My Title", $content[1]);
        $this->assertContains("description: Post description", $content[1]);
        $this->assertContains('Blog post body...', $content[2]);
    }

    /** @test */
    public function each_head_field_gets_separated()
    {
        $fileParser = new FileParser(__DIR__. '/../blogs/template1.md');
        $content = $fileParser->getContent();

        $this->assertEquals('My Title', $content['title']);
        $this->assertEquals('Post description', $content['description']);
    }

    /** @test */
    public function the_body_get_saved_and_trimed()
    {
        $fileParser = new FileParser(__DIR__. '/../blogs/template1.md');
        $content = $fileParser->getContent();

        $this->assertEquals("<h1>Heading</h1>\n<p>Blog post body...</p>", $content['body']);
    }

    /** @test */
    public function a_string_can_also_be_parsed_instead_file()
    {
        $fileParser = new FileParser("---\ntitle: My Title\n---\n\nBlog post body...");
        $content = $fileParser->getRawContent();

        $this->assertContains("title: My Title", $content[1]);
        $this->assertContains('Blog post body...', $content[2]);
    }

    /** @test */
    public function a_date_field_get_parsed()
    {
        $fileParser = new FileParser("---\ntitle: My Title\ndate: 12th July 2021\n---\n\nBlog post body...");
        $content = $fileParser->getContent();

        $this->assertInstanceOf(Carbon::class, $content['date']);
        $this->assertEquals('12/07/2021', $content['date']->format('d/m/Y'));
    }

    /** @test */
    public function an_extra_filed_get_saved()
    {
        $fileParser = new FileParser("---\nauthor: Akbar Hossain\nimage: some\image\src\n---\n");
        $content = $fileParser->getContent();

        $this->assertEquals(json_encode(['author' => 'Akbar Hossain', 'image' => 'some\image\src']), $content['extra']);
    }

}
