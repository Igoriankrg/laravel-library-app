<?php


namespace App\Repositories\Interfaces;


interface AuthorRepositoryInterface
{
    public function create(array $data);
    public function findAllByIds(array $ids);
}