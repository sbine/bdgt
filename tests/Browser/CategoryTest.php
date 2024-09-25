<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/** @group category */
class CategoryTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_can_create_a_category()
    {
        $user = User::factory()->create();
        $category = Category::factory()->make();

        $this->browse(function (Browser $browser) use ($user, $category) {
            $browser
                ->loginAs($user)
                ->visit(route('categories.index'))
                ->press('.button--success')
                ->waitForText('Add a Category')
                ->screenshot('features/Category_Create')
                ->type('[name="label"]', $category->label)
                ->type('budgeted', $category->budgeted)
                ->press('Save')
                ->assertVisible('.alert--success')
                ->assertSee($category->label)
                ->logout();
        });
    }

    public function test_user_can_edit_a_category()
    {
        $user = User::factory()->create();
        $this->be($user);
        $category = Category::factory()->create();

        $category->label = 'Foo bar';
        $category->budgeted = 123.45;

        $this->browse(function (Browser $browser) use ($user, $category) {
            $browser
                ->loginAs($user)
                ->visit(route('categories.index'))
                ->click('a[href*="/categories/"]')
                ->click('.button--warning')
                ->waitForText('Edit Category')
                ->screenshot('features/Category_Edit')
                ->type('[name="label"]', $category->label)
                ->type('budgeted', $category->budgeted)
                ->press('Edit')
                ->assertVisible('.alert--success')
                ->assertSee($category->label)
                ->assertSee($category->budgeted)
                ->logout();
        });
    }

    public function test_user_can_delete_a_category()
    {
        $user = User::factory()->create();
        $this->be($user);
        $category = Category::factory()->create(['label' => 'My Category']);

        $this->browse(function (Browser $browser) use ($user, $category) {
            $browser
                ->loginAs($user)
                ->visit(route('categories.index'))
                ->click('a[href*="/categories/"]')
                ->clickLink('Delete this category')
                ->waitForText('Delete Category')
                ->screenshot('features/Category_Delete')
                ->press('Delete')
                ->assertVisible('.alert--success')
                ->assertDontSee($category->label)
                ->logout();
        });
    }
}
