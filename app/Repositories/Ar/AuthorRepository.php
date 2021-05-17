<?php


namespace App\Repositories\Ar;


use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;

class AuthorRepository implements AuthorRepositoryInterface
{
    protected $model = Author::class;

    public function create($data)
    {
        return $this->model::create($data);
    }
}