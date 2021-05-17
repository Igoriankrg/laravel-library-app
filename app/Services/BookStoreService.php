<?php


namespace App\Services;


use App\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Repositories\Interfaces\BookAuthorRepositoryInterface;
use App\Repositories\Interfaces\BookRepositoryInterface;
use App\Services\Interfaces\BookStoreInterface;

class BookStoreService implements BookStoreInterface
{
    protected $bookRepository;
    protected $bookAuthorRepository;
    protected $authorRepository;

    public function __construct(
        BookRepositoryInterface $bookRepository,
        BookAuthorRepositoryInterface $bookAuthorRepository,
        AuthorRepositoryInterface $authorRepository
    )
    {
        $this->bookRepository = $bookRepository;
        $this->bookAuthorRepository = $bookAuthorRepository;
        $this->authorRepository = $authorRepository;
    }

    public function create(array $data)
    {
        $book = $this->bookRepository->create(['name' => $data['name']]);
        $this->bookAuthorRepository->createMultiple($book->getAttribute('id'), $data['authors']);
        $book['authors'] = $this->authorRepository->findAllByIds($data['authors']);
        return $book;
    }

    public function update(int $id, array $data)
    {
        $book = $this->bookRepository->update($id, ['name' => $data['name']]);
        $this->bookAuthorRepository->deleteAllByBookId($id);
        $this->bookAuthorRepository->createMultiple($id, $data['authors']);
        $book['authors'] = $this->authorRepository->findAllByIds($data['authors']);
        return $book;
    }
}