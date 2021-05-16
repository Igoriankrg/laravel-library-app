<?php


namespace App\Repositories\Ar;


use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    protected $model = Book::class;

    public function findAll()
    {
        return $this->model::get();
    }

    public function findAllWithAuthors()
    {
        return $this->model::with('authors')->get();
    }

    public function findOneById(int $id)
    {
        return $this->model::find($id);
    }

    public function findOneByIdWithAuthors(int $id)
    {
        return $this->model::with('authors')->find($id);
    }
}