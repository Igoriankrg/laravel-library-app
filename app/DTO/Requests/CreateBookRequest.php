<?php


namespace App\DTO\Requests;


class CreateBookRequest
{
    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): CreateBookRequest
    {
        $this->name = $name;
        return $this;
    }
}