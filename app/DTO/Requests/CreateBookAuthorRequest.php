<?php


namespace App\DTO\Requests;


class CreateBookAuthorRequest
{
    protected $bookId;
    protected $authorId;

    public function getBookId()
    {
        return $this->bookId;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function setBookId(int $bookId): CreateBookAuthorRequest
    {
        $this->bookId = $bookId;
        return $this;
    }

    public function setAuthorId(int $authorId): CreateBookAuthorRequest
    {
        $this->authorId = $authorId;
        return $this;
    }
}