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
    }

    public function create(AuthorPostRequest $request)
    {
        return $this->authorService->create($request->post());
    }
}