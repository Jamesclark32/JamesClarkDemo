<?php

namespace Tests\Feature\PlaceholderUser;

use App\Models\PlaceholderUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\Feature\BaseRouteTest;

class IndexTest extends BaseRouteTest
{
    use RefreshDatabase;

    protected function getRouteName(): string
    {
        return 'api.v1.users.index';
    }

    protected function getRouteUri(): string
    {
        return 'api/v1/users';
    }

    protected function getRouteController(): Collection
    {
        return collect([
            'class' => 'App\Http\Controllers\Api\V1\UserController',
            'method' => 'index',
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
        $this->VerifyRouteNameMatchesUri($this->getRouteName(), $this->getRouteUri());
    }

    /**
     * @test
     */
    public function resolved_route_maps_to_controller()
    {
        $route = route($this->getRouteName());

        $this->VerifyRouteResolvesToController($route, $this->getRouteController());
    }

    /**
     * @test
     */
    public function route_returns_200()
    {
        $route = route($this->getRouteName());
        $this->VerifyCreateRouteReturnsExpectedResponse($route);
    }

    /**
     * @test
     */
    public function response_has_seeded_data()
    {
        $users = factory(PlaceholderUser::class, 3)->create();
        $response = $this->get(route($this->getRouteName()));

        foreach ($users as $user) {
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
}
