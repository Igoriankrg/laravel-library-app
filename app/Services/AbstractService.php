<?php

namespace App\Services;

use App\Repositories\Interfaces\RepositoryInterface;

abstract class AbstractService
{
    protected $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}