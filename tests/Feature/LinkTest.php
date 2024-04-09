<?php

namespace Tests\Feature;

use App\Models\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_link_creation_page_available(): void
    {
        $response = $this->get(route('links.create'));

        $response->assertStatus(200);
    }

    public function test_simple_link_store_success(): void
    {
        $data = [
            'original_link' => fake()->url(),
            'life_seconds' => fake()->numberBetween(0, Link::MAX_LIFE_TIME),
            'redirects_count' => fake()->numberBetween(1),
        ];

        $response = $this->post(route('links.store'), $data);

        $response->assertRedirectToRoute('links.create');

        $this->assertDatabaseHas('links', $data);
    }

    public function test_infinity_link_store_success(): void
    {
        $data = [
            'original_link' => fake()->url(),
            'life_seconds' => fake()->numberBetween(0, Link::MAX_LIFE_TIME),
            'redirects_count' => 0,
        ];

        $response = $this->post(route('links.store'), $data);

        $response->assertRedirectToRoute('links.create');

        $data['is_infinity'] = true;

        $this->assertDatabaseHas('links', $data);
    }

    public function test_link_validation_fail(): void
    {
        $response = $this->post(route('links.store'));

        $response->assertInvalid(['original_link', 'life_seconds', 'redirects_count']);

        $response = $this->post(route('links.store'), [
            'original_link' => null,
            'life_seconds' => 'invalid value type',
            'redirects_count' => 'invalid value type',
        ]);

        $response->assertInvalid(['original_link', 'life_seconds', 'redirects_count']);

        $response = $this->post(route('links.store'), [
            'original_link' => fake()->url(),
            'life_seconds' => fake()->numberBetween(Link::MAX_LIFE_TIME),
            'redirects_count' => fake()->numberBetween(),
        ]);

        $response->assertInvalid(['life_seconds']);
    }

    public function test_link_redirect_success(): void
    {
        $link = Link::factory()->create(
            [
                'life_seconds' => 60,
                'redirects_count' => 5,
            ]
        );

        $response = $this->get(route('links.redirect', ['short_link' => $link->short_link]));

        $response->assertRedirect($link->original_link);
    }

    public function test_link_redirect_decrement(): void
    {
        $redirects = 2;

        $link = Link::factory()->create(
            [
                'life_seconds' => 60,
                'redirects_count' => $redirects,
            ]
        );

        $this->get(route('links.redirect', ['short_link' => $link->short_link]));

        $link->refresh();

        $this->assertLessThan($redirects, $link->redirects_count);
    }

    public function test_link_redirect_expire(): void
    {
        $link = Link::factory()->create(
            [
                'life_seconds' => 60,
                'redirects_count' => 1,
            ]
        );

        $this->get(route('links.redirect', ['short_link' => $link->short_link]));

        $response = $this->get(route('links.redirect', ['short_link' => $link->short_link]));

        $response->assertNotFound();
    }

    public function test_link_time_expire(): void
    {
        $link = Link::factory()->create(
            [
                'life_seconds' => 60,
                'redirects_count' => 0,
            ]
        );

        $this->travel(2)->hours();

        $response = $this->get(route('links.redirect', ['short_link' => $link->short_link]));

        $response->assertNotFound();
    }
}
