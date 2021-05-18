<?php


namespace App\DTO;


class BookStoreDto
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

    public function setName(string $name): BookStoreDto
    {
        $this->name = $name;
        return $this;
    }

    public function setAuthors(array $authors): BookStoreDto
    {
        $this->authors = $authors;
        return $this;
    }
}