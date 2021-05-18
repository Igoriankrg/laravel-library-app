<?php


namespace App\DTO\Requests;


class BookStoreRequest
{
    protected $name;
    protected $authors;

    public function getName()
    {
        return $this->name;
    }

    public function getAuthors()
    {
        return $this->authors;
    }

    public function setName(string $name): BookStoreRequest
    {
        $this->name = $name;
        return $this;
    }

    public function setAuthors(array $authors): BookStoreRequest
    {
        $this->authors = $authors;
        return $this;
    }
}