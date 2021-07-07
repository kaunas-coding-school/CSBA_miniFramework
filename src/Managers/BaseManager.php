<?php

namespace CSBA\Managers;

use CSBA\Repositories\RepositoryInterface;

Abstract class BaseManager
{
    //** RepositoryInterface $repository */
    protected RepositoryInterface $repository;

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function create(array $payload)
    {
        return $this->repository->create($payload);
    }

    public function update(array $payload)
    {
        return $this->repository->update($payload);
    }

    public function deleteById(int $id)
    {
        $this->repository->deleteById($id);
    }
}
