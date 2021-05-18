<?php


namespace App\Services\Interfaces;


use App\DTO\CreateBookAuthorDto;
use App\Repositories\Interfaces\BookAuthorRepositoryInterface;

interface BookAuthorServiceInterface
{
    public function __construct(BookAuthorRepositoryInterface $repository);
    public function getAllByAuthorId(int $id);
    public function getAllBookIdsByAuthorId(int $id);
    public function create(CreateBookAuthorDto $request);
    public function createMultiple(int $bookId, array $authorIds): array;
    public function deleteAllByBookId(int $id): bool;
}