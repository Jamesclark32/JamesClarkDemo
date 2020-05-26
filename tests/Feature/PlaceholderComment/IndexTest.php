<?php

namespace Tests\Feature\PlaceholderComment;

use App\Models\PlaceholderComment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\Feature\BaseRouteTest;

class IndexTest extends BaseRouteTest
{
    use RefreshDatabase;

    protected function getRouteName(): string
    {
        return 'api.v1.comments.index';
    }

    protected function getRouteUri(): string
    {
        return 'api/v1/comments';
    }

    protected function getRouteController(): Collection
    {
        return collect([
            'class' => 'App\Http\Controllers\Api\V1\CommentController',
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
        $comments = factory(PlaceholderComment::class, 3)->create();
        $response = $this->get(route($this->getRouteName()));

        foreach ($comments as $comment) {
            $response->assertJsonFragment([
                    'placeholder_post_id' => (string)$comment->placeholder_post_id,
                    'name' => $comment->name,
                    'email' => $comment->email,
                    'body' => $comment->body,
                    'remote_comment_id' => (string)$comment->remote_comment_id,
                    'remote_post_id' => (string)$comment->remote_post_id,
                ]
            );
        }
    }
}
