<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorPostRequest;
use App\Services\Interfaces\AuthorServiceInterface;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorServiceInterface $authorService)
    {
        $this->authorService = $authorService;
        $this->middleware('auth:api');
    }

    /**
     * @OA\Post(
     *     tags={"Authors"},
     *     path="/v1/authors",
     *     description="Create author",
     *     summary="Create author",
     *     @OA\RequestBody(
     *          description="Author body",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="name",
     *                  nullable=false,
     *                  description="Author name",
     *                  type="string"
     *              ),
     *          ),
     *     ),
     *    @OA\Response(
     *        response=200,
     *        description="Author array",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(
     *               @OA\Property(
     *                   property="id",
     *                   nullable=false,
     *                   description="Id",
     *                   type="integer"
     *               ),
     *               @OA\Property(
     *                   property="name",
     *                   nullable=false,
     *                   description="Author name",
     *                   type="string"
     *               ),
     *            )
     *        ),
     *    ),
     *     security={
     *          {"jwt_token": "token example"}
     *     }
     * )
     * @param AuthorPostRequest $request
     * @return mixed
     */
    public function create(AuthorPostRequest $request)
    {
        return $this->authorService->create($request->post());
    }
}