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
}