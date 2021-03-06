<?php

namespace CSBA\Controllers;

use CSBA\Libs\JsonResponse;
use CSBA\Libs\Request;
use CSBA\Libs\ResponseInterface;
use CSBA\Repositories\GruopRepository;

class GroupController
{
    private GruopRepository $repository;

    public function __construct()
    {
        $this->repository = new GruopRepository();
    }

    public function list(): ResponseInterface
    {
        return new JsonResponse($this->repository->getAll());
    }

    public function show(Request $request): ResponseInterface
    {
        return new JsonResponse($this->repository->findById($request->getPayload()['id']));
    }

    public function create(Request $request): ResponseInterface
    {
        return new JsonResponse(['id' => $this->repository->create($request->getPayload())]);
    }

    public function update(Request $request): ResponseInterface
    {
        return new JsonResponse($this->repository->update($request->getPayload()));
    }

    public function delete(Request $request): ResponseInterface
    {
        $id = $request->getPayload()['id'];
        $this->repository->deleteById($id);

        return  new JsonResponse(['message' => "Elementas $id ištrintas"]);
    }
}
