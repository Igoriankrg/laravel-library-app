<?php


namespace App\Services\Interfaces;


use App\Repositories\Interfaces\AuthorRepositoryInterface;

interface AuthorServiceInterface
{
    public function __construct(AuthorRepositoryInterface $repository);
}