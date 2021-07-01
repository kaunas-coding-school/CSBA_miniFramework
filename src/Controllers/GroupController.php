<?php

namespace CSBA\Controllers;

use CSBA\Libs\JsonResponse;
use CSBA\Libs\Request;
use CSBA\Libs\ResponseInterface;
use CSBA\Managers\GroupRepository;

class GroupController
{
    private GroupRepository $manager;

    public function __construct()
    {
        $this->manager = new GroupRepository();
    }

    public function list(): ResponseInterface
    {
        return new JsonResponse($this->manager->getAll());
    }

    public function show(Request $request): ResponseInterface
    {
        return  new JsonResponse($this->manager->findById($request->getPayload()['id']));
    }

    public function create(Request $request): ResponseInterface
    {
        return new JsonResponse(['id' => $this->manager->create($request->getPayload())]);
    }

    public function update(Request $request): ResponseInterface
    {
        return new JsonResponse($this->manager->update($request->getPayload()));
    }

    public function delete(Request $request): ResponseInterface
    {
        $id = $request->getPayload()['id'];
        $this->manager->deleteById($id);

        return  new JsonResponse(['message' => "Elementas $id ištrintas"]);
    }
}
