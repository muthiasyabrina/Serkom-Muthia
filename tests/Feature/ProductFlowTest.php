<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_dapat_diakses(): void
    {
        $response = $this->get(route('landing'));
        $response->assertOk();
        $response->assertSee('Kopi Ulee kareng');
    }
}
