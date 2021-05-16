<?php


namespace App\Repositories\Ar;


use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    protected $model = Book::class;

    public function findAll()
    {
        $result = $this->model::with('author')->get();
        return $result;
    }
}