<?php


namespace App\DTO;


class CreateBookAuthorDto
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

    public function setBookId(int $bookId): CreateBookAuthorDto
    {
        $this->bookId = $bookId;
        return $this;
    }

    public function setAuthorId(int $authorId): CreateBookAuthorDto
    {
        $this->authorId = $authorId;
        return $this;
    }
}