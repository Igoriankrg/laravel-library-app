<?php


namespace App\Http\Controllers\Api\V1;


use App\DTO\CreateAuthorDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorStoreRequest;
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
     * @param AuthorStoreRequest $request
     * @return mixed
     */
    public function create(AuthorStoreRequest $request)
    {
        $dto = $this->createAuthorDto($request);
        return $this->authorService->create($dto);
    }

    private function createAuthorDto(AuthorStoreRequest $request): CreateAuthorDto
    {
        $dto = new CreateAuthorDto();
        $dto->setName($request->post('name'));
        return $dto;
    }
}