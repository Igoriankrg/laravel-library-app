<?php


namespace App\Services\Interfaces;


use App\Repositories\Interfaces\BookAuthorRepositoryInterface;

interface BookAuthorServiceInterface
{
    public function __construct(BookAuthorRepositoryInterface $repository);
}