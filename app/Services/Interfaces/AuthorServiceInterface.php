<?php


namespace App\Services\Interfaces;


use App\DTO\CreateAuthorDto;
use App\Repositories\Interfaces\AuthorRepositoryInterface;

interface AuthorServiceInterface
{
    public function __construct(AuthorRepositoryInterface $repository);
    public function create(CreateAuthorDto $request);
    public function getAllByIds(array $ids);
}