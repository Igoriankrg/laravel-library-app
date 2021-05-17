<?php


namespace App\Services\Interfaces;


interface BookStoreInterface
{
    public function create(array $data);
    public function update(int $id, array $data);
}