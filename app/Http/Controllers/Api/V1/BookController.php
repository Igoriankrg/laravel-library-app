<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Http\Requests\BookPutRequest;
use App\Services\Interfaces\AuthorServiceInterface;
use App\Services\Interfaces\BookAuthorServiceInterface;
use App\Services\Interfaces\BookServiceInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;
    protected $bookAuthorService;
    protected $authorService;

    /**
     * Create a new BookController instance.
     *
     * @param BookServiceInterface $bookService
     * @param BookAuthorServiceInterface $bookAuthorService
     * @param AuthorServiceInterface $authorService
     */
    public function __construct(
        BookServiceInterface $bookService,
        BookAuthorServiceInterface $bookAuthorService,
        AuthorServiceInterface $authorService
    )
    {
        $this->bookService = $bookService;
        $this->bookAuthorService = $bookAuthorService;
        $this->authorService = $authorService;
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

    public function create(BookPostRequest $request)
    {
        $book = $this->bookService->create(['name' => $request->post('name')]);
        $this->bookAuthorService->createMultiple($book->getAttribute('id'), $request->post('authors'));
        $book['authors'] = $this->authorService->getAllByIds($request->post('authors'));
        return $book;
    }

    public function update($id, BookPutRequest $request)
    {
        $book = $this->bookService->update($id, ['name' => $request->post('name')]);
        $this->bookAuthorService->deleteAllByBookId($id);
        $this->bookAuthorService->createMultiple($id, $request->post('authors'));
        $book['authors'] = $this->authorService->getAllByIds($request->post('authors'));
        return $book;
    }
}