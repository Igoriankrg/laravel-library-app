<?php


namespace App\Services\Interfaces;


use App\Repositories\Interfaces\UserRepositoryInterface;

interface UserServiceInterface
{
    public function __construct(UserRepositoryInterface $repository);
}