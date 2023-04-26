<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    // /**
    //  * A Dusk test example.
    //  */
    // public function testExample(): void
    // {
    //     $this->browse(function (Browser  $browser) {
    //         $browser->visit('/')
    //                 ->assertSee('Laravel');
    //     });
    // }

    /**
     * Succsessful login.
     */
    public function testSuccessfulLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'admin@test.com')
                ->type('password', 'admin')
                ->press('Вход')
                ->assertPathIs('/ads');
        });
    }

    /**
     * Unsuccessful login.
     */
    public function testUnsuccessfulLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'admin@test.com')
                ->type('password', 'test')
                ->press('Вход')
                ->assertPathIs('/ads');
        });
    }
}
