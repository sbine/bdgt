<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Dashboard;
use Tests\DuskTestCase;

/** @group auth */
class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_register()
    {
        $user = factory(User::class)->make(['password' => bcrypt('password')]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->visit(route('register'))
                ->assertSee('Register')
                ->type('username', $user->username)
                ->type('email', $user->email)
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->screenshot('features/Auth_Register')
                ->press('Register')
                ->assertPathIs((new Dashboard)->url())
                ->logout();
        });
    }

    /** @test */
    public function user_can_login()
    {
        $user = factory(User::class)->create(['password' => bcrypt('password')]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->visit(route('login'))
                ->assertSee('Login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->screenshot('features/Auth_Login')
                ->press('Login')
                ->assertPathIs((new Dashboard)->url())
                ->logout();
        });
    }

    /** @test */
    public function user_can_logout()
    {
        $user = factory(User::class)->create(['password' => bcrypt('password')]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->loginAs($user)
                ->visit(new Dashboard)
                ->press('Logout')
                ->assertPathIs('/')
                ->screenshot('features/Landing_Page')
                ->assertGuest();
        });
    }

    /** @test */
    public function user_can_initiate_a_password_reset()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->visit(route('login'))
                ->assertSee('Login')
                ->clickLink('Forgot your password?')
                ->assertRouteIs('password.request')
                ->type('email', $user->email)
                ->screenshot('features/Auth_Forgot_Password')
                ->press('Send Password Reset Link')
                ->assertPathIs('/password/reset');
        });
    }
}
