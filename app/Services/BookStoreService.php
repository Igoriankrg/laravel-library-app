<?php


namespace App\Services;


use App\DTO\BookStoreDto;
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

    public function create(BookStoreDto $request)
    {
        $book = $this->bookRepository->create(['name' => $request->getName()]);
        $this->bookAuthorRepository->createMultiple($book->getAttribute('id'), $request->getAuthors());
        $book['authors'] = $this->authorRepository->findAllByIds($request->getAuthors());
        return $book;
    }

    public function update(int $id, BookStoreDto $request)
    {
        $book = $this->bookRepository->update($id, ['name' => $request->getName()]);
        $this->bookAuthorRepository->deleteAllByBookId($id);
        $this->bookAuthorRepository->createMultiple($id, $request->getAuthors());
        $book['authors'] = $this->authorRepository->findAllByIds($request->getAuthors());
        return $book;
    }
}