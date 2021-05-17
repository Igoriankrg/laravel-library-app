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

    public function findAllByIds(array $ids)
    {
        return $this->model::find($ids);
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update(int $id, array $data)
    {
        $book = $this->model::find($id);
        $book->fill($data);
        $book->save();
        return $book;
    }
}