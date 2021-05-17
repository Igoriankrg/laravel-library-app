<?php


namespace App\Repositories\Ar;


use App\Models\BookAuthor;
use App\Repositories\Interfaces\BookAuthorRepositoryInterface;

class BookAuthorRepository implements BookAuthorRepositoryInterface
{
    protected $model = BookAuthor::class;

    public function findAllByAuthorId(int $id)
    {
        return $this->model::where('author_id', $id)->get();
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function findAllByBookId(int $id)
    {
        return $this->model::where('book_id', $id)->get();
    }

    public function deleteAllByBookId(int $id): bool
    {
        $bookAuthorCollection = $this->findAllByBookId($id);
        foreach ($bookAuthorCollection as $item) {
            $item->delete();
        }
        return true;
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
}