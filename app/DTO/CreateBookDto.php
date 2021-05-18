<?php


namespace App\DTO;


class CreateBookDto
{
    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): CreateBookDto
    {
        $this->name = $name;
        return $this;
    }
}