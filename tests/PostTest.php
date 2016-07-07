<?php

use App\Post;
use App\Enums\SyntaxType;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    /**
     * Tests bbcode parser
     *
     * @return void
     */
    public function test_bbcode_format()
    {
        $post = new Post([
            'body'   => '[b]Bold text![/b] normal text',
            'syntax' => SyntaxType::BBCode
        ]);

        $this->assertEquals('<p><strong>Bold text!</strong> normal text</p>', $post->html);
    }

    public function test_markdown_format()
    {
        $post = new Post([
            'body'   => '**Bold text!** normal text',
            'syntax' => SyntaxType::Markdown
        ]);

        $this->assertEquals('<p><strong>Bold text!</strong> normal text</p>', $post->html);
    }
}
