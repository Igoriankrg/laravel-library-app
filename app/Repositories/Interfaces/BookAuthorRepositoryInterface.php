<?php


namespace App\Repositories\Interfaces;


interface BookAuthorRepositoryInterface extends RepositoryInterface
{
    public function findAllByAuthorId(int $id);
    public function create(array $data);
    public function findAllByBookId(int $id);
    public function deleteAllByBookId(int $id): bool;
    public function createMultiple(int $bookId, array $authorIds): array;
}