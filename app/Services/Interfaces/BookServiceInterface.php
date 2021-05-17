<?php


namespace App\Services\Interfaces;


use App\Repositories\Interfaces\BookRepositoryInterface;

interface BookServiceInterface
{
    public function __construct(BookRepositoryInterface $repository);
    public function getAll();
    public function getAllWithAuthors();
    public function getOneById(int $id);
    public function getOneByIdWithAuthors(int $id);
    public function getAllByIds(array $ids);
    public function create(array $data);
    public function update(int $id, array $data);
}