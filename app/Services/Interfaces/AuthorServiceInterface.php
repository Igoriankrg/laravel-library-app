<?php


namespace App\Services\Interfaces;


use App\Repositories\Interfaces\AuthorRepositoryInterface;

interface AuthorServiceInterface
{
    public function __construct(AuthorRepositoryInterface $repository);
    public function create(array $data);
    public function getAllByIds(array $ids);
}