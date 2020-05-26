<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

abstract class BaseRouteTest extends TestCase
{
    use RefreshDatabase;

    protected function verifyRouteNameExists(string $routeName): void
    {
        $this->assertRouteNameExists($routeName);
    }

    protected function assertRouteNameExists(string $routeName): void
    {
        $this->assertTrue(Route::has($routeName));
    }

    protected function VerifyRouteNameMatchesUri(string $routeName, string $routeUri, array $parameters = []): void
    {
        $definedRouteUri = url($routeUri);
        $resolvedRouteUri = route($routeName, $parameters);

        $this->assertEquals($resolvedRouteUri, $definedRouteUri);
    }

    protected function VerifyRouteResolvesToController(string $route, Collection $routeController): void
    {
        $this->get($route);

        $this->assertEquals(get_class(Route::current()->controller), $routeController->get('class'));
        $this->assertEquals(Route::current()->getActionMethod(), $routeController->get('method'));
    }

    protected function VerifyCreateRouteReturnsExpectedResponse(string $route): void
    {
        $response = $this->get($route);
        $response->assertOk();
    }
}
