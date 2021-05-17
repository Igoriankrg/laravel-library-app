<?php


namespace App\Services;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;

class UserService extends Service implements UserServiceInterface
{
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}