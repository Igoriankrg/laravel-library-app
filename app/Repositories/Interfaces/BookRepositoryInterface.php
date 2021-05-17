<?php

namespace App\Repositories\Interfaces;

interface BookRepositoryInterface extends RepositoryInterface
{
    public function findAll();
    public function findAllWithAuthors();
    public function findOneById(int $id);
    public function findOneByIdWithAuthors(int $id);
    public function findAllByIds(array $ids);
    public function create(array $data);
    public function update(int $id, array $data);
}