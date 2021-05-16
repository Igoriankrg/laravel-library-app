<?php


namespace App\Services;


class BookService extends AbstractService
{
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
}