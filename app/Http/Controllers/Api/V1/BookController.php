<?php


namespace App\Http\Controllers\Api\V1;


use App\DTO\Requests\BookStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Http\Requests\BookPutRequest;
use App\Services\Interfaces\BookAuthorServiceInterface;
use App\Services\Interfaces\BookServiceInterface;
use App\Services\Interfaces\BookStoreInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;
    protected $bookStoreService;
    protected $bookAuthorService;

    /**
     * Create a new BookController instance.
     *
     * @param BookServiceInterface $bookService
     * @param BookStoreInterface $bookStoreService
     * @param BookAuthorServiceInterface $bookAuthorService
     */
    public function __construct(
        BookServiceInterface $bookService,
        BookStoreInterface $bookStoreService,
        BookAuthorServiceInterface $bookAuthorService
    )
    {
        $this->bookService = $bookService;
        $this->bookStoreService = $bookStoreService;
        $this->bookAuthorService = $bookAuthorService;

        $this->middleware('auth:api', ['except' => ['index', 'getById']]);
    }

    /**
     * @OA\Get(
     *    tags={"Books"},
     *    path="/v1/books",
     *    description="Get all books",
     *    summary="Return all books",
     *    @OA\Parameter(
     *        name="author_id",
     *        description="Return books by author id",
     *        required=false,
     *        in="path",
     *        @OA\Schema(
     *            type="integer"
     *        )
     *      ),
     *    @OA\Response(
     *        response=200,
     *        description="Books arrray",
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
     *                   description="Book name",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="authors",
     *                   nullable=false,
     *                   description="Array of book authors",
     *                   type="array",
     *                   @OA\Items(
     *                      type="array",
     *                      @OA\Items()
     *                   ),
     *               ),
     *            )
     *        ),
     *    ),
     * )
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if ($request->get('author_id')) {
            $bookIds = $this->bookAuthorService->getAllBookIdsByAuthorId($request->get('author_id'));
            return $this->bookService->getAllByIds($bookIds);
        }
        return $this->bookService->getAllWithAuthors();
    }

    /**
     * @OA\Get(
     *    tags={"Books"},
     *    path="/v1/books/{id}",
     *    description="Get one book by it's id",
     *    summary="Return one book",
     *    @OA\Response(
     *        response=200,
     *        description="Book array",
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
     *                   description="Book name",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="authors",
     *                   nullable=false,
     *                   description="Array of book authors",
     *                   type="array",
     *                   @OA\Items(
     *                      type="array",
     *                      @OA\Items()
     *                   ),
     *               ),
     *            )
     *        ),
     *    ),
     * )
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->bookService->getOneByIdWithAuthors($id);
    }

    /**
     * @OA\Post(
     *     tags={"Books"},
     *     path="/v1/books",
     *     description="Create book",
     *     summary="Create book",
     *     @OA\RequestBody(
     *          description="Book body",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="name",
     *                  nullable=false,
     *                  description="Book name",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="authors",
     *                  nullable=false,
     *                  description="Array of book authors ids",
     *                  type="array",
     *                  @OA\Items(
     *                      type="integer",
     *                      @OA\Items()
     *                  ),
     *              ),
     *          ),
     *     ),
     *    @OA\Response(
     *        response=200,
     *        description="Book array",
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
     *                   description="Book name",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="authors",
     *                   nullable=false,
     *                   description="Array of book authors",
     *                   type="array",
     *                   @OA\Items(
     *                      type="array",
     *                      @OA\Items()
     *                   ),
     *               ),
     *            )
     *        ),
     *    ),
     *     security={
     *         {"jwt_token": "token example"}
     *     }
     * )
     * @param BookPostRequest $request
     * @return mixed
     */
    public function create(BookPostRequest $request)
    {
        $dto = $this->createBookStoreDto($request);
        return $this->bookStoreService->create($dto);
    }

    /**
     * @OA\Put(
     *     tags={"Books"},
     *     path="/v1/books/{id}",
     *     description="Update book",
     *     summary="Update book",
     *     @OA\RequestBody(
     *          description="Book body",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="name",
     *                  nullable=false,
     *                  description="Book name",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="authors",
     *                  nullable=false,
     *                  description="Array of book authors ids",
     *                  type="array",
     *                  @OA\Items(
     *                      type="integer",
     *                      @OA\Items()
     *                  ),
     *              ),
     *          ),
     *     ),
     *    @OA\Response(
     *        response=200,
     *        description="Book array",
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
     *                   description="Book name",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="authors",
     *                   nullable=false,
     *                   description="Array of book authors",
     *                   type="array",
     *                   @OA\Items(
     *                      type="array",
     *                      @OA\Items()
     *                   ),
     *               ),
     *            )
     *        ),
     *    ),
     *     security={
     *         {"jwt_token": "token example"}
     *     }
     * )
     * @param $id
     * @param BookPutRequest $request
     * @return mixed
     */
    public function update($id, BookPutRequest $request)
    {
        $dto = $this->createBookStoreDto($request);
        return $this->bookStoreService->update($id, $dto);
    }

    private function createBookStoreDto(\App\Http\Requests\BookStoreRequest $request): BookStoreRequest
    {
        $dto = new BookStoreRequest();
        $dto->setName($request->post('name'));
        $dto->setAuthors($request->post('authors'));
        return $dto;
    }
}