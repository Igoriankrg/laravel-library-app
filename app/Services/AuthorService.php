<?php


namespace App\Services;


use App\DTO\Requests\CreateAuthorRequest;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Services\Interfaces\AuthorServiceInterface;

class AuthorService extends Service implements AuthorServiceInterface
{
    public function __construct(AuthorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(CreateAuthorRequest $request)
    {
        $data = [
            'name' => $request->getName(),
        ];
        return $this->repository->create($data);
    }

    public function getAllByIds(array $ids)
    {
        return $this->repository->findAllByIds($ids);
    }
}