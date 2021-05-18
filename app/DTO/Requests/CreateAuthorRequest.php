<?php


namespace App\DTO\Requests;


class CreateAuthorRequest
{
    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): CreateAuthorRequest
    {
        $this->name = $name;
        return $this;
    }
}