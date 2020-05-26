<?php

namespace Tests\Feature\PlaceholderUser;

use App\Models\PlaceholderUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\Feature\BaseRouteTest;

class ShowTest extends BaseRouteTest
{
    use RefreshDatabase;

    protected function getRouteName(): string
    {
        return 'api.v1.users.show';
    }

    protected function getRouteUri(string $userId): string
    {
        return 'api/v1/users/' . $userId;
    }

    protected function getRouteController(): Collection
    {
        return collect([
            'class' => 'App\Http\Controllers\Api\V1\UserController',
            'method' => 'show',
        ]);
    }

    /**
     * @test
     */
    public function route_name_exists()
    {
        $this->verifyRouteNameExists($this->getRouteName());
    }

    /**
     * @test
     */
    public function resolved_route_uri_matches_route_uri()
    {
        $user = factory(PlaceholderUser::class)->create();

        $routeParameters = [
            'placeholderUser' => $user->id,
        ];

        $this->VerifyRouteNameMatchesUri($this->getRouteName(), $this->getRouteUri($user->id), $routeParameters);
    }

    /**
     * @test
     */
    public function resolved_route_maps_to_controller()
    {
        $user = factory(PlaceholderUser::class)->create();

        $routeParameters = [
            'placeholderUser' => $user->id,
        ];

        $route = route($this->getRouteName(), $routeParameters);

        $this->VerifyRouteResolvesToController($route, $this->getRouteController());
    }

    /**
     * @test
     */
    public function route_returns_200()
    {
        $user = factory(PlaceholderUser::class)->create();

        $routeParameters = [
            'placeholderUser' => $user->id,
        ];

        $route = route($this->getRouteName(), $routeParameters);

        $this->VerifyCreateRouteReturnsExpectedResponse($route);
    }

    /**
     * @test
     */
    public function response_has_seeded_data()
    {
        $user = factory(PlaceholderUser::class)->create();

        $routeParameters = [
            'placeholderUser' => $user->id,
        ];

        $route = route($this->getRouteName(), $routeParameters);

        $response = $this->get($route);

        $response->assertJsonFragment([
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'phone' => $user->phone,
                'website' => $user->website,
                'remote_user_id' => (string)$user->remote_user_id,
            ]
        );
    }
}
