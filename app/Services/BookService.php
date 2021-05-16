<?php


namespace App\Services;


class BookService extends AbstractService
{
    public function getAll(): array
    {
        return $this->repository->findAll();
    }
}