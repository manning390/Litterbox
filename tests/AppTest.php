<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AppTest extends TestCase {

    public function test_footer_has_navigation()
    {
        $this->visit('/')
            ->see('Navigation')
            ->see('About')
            ->see('FAQ')
            ->see('Privacy Policy')
            ->see('Rules')
            ->see('Terms of Service')
            ->see('Report a Bug')
            ->see('User Guide')
            ->see('Staff');
    }

    public function test_footer_has_social(){
        $this->visit('/')
            ->see('Twitter')
            ->see('Facebook')
            ->see('Steam');
    }

    public function test_footer_has_dev_info(){
        $this->visit('/')
            ->see('We rock ❤');
    }

}
