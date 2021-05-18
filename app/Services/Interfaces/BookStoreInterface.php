<?php


namespace App\Services\Interfaces;


use App\DTO\BookStoreDto;

interface BookStoreInterface
{
    public function create(BookStoreDto $request);
    public function update(int $id, BookStoreDto $request);
}