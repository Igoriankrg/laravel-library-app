<?php


namespace App\Services\Interfaces;


use App\DTO\CreateBookDto;
use App\Repositories\Interfaces\BookRepositoryInterface;

interface BookServiceInterface
{
    public function __construct(BookRepositoryInterface $repository);
    public function getAll();
    public function getAllWithAuthors();
    public function getOneById(int $id);
    public function getOneByIdWithAuthors(int $id);
    public function getAllByIds(array $ids);
    public function create(CreateBookDto $request);
    public function update(int $id, CreateBookDto $request);
}