<?php


namespace App\Services;


use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Interfaces\BookServiceInterface;

class BookService extends Service implements BookServiceInterface
{
    public function __construct(BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function getAllWithAuthors()
    {
        return $this->repository->findAllWithAuthors();
    }

    public function getOneById(int $id)
    {
        return $this->repository->findOneById($id);
    }

    public function getOneByIdWithAuthors(int $id)
    {
        return $this->repository->findOneByIdWithAuthors($id);
    }

    public function getAllByIds(array $ids)
    {
        return $this->repository->findAllByIds($ids);
    }

    public function create(array $data) {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }
}