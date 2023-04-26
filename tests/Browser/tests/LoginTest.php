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
     * Succsessful login as completed user.
     */
    public function testSuccessfulLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'admin@test.com')
                ->type('password', 'admin')
                ->press('Вход')
                ->assertPathIs('/ads');
            $browser->driver->manage()->deleteAllCookies();
        });
    }

    /**
     * Login as incompleted user.
     */
    public function testLoginAsIncompletedUser(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'abv@test.com')
                ->type('password', '65124563')
                ->press('Вход')
                ->assertPathIs('/register-complete');
            $browser->driver->manage()->deleteAllCookies();
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
                ->assertSee('Потребителските данни не съвпадат.');
            $browser->driver->manage()->deleteAllCookies();
        });
    }

    /**
     * Login without credentials.
     */
    public function testLoginWithoutCredentials(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->press('Вход')
                ->assertPathIs('/login');
            $browser->driver->manage()->deleteAllCookies();
        });
    }

    /**
     * Login without email.
     */
    public function testLoginWithoutEmail(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('password', 'test')
                ->press('Вход')
                ->assertPathIs('/login');
            $browser->driver->manage()->deleteAllCookies();
        });
    }
}
