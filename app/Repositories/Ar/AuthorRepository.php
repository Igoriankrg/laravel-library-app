<?php


namespace App\Repositories\Ar;


use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;

class AuthorRepository implements AuthorRepositoryInterface
{
    protected $model = Author::class;

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function findAllByIds(array $ids)
    {
        return $this->model::find($ids);
    }
}