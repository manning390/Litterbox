<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomepageTest extends TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_forum_has_sort_links()
    {
        $this->visit('/')
            ->see('popular')
            ->see('new')
            ->see('bumped')
            ->see('notices');
    }
}
