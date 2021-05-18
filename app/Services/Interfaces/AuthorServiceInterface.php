<?php


namespace App\Services\Interfaces;


use App\DTO\Requests\CreateAuthorRequest;
use App\Repositories\Interfaces\AuthorRepositoryInterface;

interface AuthorServiceInterface
{
    public function __construct(AuthorRepositoryInterface $repository);
    public function create(CreateAuthorRequest $request);
    public function getAllByIds(array $ids);
}