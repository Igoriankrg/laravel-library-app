<?php


namespace App\Services\Interfaces;


use App\Repositories\Interfaces\BookRepositoryInterface;

interface BookServiceInterface
{
    public function __construct(BookRepositoryInterface $repository);
}