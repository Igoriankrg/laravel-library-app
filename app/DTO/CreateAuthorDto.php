<?php


namespace App\DTO;


class CreateAuthorDto
{
    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): CreateAuthorDto
    {
        $this->name = $name;
        return $this;
    }
}