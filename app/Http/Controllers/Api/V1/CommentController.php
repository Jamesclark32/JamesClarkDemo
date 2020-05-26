<?php

namespace App\Http\Controllers\Api\V1;

use App\Queries\Api\V1\Comment\Index;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * @param Index $query
     *
     * @return JsonResponse
     */
    public function index(Index $query): JsonResponse
    {
        $data = $query->getData();
        return response()->json($data);
    }
}
