<?php


namespace App\Repositories\Ar;


use App\Models\BookAuthor;
use App\Repositories\Interfaces\BookAuthorRepositoryInterface;

class BookAuthorRepository implements BookAuthorRepositoryInterface
{
    protected $model = BookAuthor::class;

    public function findAllByAuthorId(int $id)
    {
        return $this->model::where('author_id', $id)->get();
    }
}