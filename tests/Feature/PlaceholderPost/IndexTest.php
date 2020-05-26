<?php

namespace Tests\Feature\PlaceholderPost;

use App\Models\PlaceholderPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\Feature\BaseRouteTest;

class IndexTest extends BaseRouteTest
{
    use RefreshDatabase;

    protected function getRouteName(): string
    {
        return 'api.v1.posts.index';
    }

    protected function getRouteUri(): string
    {
        return 'api/v1/posts';
    }

    protected function getRouteController(): Collection
    {
        return collect([
            'class' => 'App\Http\Controllers\Api\V1\PostController',
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
        $posts = factory(PlaceholderPost::class, 3)->create();
        $response = $this->get(route($this->getRouteName()));

        foreach ($posts as $post) {
            $response->assertJsonFragment([
                    'placeholder_user_id' => (string)$post->placeholder_user_id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'remote_post_id' => (string)$post->remote_post_id,
                    'remote_user_id' => (string)$post->remote_user_id,
                ]
            );
        }
    }
}
