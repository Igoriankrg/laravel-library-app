<?php


namespace App\Services;


use App\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Services\Interfaces\AuthorServiceInterface;

class AuthorService extends Service implements AuthorServiceInterface
{
    public function __construct(AuthorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function getAllByIds(array $ids)
    {
        return $this->repository->findAllByIds($ids);
    }
}