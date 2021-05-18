<?php


namespace App\Services;


use App\DTO\Requests\CreateBookAuthorRequest;
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

    public function getAllBookIdsByAuthorId(int $id): array
    {
        $bookAuthorArray = $this->getAllByAuthorId($id);
        $bookIds = [];
        foreach ($bookAuthorArray as $item) {
            $bookIds[] = $item->getAttribute('book_id');
        }
        return $bookIds;
    }

    public function create(CreateBookAuthorRequest $request)
    {
        $data = [
            'book_id' => $request->getBookId(),
            'author_id' => $request->getAuthorId(),
        ];
        return $this->repository->create($data);
    }

    public function createMultiple(int $bookId, array $authorIds): array
    {
        return $this->repository->createMultiple($bookId, $authorIds);
    }

    public function deleteAllByBookId(int $id): bool
    {
        return $this->repository->deleteAllByBookId($id);
    }
}