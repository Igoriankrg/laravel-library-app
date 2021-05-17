<?php


namespace App\Services;


use App\Repositories\Interfaces\BookAuthorRepositoryInterface;
use App\Services\Interfaces\BookAuthorServiceInterface;

class BookAuthorService extends Service implements BookAuthorServiceInterface
{
    public function __construct(BookAuthorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllByAuthorId(int $id)
    {
        return $this->repository->findAllByAuthorId($id);
    }

    public function getAllBookIdsByAuthorId(int $id)
    {
        $bookAuthorArray = $this->getAllByAuthorId($id);
        $bookIds = [];
        foreach ($bookAuthorArray as $item) {
            $bookIds[] = $item->getAttribute('book_id');
        }
        return $bookIds;
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function createMultiple(int $bookId, array $authorIds): array
    {
        $bookAuthorArray = [];
        foreach ($authorIds as $authorId) {
            $bookAuthorArray[] = $this->create([
                'book_id' => $bookId,
                'author_id' => $authorId,
            ]);
        }
        return $bookAuthorArray;
    }

    public function deleteAllByBookId(int $id): bool
    {
        return $this->repository->deleteAllByBookId($id);
    }
}