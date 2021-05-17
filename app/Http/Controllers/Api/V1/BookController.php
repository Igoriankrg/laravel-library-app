<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Services\Interfaces\BookAuthorServiceInterface;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;
    protected $bookAuthorService;

    /**
     * Create a new BookController instance.
     *
     * @param BookServiceInterface $bookService
     * @param BookAuthorServiceInterface $bookAuthorService
     */
    public function __construct(BookServiceInterface $bookService, BookAuthorServiceInterface $bookAuthorService)
    {
        $this->bookService = $bookService;
        $this->bookAuthorService = $bookAuthorService;
        $this->middleware('auth:api', ['except' => ['index', 'getById']]);
    }


    public function index(Request $request)
    {
        if ($request->get('author_id')) {
            $bookIds = $this->bookAuthorService->getAllBookIdsByAuthorId($request->get('author_id'));
            return $this->bookService->getAllByIds($bookIds);
        }
        return $this->bookService->getAllWithAuthors();
    }

    public function getById($id)
    {
        return $this->bookService->getOneByIdWithAuthors($id);
    }

    public function create()
    {

    }

    public function update()
    {

    }
}