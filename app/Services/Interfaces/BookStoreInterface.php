<?php


namespace App\Services\Interfaces;


use App\DTO\Requests\BookStoreRequest;

interface BookStoreInterface
{
    public function create(BookStoreRequest $request);
    public function update(int $id, BookStoreRequest $request);
}