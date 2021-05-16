<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Services\BookService;

class BookController extends Controller
{
    protected $bookService;
    /**
     * Create a new BookController instance.
     *
     * @param BookService $bookService
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
        $this->middleware('auth:api', ['except' => ['index', 'getById']]);
    }


    public function index()
    {
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