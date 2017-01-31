<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomepageTest extends TestCase
{
    use DatabaseMigrations;

    function it_should_have_top_navigation(){
        $this->visit('/')
            ->see('Front Page')
            ->click('Front Page')
            ->seePageIs('/');

        $this->visit('/')
            ->see('Chat')
            ->click('Chat')
            ->seePageIs('chat.thecolorless.net');

        $this->visit('/')
            ->see('Search')
            ->click('Search')
            ->seePageIs('/search');
    }

    /** @test */
    function it_should_have_footer_navigation(){
        $this->visit('/')
            ->click('About')
            ->see('What is this site')
            ->seePageIs('/about');
    }

    /** @test */
    function it_should_have_thread_filters(){
        $this->visit('/')
            ->see('popular')
            ->see('new')
            ->see('bumped');
    }

    /** @test */
    function it_should_have_donations_section() {
        $this->visit('/')
            ->see('Donations');
    }

    /** @test */
    function it_should_have_friends_in_chat_section() {
        $this->visit('/')
            ->see('Friends In Chat');
    }
}
