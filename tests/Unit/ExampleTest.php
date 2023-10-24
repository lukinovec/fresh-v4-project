<?php

namespace Tests\Unit;

use App\Livewire\Home;
use App\Models\Tenant;
use Livewire\Livewire;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_post_count_when_a_post_is_created()
    {
        tenancy()->initialize(Tenant::create());

        Livewire::test(Home::class)
            ->assertSee('No name')
            ->dispatch('post-created')
            ->assertSee('Posts created: 1');
    }
}
