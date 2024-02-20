<?php

namespace App\Repositories;

abstract class BaseRepository
{
    // We can add findAll, findById here. but laravel already have those helper functions.

    abstract protected function all();

    abstract protected function findById(int $id);

    abstract protected function create(array $attributes);

    abstract protected function update(int $id, array $attributes);

    abstract protected function delete(int $id);
}
