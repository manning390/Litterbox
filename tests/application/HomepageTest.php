<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomepageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_should_have_thread_filters(){
        $this->visit('/')
            ->see('popular')
            ->see('new')
            ->see('bumped');
    }

    /** @test */
    function it_should_have_about_link_in_footer_navigation(){
        $this->visit('/')
            ->click('About')
            ->see('What is this site')
            ->seePageIs('/about');
    }
}
