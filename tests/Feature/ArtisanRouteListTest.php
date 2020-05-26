<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * Class ArtisanRouteListTest
 *
 * @package Tests\Feature
 * @group artisan
 */
class ArtisanRouteListTest extends TestCase
{
    /**
     * Test that artisan route:list completes without error
     *
     * @return void
     * @test
     */
    public function testCanExecuteArtisanRouteList()
    {
        $results = Artisan::call('route:list');
        $this->assertEquals(0, $results);
    }
}
