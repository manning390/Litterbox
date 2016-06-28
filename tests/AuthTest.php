<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase {

    public function test_login_page_has_login_form() {
        $this->visit('/login')
            ->see('Sign in');
    }

    public function test_login_page_has_register_link(){
        $this->visit('/login')
            ->click('Register for free now')
            ->seePageIs('/register');
    }

    public function test_register_page_has_register_form(){
        $this->visit('/register')
            ->see('Sign up');
    }

}
