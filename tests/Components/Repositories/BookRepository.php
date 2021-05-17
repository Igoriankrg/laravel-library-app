<?php


namespace Tests\Components\Repositories;


use App\Models\Book;
use App\Repositories\Interfaces\BookRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BookRepository implements BookRepositoryInterface
{
    private $collection;

    public function __construct(array $collection)
    {
        $this->collection = new Collection($collection);
    }

    public function findAll()
    {
        return $this->collection->all();
    }

    public function findAllWithAuthors()
    {
        //ToDo update it if needed
        return null;
    }

    public function findOneById(int $id)
    {
        return $this->collection->filter(function ($item) use ($id) {
            return $item->id === $id;
        })->first();
    }

    public function findOneByIdWithAuthors(int $id)
    {
        //ToDo update it if needed
        return null;
    }

    public function findAllByIds(array $ids)
    {
        //ToDo update it if needed
        return null;
    }

    public function create(array $data)
    {
        $book = new Book();
        $book->setRawAttributes($data);
        $book->id = ($this->collection->count() + 1);
        $this->collection->add($book);
        return $book;
    }

    public function update(int $id, array $data)
    {
        //ToDo update it if needed
        return null;
    }
}